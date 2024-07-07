@extends('teamplate.templating')

@section('content')

<nav>
    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @else
        <a href="{{ route('user.posts', auth()->user()->id) }}">My Posts</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endguest
</nav>

@endsection