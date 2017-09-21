<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LikeMessage
 *
 * @mixin \Eloquent
 */
class LikeMessage extends Model
{
    //
    public function user()
    {
        return  $this->belongsTo('App\User');
    }
    public function message()
    {
        return  $this->belongsTo('App\Message');
    }
}
