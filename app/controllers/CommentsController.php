<?php

class CommentsController extends BaseController {

    /**
     * Comment Repository
     *
     * @var Comment
     */
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($post_id)
    {
        //$post = Post::find($post_id);
        $comments = $this->comment->where('post_id', '=', $post_id)->get();
        //$comments = Post::find($post_id)->comments;

        //return Response::json($comments);

        return View::make('comments.index', compact('comments'))->with(array('post_id'=> $post_id));
        //return View::make('comments.index', compact('comments', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($post_id)
    {
        return View::make('comments.create')->with('post_id', $post_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($post_id)
    {
        $input = Input::all();
        $validation = Validator::make($input, Comment::$rules);

        if ($validation->passes())
        {
            $this->comment->create($input);

            return Redirect::route('posts.comments.index', $post_id);
        }

        return Redirect::route('posts.comments.create', $post_id)
            ->withInput()
            ->withErrors($validation)
            ->with('flash', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($post_id, $comment_id)
    {
        $comment = $this->comment->where('post_id', '=', $post_id)->where('id', '=', $comment_id)->first();

        return View::make('comments.show', compact('comment'))->with('post_id', $post_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($post_id, $comment_id)
    {
        $comment = $this->comment->find($comment_id);

        if (is_null($comment))
        {
            return Redirect::route('posts.comments.index', $post_id);
        }

        return View::make('comments.edit', compact('comment'))->with('post_id', $post_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($post_id, $comment_id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Comment::$rules);

        if ($validation->passes())
        {
            $comment = $this->comment->find($comment_id);
            $comment->update($input);

            return Redirect::route('posts.comments.show', array($post_id, $comment_id));
        }

        return Redirect::route('posts.comments.edit', array($post_id, $comment_id))
            ->withInput()
            ->withErrors($validation)
            ->with('flash', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->comment->find($id)->delete();

        return Redirect::route('posts.comments.index');
    }

}