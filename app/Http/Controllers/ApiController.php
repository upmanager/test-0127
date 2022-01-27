<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitors;
use App\GitUsers;
use App\Repositories;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['search'];
        $users = GitUsers::select("*")->orderby('followers', 'desc')->orderby('public_repos', 'desc')->orderby('visits', 'desc');
        if($search) {
            $users = $users->where('login', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        }
        $data = $users->paginate(3);
        return $data;
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->gitAPI("https://api.github.com/users/$request->username");
        if(!$response->ok()) return "can't find user";
        $data = $response->json();
        $user = GitUsers::updateOrCreate(['login' => $request->username], $data);
        
        $response = $this->gitAPI($data['repos_url']);
        $repos = [];
        if($response->ok()) $repos = $response->json();
        foreach ($repos as $key => $value) {
            $value['owner_id'] = $user->id;
            $value['stars'] = $value['stargazers_count'];
            $value['forks'] = $value['forks_count'];
            Repositories::updateOrCreate(['id' => $value['id']], $value);
        }
        return response()->json(['success'=>true], 200);
    }
    public function popular(Request $request)
    {
        $date = $request->date;
        $from = date('Y-m-d 00:00:00', strtotime($date));
        $to = date('Y-m-d 23:59:59', strtotime($date));
        $populars = Visitors::select("git_users.*")
            ->leftjoin('git_users', 'git_users.id', 'visitors.userid')
            ->orderby('git_users.followers', 'desc')->orderby('git_users.public_repos', 'desc')->orderby('git_users.visits', 'desc')
            ->whereBetween('visitors.created_at', [$from, $to])
            ->limit(3)
            ->get();
       
        return $populars;
    }
    public function detail(Request $request)
    {
        $id = $request->id;
        $query = $request->q;
        Visitors::create(['userid' => $id]);
        $user = GitUsers::find($id);
        $user->visits = ($user->visits + 1); 
        $user->save();
        $repos = $user->repositories;
        if(count($repos) > 0 && $query != null) {
            $repos = $user->repositories->where('repositories.name', 'like', '%' . $query . '%');
        }
        return ["user" => $user, 'repos' => $repos];
    }
}
