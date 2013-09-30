<?php

class Exam extends Eloquent {

	protected $fillable = array(
			'title',
			'passing_score',
			'duration'
		);

	public static function validate_new_exam($data) {
		$rules = array(
			'title' => 'required',
			'passing_score' => 'required|numeric',
			'duration' => 'required|numeric'
		);

		return Validator::make($data,$rules);
	}
}