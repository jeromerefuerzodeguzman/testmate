<?php

class Answer extends Eloquent {

	protected $fillable = array(
			'question_id',
			'label',
			'choice',
			'applicant_id',
			'code',
			'session_id'
		);

	public static function check_answer($question_id ,$id, $session_id) {
		return Answer::where('question_id', '=', $question_id)
						->where('applicant_id', '=', $id)
						->where('session_id', '=', $session_id)
						->first();
	}

	public static function new_answer($examinee, $input) {
		return Answer::create(array(
						'applicant_id' =>  $examinee->id,
						'question_id' => $input['question_id'],
						'code' => $examinee->code,
						'session_id' => $input['session_id'],
						'label' => $input['lbl']
				));
	}


	public static function check_session($id) {
		return Answer::where('session_id', '=', $id)->first();
	}

	
}