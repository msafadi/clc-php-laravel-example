@extends('layouts.layout')

@section('title', $post['title'])

@section('content')
        <div class="container">
            <h2>{{ $post['title'] }}</h2>
            <img src="{{ asset($post['image']) }}" class="d-block w-100">
            <p>{{ $post['content'] }}</p>
        </div>
@endsection