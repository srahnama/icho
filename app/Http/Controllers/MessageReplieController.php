<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageReplie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MessageReplieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        return response()->json([
            'replies' => MessageReplie::all()
        ],200,[],JSON_PRETTY_PRINT);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $message = Message::find($request[0]);
        $message->answer = true;
        $message->save();
        $a = MessageReplie::create([
            'answer_id' => $request[1],
            'message_id' => $request[0],

        ]);
        return response()->json([
           '1' => $a,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MessageReplie  $messageReplie
     * @return \Illuminate\Http\Response
     */
    public function show(MessageReplie $messageReplie,$id)
    {
        //
        $idd =  MessageReplie::where('message_id',$id)->pluck('id');

        $message = new MessageReplie;
        return response()->json([
            'messages' =>  MessageReplie::find($idd[0])->messages()->get(),
            'id' =>  $idd[0]
        ],200,[],JSON_PRETTY_PRINT);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MessageReplie  $messageReplie
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageReplie $messageReplie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MessageReplie  $messageReplie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageReplie $messageReplie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MessageReplie  $messageReplie
     * @return \Illuminate\Http\Response
     */


    public function destroy($reply_id,$message_id)
    {
        //
//        Route::delete('/messages/'+$id, 'MessageController@destroy');
        //$message_id = MessageReplie::where('answer_id',$id)->first();
//        var_dump(MessageReplie::hasanswer($message_id[0]));
        if(!MessageReplie::hasanswer($message_id)){
            $message = Message::find($message_id);
            $message->answer = false;
            $message->save();
        }

        MessageReplie::where('answer_id',$reply_id)
            ->where('message_id',$message_id)
            ->delete();
        return response()->json([
            'messages' =>  'reply deleted Succesfully!',
            'dd' => MessageReplie::hasanswer($message_id),

        ],200,[],JSON_PRETTY_PRINT);
    }
}
