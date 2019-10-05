@extends('layouts.layout')

@section('title', $post->title)

@section('content')
        <div class="container my-5">
            <h2 class="my-2">{{ $post->title }}</h2>
            <time>{{ $post->created_at}}</time>
            <img src="{{ asset('storage/' . $post->image) }}" class="d-block w-100">
            <p class="p-4">{{ $post->content }}</p>

            <section>
                <h4>Post Comments</h4>
                @foreach ($post->comments as $comment)
                <div class="my-2 border-1">
                    <h5>{{ $comment->user->name }}</h5>
                    <time>{{ $comment->created_at }}</time>
                    <p>{{ $comment->comment }}</p>
                </div>
                @endforeach
            </section>
            <section>
                <form method="post" action="{{ route('comments.store', [$post->id]) }}">
                    @csrf
                    <textarea class="form-control my-5" name="comment"></textarea>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
            </section>
        </div>
@endsection