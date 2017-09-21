<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Message
 *
 * @mixin \Eloquent
 */
class Message extends Model
{
    //
    protected $fillable = ['text', 'user_id'];
    public function user()
    {
        return  $this->belongsTo('App\User');
    }

}
