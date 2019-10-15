@extends('layouts.app')

@section('content')

<div class="container">
    <h2>{{ $user->name }}</h2>

    <ul>
        @foreach ($user->posts as $post)
        <li>{{ $post->title }}</li>
        @endforeach
    </ul>
</div>

@endsection