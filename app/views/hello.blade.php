<h1>Hello World!</h1>

@if ($post->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
				<th>Body</th>
            </tr>
        </thead>

        <tbody>
            
                <tr>
                    <td>{{ link_to_route('posts.show', $post->title, array($post->id)) }}</td>
					<td>{{ $post->body }}</td>
                    <td>{{ link_to_route('posts.comments.index', 'Comments '.$post->comments()->count(), array($post->id)) }}</td>
                    <td>{{ link_to_route('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('posts.destroy', $post->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>

                @foreach ($post->comments as $comment)
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
    There are no posts
@endif