<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth as Auth;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserUser[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserUser[] $following
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $messeage
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //return Users that user following
    public function role(){
        return $this->hasOne('App\Role','user_id','id');
    }
    //REturn list of users that user following
    public function scopeUserfollowing($query){


        $ids =$query->find(Auth::user()->id)->following->pluck('follow_user_id')->all();
        array_push($ids,intval(Auth::user()->id));
        return ($ids);

    }

    //return Users that user following
    public function following(){
        return $this->hasMany('App\FollowUser','user_id','id');
    }

    //return followers of user
    public function followers(){
        return $this->hasMany('App\FollowUser','follow_user_id','id');
    }

    //return messages of user
    public function messages(){
        return $this->hasMany('App\Message','user_id','id');
    }

    //return messages that user mentioned in it
    public function mentions(){
        return $this->hasMany('App\MessageMention','user_id','id');
    }

    //return messages that user like
    public function likes(){
        return $this->hasMany('App\LikeMessage','user_id','id');
    }

    //return messages that user retweete
    public function replies(){
        return $this->hasMany('App\MessageReplie','user_id','id');
    }

    //return messages that user replies
    public function retweets(){
        return $this->hasMany('App\MessageRetweet','user_id','id');
    }
}
