<?php

class CategoriesController extends BaseController {

    /**
     * Category Repository
     *
     * @var Category
     */
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        $categories = $this->category->with('child')->where('parent_id', '0')->get(array('title', 'id'));
        
        

//        return Response::json($categories);

        return View::make('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // get all categories and send as array for dropdown list
         //$categories = $this->category->with('child')->where('parent_id', '0')->get(array('title', 'id'));
        
       
       //$categories = $this->category->where('parent_id', '==', 0)->lists('title', 'id');
       $categories = $this->category->with('child')->where('parent_id', '0')->get(array('title', 'id'));

        return View::make('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Category::$rules);

        if ($validation->passes())
        {
            $category = $this->category->create($input);
            if ( $category->id ) {
                $category->category_order = $category->id;
                $category->save();
            }

            return Redirect::route('categories.index');
        }

        return Redirect::route('categories.create')
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
        $category = $this->category->findOrFail($id);

        // get all post related to category
        //return Category::find($id)->posts;

        return View::make('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);

        // get all categories and send as array for dropdown list
        $categories = $this->category->where('parent_id', '=', 0)->where('id', '!=', $id)->lists('title', 'id');

        if (is_null($category))
        {
            return Redirect::route('categories.index');
        }

        return View::make('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Category::$rules);

        if ($validation->passes())
        {
            $category = $this->category->find($id);
            $category->update($input);

            return Redirect::route('categories.show', $id);
        }

        return Redirect::route('categories.edit', $id)
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
        
        // check if have children and update to parent
        $category = $this->category->find($id);

        if ($category->parent_id == 0) {
            $children = $this->category->where('parent_id', '=', $id)->get();

            foreach ($children as $child) {
                $child->parent_id = 0;
                $child->save();
            } 
        }

        //add category in pivot table
        $posts = $category->posts()->get();

        foreach ($posts as $post) {
            // update to uncategorized
            $post->categories()->sync(array(1));
        }
        

        // delete category
        $category->delete();

        return Redirect::route('categories.index');
    }

    /**
     * Update the order specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function change_category_order($category_id, $move)
    {

        $currentCategory = $this->category->find($category_id);

        $currentCategoryOrder = $currentCategory->category_order;
        
        $parent_id =  $currentCategory->parent_id;

        if ($move == 'up') {
            
            $nextCategoryOrder = Category::where('parent_id', '=', $parent_id)->where('category_order', '>', $currentCategoryOrder)->min('category_order');
            $swapCategoryOrder = $nextCategoryOrder;

           if ( isset($nextCategoryOrder) )
           {
               // get the next record for the current category
                $nextCategory = $this->category->where('parent_id', '=', $parent_id)->where('category_order', '=', $nextCategoryOrder)->first();
                
                $swapCategory = $nextCategory;
            }
            

        } elseif ($move == 'down') {

            $prevCategoryOrder = Category::where('parent_id', '=', $parent_id)->where('category_order', '<', $currentCategoryOrder)->max('category_order');
            $swapCategoryOrder = $prevCategoryOrder;

            if ( isset($prevCategoryOrder) )
            {
               // get the previous record for the current category
                $prevCategory = $this->category->where('parent_id', '=', $parent_id)->where('category_order', '=', $prevCategoryOrder)->first();
                
                $swapCategory = $prevCategory;
            }
        }

        if ( isset($swapCategory) ) {
            
            $currentCategory->category_order = $swapCategoryOrder;
            $currentCategory->save();

            $swapCategory->category_order = $currentCategoryOrder;
            $swapCategory->save();
        }

        return Redirect::route('categories.index');
    }

}