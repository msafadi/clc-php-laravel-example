@extends('layouts.admin')

@section('content')

<div class="pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Post <small>{{ $post->title }}</small></h2>
</div>

<form action="{{ route('posts.update', [$post->id]) }}" method="post" class="form-horizontal">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
        <div class="col-sm-10">
            <input type="text" name="title" value="{{ $post->title }}" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Content') }}</label>
        <div class="col-sm-10">
            <textarea name="content" class="form-control">{{ $post->content }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </div>
</form>

@endsection