@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Posts</h2>
    <table class="table my-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Category</th>
                <th>User</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="posts">
        </tbody>
    </table>
</div>

@endsection

@push('js')
<script>
$(document).ready(function() {
    $.getJSON('{{ route('api.posts.index') }}', function(res) {
        let table = $('#posts');
        for (i in res.data) {
            post = res.data[i];
            table.append('<tr>\
            <td>' + post.id + '</td>\
            <td>' + post.title + '</td>\
            <td>' + post.status + '</td>\
            <td>' + post.category.name + '</td>\
            <td>' + post.user.name + '</td>\
            <td>' + post.created_at + '</td>\
            <td><a href="#" data-action="delete" data-id="' + post.id + '">Delete</a></td>\
            </tr>');
        }
    });

    $('#posts').on('click', 'a[data-action="delete"]', function(e) {
        e.preventDefault();

        let url = '{{ route('api.posts.destroy', ['#']) }}';
        url = url.replace('#', $(this).data('id'));


        $.ajax(url, {
            method: "DELETE"
        }).done(function(res) {
            if (res.message == 'Deleted') {
                alert('Post deleted!');
                $('[data-id="' + res.data.id +'"]').parent().parent().remove();
            }
        });
    });
});
</script>
@endpush