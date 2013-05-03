@extends('layouts.scaffold')

@section('main')

<h1>Create Category</h1>

{{ Form::open(array('route' => 'categories.store')) }}
    <ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>

            
<?php 

echo $categories;
foreach ($categories as $cat){
     $main = $cat->title;
     foreach ($cat->child as $children) {
        $childs[] = $children->title;
     }
$build= array($main => $childs);
}
?>

           
{{ Form::select( 'parent_id', $build) }}
       


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


