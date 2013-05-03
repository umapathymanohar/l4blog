<?php

class Category extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'title' => 'required'
	);

	public function posts()
    {
        return $this->belongsToMany('Post');
    }

    // public function parent()
    // {
    //     return $this->hasOne('Category', 'id', 'parent_id');
    // }

    public function children()
    {
        return $this->hasMany('Category', 'parent_id')->orderBy('category_order', 'desc');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', 0)->orderBy('category_order', 'desc')->get();
    }


    public function child()
    {
        return $this->hasMany('Category', 'parent_id', 'id')->orderBy('category_order', 'desc')->select(array('title', 'id','parent_id'));
    }

}