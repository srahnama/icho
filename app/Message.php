<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Message
 *
 * @mixin \Eloquent
 * @property mixed $answers
 */
class Message extends Model
{
    //
    protected $fillable = ['text', 'user_id'];
    public function user()
    {
        return  $this->belongsTo('App\User');
    }
    public function answers()
    {
        return  $this->hasMany('App\MessageReplie','message_id','id');
    }

}
