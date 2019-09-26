@extends('layouts.admin')

@section('content')

<h2 class="my-5">Edit Post <small>{{ $post->title }}</small></h2>

<form action="{{ route('posts.update', [$post->id]) }}" method="post" class="form-horizontal">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="" class="control-label col-md-3">{{ __('Title') }}</label>
        <div class="col-md-9">
            <input type="text" name="title" value="{{ $post->title }}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-3">{{ __('Content') }}</label>
        <div class="col-md-9">
            <textarea name="content" class="form-control">{{ $post->content }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>

@endsection