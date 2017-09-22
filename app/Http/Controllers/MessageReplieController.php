<?php

namespace App\Http\Controllers;

use App\MessageReplie;
use Illuminate\Http\Request;

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
        $idd =  MessageReplie::where('answer_id',$id)->pluck('id');

        $message = new MessageReplie;
        return response()->json([
            'messages' =>  MessageReplie::find($idd[0])->messages()->get()
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
    public function destroy(MessageReplie $messageReplie)
    {
        //
    }
}
