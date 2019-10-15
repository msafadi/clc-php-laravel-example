@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Create Post</h2>

    <form id="postform" action="{{ route('api.posts.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">{{ __('Content') }}</label>
            <div class="col-sm-10">
                <textarea name="content" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">{{ __('Image') }}</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">{{ __('Category') }}</label>
            <div class="col-sm-10">
                <select class="form-control" name="category_id">
                    <option disabled selected>Select category</option>
                    @foreach(App\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
            <div class="col-sm-10">

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="draft">
                    <label class="form-check-label">Draft</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" value="published">
                    <label class="form-check-label">Published</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">{{ __('Tags') }}</label>
            <div class="col-sm-10">
                @foreach (App\Tag::all() as $tag)
                <div class="form-check form-check-inline">
                    <input id="tag{{ $tag->id }}" class="form-check-input" type="checkbox" name="tag_id[]" value="{{ $tag->id }}">
                    <label for="tag{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </form>
</div>

@endsection

@push('js')

<script>
    $('#postform').on('submit', function(e) {
        e.preventDefault();
        //alert($(this).serialize());

        $.ajax($(this).attr('action'), {
            method: "POST",
            data: $(this).serialize()
        }).done(function(res) {
            if (res.id) {
                alert('Post created!');
                window.location = "/api/views/posts";
            }
        });
    });
</script>

@endpush