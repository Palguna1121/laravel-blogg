@extends('teamplate.templating')

@section('content')

<div class="container mt-5">
    <h1>User Posts</h1>
    <ul>
        @foreach ($userPosts as $userPost)
            <li>{{ $userPost->title }} by {{ $userPost->user_name }}</li>
        @endforeach
    </ul>
</div>


@endsection