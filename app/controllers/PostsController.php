<?php

class PostsController extends BaseController {

    /**
     * Post Repository
     *
     * @var Post
     */
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->post->all();
        //$posts = Post::with('comments')->get();

        return View::make('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // get all categories and send as array for dropdown list
        //$categories = Category::lists('title', 'id');

        $categories = Category::all();

        //return View::make('posts.create', compact('categories'));

        return View::make('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::except('category');
        // get the selected option from dropdown list
        $selected_option = Input::get('category');
        $validation = Validator::make($input, Post::$rules);

        if ($validation->passes())
        {
            $post = $this->post->create($input);

            //add category in pivot table
            $post->categories()->attach($selected_option);

            return Redirect::route('posts.index');
        }

        return Redirect::route('posts.create')
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
    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        //$comments = Comment::where('post_id', '=', $id)->get();
        //return View::make('posts.show', compact('post', 'comments'));

        return View::make('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        // get all categories and send as array for dropdown list
        $categories = Category::lists('title', 'id');
        // get the selected category from DB
        $selected_category = Post::find($id)->categories->first()->pivot->category_id;

        if (is_null($post))
        {
            return Redirect::route('posts.index');
        }

        return View::make('posts.edit', compact('post', 'categories', 'selected_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::except('category'), '_method');
        // get the selected option from dropdown list
        $selected_option = Input::get('category');
        $validation = Validator::make($input, Post::$rules);

        if ($validation->passes())
        {
            $post = $this->post->find($id);
            $post->update($input);

            //update category

            $post->categories()->sync(array($selected_option));

            return Redirect::route('posts.show', $id);
        }

        return Redirect::route('posts.edit', $id)
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
        
        // remove category relation in pivot table category_post
        $post = $this->post->find($id);
        $post->categories()->detach($id);

        $post->delete();
        $post->comments()->delete();

        return Redirect::route('posts.index');
    }

}