@extends('layouts.admin')

@section('content')

<h2 class="my-5">{{ __('Posts') }}</h2>

@if(session()->has('message'))
<div class="alert alert-success">
    <p>{{ session('message') }}</p>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
    <p>{{ session('error') }}</p>
</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Created At</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->created_at }}</td>
            <td><a href="{{ route('posts.edit', [$post->id]) }}">Edit</a>
            <form class="d-inline form-inline delete" action="{{ route('posts.destory', [$post->id]) }}" method="post">
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