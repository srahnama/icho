@extends('layouts.app')

@section('title')
Icho!

@endsection

@section('content')



    @guest()
        <h1>Welcome to Icho!</h1>
        @else





                <Message></Message>

            @endguest
<Example></Example>


@endsection