@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Notifications') }}</div>

                <div class="card-body">
                    @foreach ($notifications as $notification)
                    <div class="my-2 p-3 bg-light">
                        <h6><a href="{{ route('notifications.read', $notification->id) }}">{{ $notification->data['message'] }}</a></h6>
                        <small><time class="text-muted">{{ $notification->created_at->diffForHumans() }}</time></small>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
