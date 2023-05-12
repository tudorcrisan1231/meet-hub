@extends('layouts.main')

@section('content')
    <div>{{auth()->user()->name}}</div>
    <a class="nav-link" href="{{ route('signout') }}">Logout</a
@endsection