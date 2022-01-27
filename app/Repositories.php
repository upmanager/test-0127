<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repositories extends Model
{
    //
    protected $fillable = ['id', 'owner_id', 'node_id', 'name', 'full_name', 'url', 'forks', 'stars', 'created_at', 'updated_at', 'pushed_at'];
}
