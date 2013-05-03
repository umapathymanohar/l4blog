@extends('layouts.scaffold')

@section('main')

<h1>Create Post</h1>

{{ Form::open(array('route' => 'posts.store')) }}
    <ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        

        <?php

        echo Category::all();
            foreach (Category::all() as $cat)
{

    $categories[] = array($cat->id => $cat->title);
}
        ?>

        <li>
           {{ Form::label('category', 'Category:') }}
           {{ Form::select('category', $categories) }}
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


