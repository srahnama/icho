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
    protected $fillable = ['answer_id','message_id'];
    public function messages()
    {
        return  $this->belongsTo('App\Message','answer_id','id');
    }
    public function scopeHasanswer($query ,$id){
        return $query->where('message_id',$id)->count()>0;
    }
}
