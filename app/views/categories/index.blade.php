@extends('layouts.scaffold')

@section('main')

<h1>All Categories</h1>

<p>{{ link_to_route('categories.create', 'Add new category') }}</p>

@if ($categories->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->category_order }} </td>
                    <td width="60">
                        @unless ($category->id == 1) 
                            <a href="{{ URL::route('categories.order', [$category->id, 'up']) }}" class="btn btn-small">↑</a> 
                            <a href="{{ URL::route('categories.order', [$category->id, 'down']) }}" class="btn btn-small">↓</a>
                        @endunless
                    </td>
                    <td>{{ $category->title }}</td>
                    <td>
                        @unless ($category->id == 1) 
                            {{ link_to_route('categories.edit', 'Edit', array($category->id), array('class' => 'btn btn-info')) }} 
                        @endunless
                    </td>
                    <td>
                        @unless ($category->id == 1) 
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('categories.destroy', $category->id))) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        @endunless
                    </td>
                </tr>
                
                
                
                @foreach ($category->children as $child)  
                <tr>
                    <td>{{ $child->id }}</td>
                    <td>{{ $child->category_order }}</td>
                     <td width="60"><a href="{{ URL::route('categories.order', [$child->id, 'up']) }}" class="btn btn-small">↑</a> <a href="{{ URL::route('categories.order', [$child->id, 'down']) }}" class="btn btn-small">↓</a></td>
                    <td style="padding-left:30px">⌊ {{ $child->title }}</td>
                    <td>{{ link_to_route('categories.edit', 'Edit', array($child->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('categories.destroy', $child->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@else
    There are no categories
@endif

@stop