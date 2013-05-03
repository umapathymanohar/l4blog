@extends('layouts.scaffold')

@section('main')

{{-- <h1>{{ $title }}</h1> --}}
<h2>All Comments</h2>

<p>{{ link_to_route('posts.comments.create', 'Add new comment', $post_id) }}</p>

@if ($comments->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Post_id</th>
				<th>Body</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->post_id }}</td>
					<td>{{ $comment->body }}</td>
                    <td>{{ link_to_route('posts.comments.edit', 'Edit', array($comment->post_id, $comment->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('posts.comments.destroy', $comment->post_id, $comment->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no comments
@endif

@stop