<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    //
    protected $fillable = ['userid'];
    public function User()
    {
        return $this->hasOne('App\GitUsers', 'id', 'userid');
    }
}
