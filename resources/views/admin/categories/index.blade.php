@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>{{ __('Categories') }}</h2>
    <a class="btn btn-outline-success btn-sm mb-2 mb-md-0" href="{{ route('categories.create') }}">{{ __('New') }}</a>
</div>

@if(session()->has('message'))
<div class="alert alert-success">
    <p>{{ session('message') }}</p>
</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->created_at }}</td>
            <td><a href="{{ route('categories.edit', [$category->id]) }}">Edit</a>
            <form class="d-inline form-inline delete" action="{{ route('categories.destroy', [$category->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-link text-danger">Delete</button>
            </form></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('scripts')

<script>
$('form.delete').on('submit', function(e) {
    if (!window.confirm('Are you sure?')) {
        e.preventDefault();
    }

});
</script>

@endsection