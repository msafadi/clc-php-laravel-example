@extends('layouts.admin')

@section('content')

<div class="pt-3 pb-2 mb-3 border-bottom">
    <h2>{{ __('Create New Category') }}</h2>
</div>

<form action="{{ route('categories.store') }}" method="post" class="form-horizontal">
    @csrf
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </div>
</form>

@endsection