@extends('layouts.admin')

@section('content')

<div class="pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Category <small>{{ $category->name }}</small></h2>
</div>

<form action="{{ route('categories.update', [$category->id]) }}" method="post" class="form-horizontal">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
        <div class="col-sm-10">
            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </div>
</form>

@endsection