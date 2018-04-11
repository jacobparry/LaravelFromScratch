@extends('layouts.app')

@section('content')
    <!-- Passed $title in from controller -->
    <div class="jumbotron text-center">
            <h1>{{$title}}</h1>
            <p>This is the Laravel application from the Laravel From Scratch Youtube series.a</p> 
            <p>
                <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> 
                <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
            </p>       
    </div>
@endsection