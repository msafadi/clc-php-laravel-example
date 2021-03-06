@extends('layouts.admin')

@section('content')

<div class="pt-3 pb-2 mb-3 border-bottom">
    <h2>{{ __('Create New Post') }}</h2>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <h4>Errors!</h4>
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif

<form action="{{ route('posts.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
        <div class="col-sm-10">
            <input type="text" name="title" value="{{ old('title') }}" class="form-control{{ $errors->has('title')? ' is-invalid' : '' }}">
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Content') }}</label>
        <div class="col-sm-10">
            <textarea name="content" class="form-control{{ $errors->has('content')? ' is-invalid' : '' }}">{{ old('content') }}</textarea>
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Image') }}</label>
        <div class="col-sm-10">
            <input type="file" class="form-control{{ $errors->has('image')? ' is-invalid' : '' }}" name="image">
            @error('image')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Category') }}</label>
        <div class="col-sm-10">
            <select class="form-control{{ $errors->has('category_id')? ' is-invalid' : '' }}" name="category_id">
                <option disabled selected>Select category</option>
                @foreach(App\Category::all() as $category)
                <option value="{{ $category->id }}"{{ old('category_id') == $category->id? ' selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Status') }}</label>
        <div class="col-sm-10">

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" value="draft"{{ old('status') == 'draft'? ' checked' : '' }}>
                <label class="form-check-label">Draft</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" value="published"{{ old('status') == 'published'? ' checked' : '' }}>
                <label class="form-check-label">Published</label>
            </div>
            @error('status')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Tags') }}</label>
        <div class="col-sm-10">
            @foreach (App\Tag::all() as $tag)
            <div class="form-check form-check-inline">
                <input id="tag{{ $tag->id }}" class="form-check-input" type="checkbox" name="tag_id[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tag_id', []))? ' checked' : '' }}>
                <label for="tag{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
            </div>
            @endforeach
            @error('tag_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </div>
</form>

@endsection