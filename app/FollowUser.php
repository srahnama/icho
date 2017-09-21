<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{

    protected $fillable = ['user_id','follow_user_id'];
    public function user(){
        return $this->belongsTo('App\User');

    }
}
