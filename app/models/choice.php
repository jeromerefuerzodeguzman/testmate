<?php

class Choice extends Eloquent {

	protected $fillable = array(
			'question_id',
			'label'
		);

	public static function validate_new_choice($data) {
		$rules = array(
			'label' => 'required',
		);

		return Validator::make($data,$rules);
	}

}