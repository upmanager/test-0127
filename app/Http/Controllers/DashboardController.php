<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\GitUsers;

class DashboardController extends Controller {

    public function index(){
      $users = GitUsers::paginate(8);
      return view('home', compact('users'));
    }

}
