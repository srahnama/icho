<?php

namespace App\Http\Controllers;

use App\Message as Message;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user())
            return response()->json([
                'messages' =>Message::whereIn('user_id',User::userfollowing())->get(),
                'user_id' => Auth::user()->id
            ],200,[],JSON_PRETTY_PRINT);//view('index');
        return view('index');
    }


    public function users(Request $request){
        $a = new User;
        return $a->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //1
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
        $this->validate($request,[
            'text' => 'required'
        ]);
        $post = Message::create([
            'text'=> $request->input('text'),
            'user_id' => Auth::user()->id
        ]);



        return response()->json([
           'message' => $post
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message )
    {
        //
          //dd(Message::whereIn('user_id',User::userfollowing())->get());

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Message::find($id)->delete();

        return response()->json([
           'message' =>'this messeged delete successfully'
        ]);
    }
}
