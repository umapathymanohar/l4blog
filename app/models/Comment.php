<?php

class Comment extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'post_id' => 'required',
		'body' => 'required'
	);

	public function post()
    {
        return $this->belongsTo('Post');
    }
}