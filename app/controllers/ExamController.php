<?php

class ExamController extends BaseController {

	public function index() {
		$list = Exam::all();

		return View::make('exams.view')
				->with('lists', $list);
	}

	public function add() {
		return View::make('exams.add');
	}

	public function create() {
		$validation = Exam::validate_new_exam(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_exam_form')->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$exam = Exam::create(array(
				'title' => Input::get('title'),
				'passing_score' => Input::get('passing_score'),
				'duration' => Input::get('duration'),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			));

			return Redirect::to('exam/' . $exam->id)->with('message', 'Exam created successfully!');
		}

	}

	public function delete($id) {
		$exam = Exam::find($id);
		$exam->delete();

		return Redirect::to('exams')
				->with('message', 'Deleted');
	}

	public function settings($id) {
		$exam = Exam::find($id);

		return View::make('exams.settings')
				->with('exam', $exam);
	}

	public function update_settings() {
		$validation = Exam::validate_new_exam(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::back()->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$exam = Exam::find(Input::get('id'));
			$exam->title = Input::get('title');
			$exam->passing_score = Input::get('passing_score');
			$exam->duration = Input::get('duration');
			$exam->save();

			return Redirect::to('/exam/' . $exam->id . '/settings')->with('message', 'Successfully Updated');
		}

	}

	public function show($id) {
		$exam = Exam::find($id);
		$sets = Set::where('exam_id', '=', $id)->get(array('id','name'));
		$questions = Question::where('exam_id', '=', $id)->get();

		return View::make('exams.view_exam')
				->with('sets', $sets)
				->with('questions', $questions)
				->with('exam', $exam);
	}


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

	public function add_question_form($id) {
		$exam = Exam::find($id);
		$set_array = Set::where('exam_id', '=', $id)->get(array('id','name'));
		$type_array = Questiontype::all();

		$sets = parent::convert_to_array($set_array);
		$types = parent::convert_to_array($type_array);

		return View::make('exams.add_question')
				->with('exam', $exam)
				->with('sets', $sets)
				->with('types', $types);
	}
	

	public function add_question() {
		$validation = Question::validate_new_question(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_question_form/' . Input::get('exam_id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			Question::create(array(
					'exam_id' => Input::get('exam_id'),
					'set_id' => Input::get('set_id'),
					'type_id' => Input::get('type_id'),
					'question' => Input::get('question')
				));

			return Redirect::to('view_exam/'. Input::get('exam_id'))->with('message', 'Successfully Create');
		}

	}

	public function delete_question() {
		$exam = Question::find(Input::get('id'));
		$exam->delete();

		Redirect::to('view_exam/'. Input::get('exam_id'))
				->with('message', 'Deleted');
	}


}	