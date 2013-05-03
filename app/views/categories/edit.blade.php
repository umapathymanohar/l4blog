@extends('layouts.scaffold')

@section('main')

<h1>Edit Category</h1>
{{ Form::model($category, array('method' => 'PATCH', 'route' => array('categories.update', $category->id))) }}
    <ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
           {{ Form::label('parent_id', 'Parent Category:') }}
           {{ Form::select('parent_id', array('0' => 'None')+$categories, $category->parent_id) }}
        </li>

        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('categories.show', 'Cancel', $category->id, array('class' => 'btn')) }}
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop