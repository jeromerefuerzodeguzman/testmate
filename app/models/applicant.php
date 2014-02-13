<?php

class Applicant extends Eloquent {

	protected $fillable = array(
		'exam_id',
		'name',
		'code'
	);

	public function exam() {
        return $this->belongsTo('Exam');
    }


	//create new applicant
	public static function try_create($inputs) {
		$rules = array(
			'name' => 'required',
			'exam_id' => 'required'
		);

		$validation = Validator::make($inputs, $rules);

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::back()->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$applicant = Applicant::create(array(
				'exam_id' => Input::get('exam_id'),
				'name' => Input::get('name')
			));

			//generate code
			$code = date('Ymd') . '-' . $applicant->id;
			$applicant->code = $code;
			$applicant->save();

			return Redirect::to('applicants')->with('message', 'Applicant added successfully');
		}
	}
}