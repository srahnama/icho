<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MessageReplie
 *
 * @mixin \Eloquent
 */
class MessageReplie extends Model
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
