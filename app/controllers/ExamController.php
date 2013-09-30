<?php

class ExamController extends BaseController {

	public function view() {
		$list = Exam::all();

		return View::make('exams.view')
				->with('lists', $list);
	}

	public function add_form() {
		return View::make('exams.add');
	}

	public function add() {
		$validation = Exam::validate_new_exam(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_exam_form')->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			Exam::create(array(
					'title' => Input::get('title'),
					'passing_score' => Input::get('passing_score'),
					'duration' => Input::get('duration'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				));

			return Redirect::to('all_exams')->with('message', 'Successfully Create');
		}

	}

	public function delete() {
		$exam = Exam::find(Input::get('id'));
		$exam->delete();

		Redirect::to('all_exams')
				->with('message', 'Deleted');
	}

	public function view_settings($id) {
		$exam = Exam::find($id);

		return View::make('exams.settings')
				->with('exam', $exam);
	}

	public function update_settings() {
		$validation = Exam::validate_new_exam(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('exam_settings/' . Input::get('id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$exam = Exam::find(Input::get('id'));
			$exam->title = Input::get('title');
			$exam->passing_score = Input::get('passing_score');
			$exam->duration = Input::get('duration');
			$exam->save();

			return Redirect::to('all_exams')->with('message', 'Successfully Updated');
		}

	}
}	