@extends('layouts.scaffold')

@section('main')

<h1>Edit Comment</h1>
{{ Form::model($comment, array('method' => 'PUT', 'route' => array('posts.comments.update', $comment->post_id, $comment->id))) }}
    <ul>
        <li>
            {{ Form::label('post_id', 'Post_id:') }}
            {{ Form::input('number', 'post_id') }}
        </li>

        <li>
            {{ Form::label('body', 'Body:') }}
            {{ Form::textarea('body') }}
        </li>

        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('posts.comments.show', 'Cancel', array($comment->post_id, $comment->id), array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop