<?php

class Set extends Eloquent {

	protected $fillable = array(
			'exam_id',
			'name'
		);

	public static function validate_new_set($data) {
		$rules = array(
			'name' => 'required'
		);

		return Validator::make($data,$rules);
	}
}