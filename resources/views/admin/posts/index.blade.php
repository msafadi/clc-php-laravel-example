@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>@lang('admin.posts')</h2>
    <a class="btn btn-outline-success btn-sm mb-2 mb-md-0" href="{{ route('posts.create') }}">{{ trans('admin.new') }}</a>
</div>

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
            <th>{{ __('Id') }}</th>
            <th>{{ __('Title') }}</th>
            <th>{{ __('Category') }}</th>
            <th>{{ __('Created At') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>{{ $post->created_at }}</td>
            <td><a href="{{ route('posts.edit', [$post->id]) }}">{{ __('Edit the post') }}</a>
                <form class="d-inline form-inline delete" action="{{ route('posts.destroy', [$post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-link text-danger">{{ __('Delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}

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