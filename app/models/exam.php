<?php

class Exam extends Eloquent {

	public function sets() {
        return $this->hasMany('Set');
    }


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

	public static function try_create($inputs) {
		$rules = array(
			'title' => 'required',
			'passing_score' => 'required',
			'duration' => 'required'
		);

		$validation = Validator::make($inputs, $rules);

		if($validation->fails()) {
			$failed = $validation->failed();

			return  Redirect::back()->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$exam = Exam::create(array(
				'title' => Input::get('title'),
				'passing_score' => Input::get('passing_score'),
				'duration' => Input::get('duration')
			));

			return Redirect::to('exams')->with('message', 'Exam added successfully');
		}
	}
}