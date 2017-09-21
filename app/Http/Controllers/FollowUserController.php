<?php

namespace App\Http\Controllers;

use App\FollowUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::userfollowing();
        return response()->json([
            'users' => $users,

        ]);

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
        $follow = FollowUser::create([
          'user_id' => Auth::user()->id,
        'follow_user_id' => $request->input('id')
        ]);
        return response()->json([
           'message' => 'create new following successfully',
            'follow' => $follow->follow_user_id
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUser $followUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUser $followUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FollowUser $followUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FollowUser  $followUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        FollowUser::where('follow_user_id',$id)->delete();

        return response()->json([
            'message' =>'this user unfollowed successfully'
        ]);
    }
}
