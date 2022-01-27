<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitUsers extends Model
{
    //
    protected $fillable = ['id', 'login', 'node_id', 'avatar_url', 'repos_url', 'name', 'email', 'location', 'followers', 'public_repos', 'visits', 'updated_at', 'created_at'];
    public function Repositories()
    {
        return $this->hasMany('App\Repositories', 'owner_id', 'id');
    }
}
