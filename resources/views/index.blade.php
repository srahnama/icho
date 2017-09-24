@extends('layouts.app')

@section('title')
Icho!

@endsection

@section('content')



    @guest()
        <h1>Welcome to Icho!</h1>
        @else





                <Message :user="{{Auth::user()}}"></Message>

            @endguest
<Example></Example>


@endsection