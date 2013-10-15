<?php

class SetController extends BaseController {

	public function add($id) {
		$exam = Exam::find($id);

		return View::make('exams.add_set')
				->with('exam', $exam);
	}

	public function create() {
		$validation = Set::validate_new_set(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_set_form/' . Input::get('exam_id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$set = Set::create(array(
				'exam_id' => Input::get('exam_id'),
				'name' => Input::get('name')
			));

			return Redirect::to('/exam/'. $set->exam_id)->with('message', 'Successfully Create');
		}

	}

}	