<?php

namespace App\Http\Controllers;

use App\MessageRetweet;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageRetweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userFollowing =User::userfollowing();//list of user followings
        //list ids of messages retweet by following users and current user is login
        $remessages =  MessageRetweet::whereIn('user_id',$userFollowing)->pluck('message_id')->all();
        $remessageusers =  MessageRetweet::whereIn('user_id',$userFollowing)->pluck('user_id')->all();
        $remessageusers1 =  MessageRetweet::whereIn('user_id',$userFollowing)->get();
        //list of name of users that retweet by following users and current user is login
        $userFollowingNames =User::find( $remessageusers )->pluck('name')->all();
        //$userFollowingID =DB::table('users')->whereIn('id', $remessageusers)->get();
        //list of messages retweet by following users and current user is login
        $messages =[];
        for($i = 0 ; $i < count($remessages); $i++) {
            $messages[$i]=(Message::find($remessages[$i]));

        }
        //$messages = Message::find($remessages);
        for($i = 0 ; $i < count($remessageusers); $i++) {
            $messages[$i]['retweeter'] =  User::find( $remessageusers[$i] )->id ;
            $messages[$i]['retweeter_name'] = User::find( $remessageusers[$i] )->name;
        }

        return response()->json([
            'messages' => $messages,
            'remessages' => $remessages,
            'remessageusers' => $remessageusers
            //'userFollowingid' => $userFollowingID

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
        $message = MessageRetweet::firstOrCreate([
            'user_id' => Auth::user()->id,
            'message_id' => $request->input('id')
        ]);

        $message = Message::find( $request->input('id'));

        $message['retweeter'] = Auth::user()->id;
        $message['retweeter_name'] = Auth::user()->name;


        return response()->json([
            'message' => $message,
            //'remessages' => $remessages

        ]);
        return response()->json([
            'message' => $message,
            'ok' => 'message resend save successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MessageRetweet  $messageRetweet
     * @return \Illuminate\Http\Response
     */
    public function show(MessageRetweet $messageRetweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MessageRetweet  $messageRetweet
     * @return \Illuminate\Http\Response
     */
    public function edit(MessageRetweet $messageRetweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MessageRetweet  $messageRetweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MessageRetweet $messageRetweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MessageRetweet  $messageRetweet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MessageRetweet::where('message_id',$id)->where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'message' => 'retweet delete successfully'
        ]);
    }
}
