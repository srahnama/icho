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

    public function messages()
    {
        return  $this->belongsTo('App\Message','message_id','id');
    }
}
