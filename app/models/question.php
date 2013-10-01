<?php

class Question extends Eloquent {

	public function type() {
		return $this->belongsTo('Questiontype', 'type_id');
	}

	protected $fillable = array(
			'exam_id',
			'set_id',
			'type_id',
			'question',
			'answer'
		);

	public static function validate_new_question($data) {
		$rules = array(
			'exam_id' => 'required',
			'set_id' => 'required',
			'type_id' => 'required',
			'question' => 'required'
		);

		return Validator::make($data,$rules);
	}

	public static function validate_edit_question($data) {
		$rules = array(
			'answer' => 'required',
			'question' => 'required'
		);

		return Validator::make($data,$rules);
	}
}