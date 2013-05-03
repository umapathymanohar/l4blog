@extends('layouts.scaffold')

@section('main')

<h1>Create Comment</h1>

{{ Form::open(array('route' => ['posts.comments.store', $post_id])) }}
    <ul>
        <li>
            {{ Form::label('post_id', 'Post_id:') }}
            {{ Form::input('number', 'post_id', $post_id) }}
        </li>

        <li>
            {{ Form::label('body', 'Body:') }}
            {{ Form::textarea('body') }}
        </li>

        <li>
            {{ Form::submit('Submit', array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop


