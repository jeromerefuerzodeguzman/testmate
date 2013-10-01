<?php

class SetController extends BaseController {

	public function add_set_form($id) {
		$exam = Exam::find($id);

		return View::make('exams.add_set')
				->with('exam', $exam);
	}

	public function add_set() {
		$validation = Set::validate_new_set(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_set_form/' . Input::get('exam_id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			Set::create(array(
					'exam_id' => Input::get('exam_id'),
					'name' => Input::get('name')
				));

			return Redirect::to('view_exam/'. Input::get('exam_id'))->with('message', 'Successfully Create');
		}

	}

}	