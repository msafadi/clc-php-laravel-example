@extends('layouts.admin')

@section('content')

<h2 class="my-5">{{ __('Create New Post') }}</h2>

<form action="{{ route('posts.store') }}" method="post" class="form-horizontal">
    @csrf
    <div class="form-group">
        <label for="" class="control-label col-md-3">{{ __('Title') }}</label>
        <div class="col-md-9">
            <input type="text" name="title" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-3">{{ __('Content') }}</label>
        <div class="col-md-9">
            <textarea name="content" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>

@endsection