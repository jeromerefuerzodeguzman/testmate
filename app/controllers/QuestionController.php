<?php

class QuestionController extends BaseController {

	public function add($id) {
		$exam = Exam::find($id);
		//$set_array = Set::where('exam_id', '=', $id)->get(array('id','name'));
		$type_array = Questiontype::all();

		$sets = parent::convert_to_array($exam->sets);
		$types = parent::convert_to_array($type_array);

		return View::make('exams.add_question')
				->with('exam', $exam)
				->with('sets', $sets)
				->with('types', $types);
	}
	

	public function create() {
		$validation = Question::validate_new_question(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::back()->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$question = Question::create(array(
				'exam_id' => Input::get('exam_id'),
				'set_id' => Input::get('set_id'),
				'type_id' => Input::get('type_id'),
				'question' => Input::get('question')
			));

			return Redirect::to('/question/'. $question->id . '/edit')->with('message', 'Question successfully created');
		}

	}

	public function delete_question() {
		$exam = Question::find(Input::get('id'));
		$exam->delete();

		Redirect::to('view_exam/'. Input::get('exam_id'))
				->with('message', 'Deleted');
	}

	public function edit($question_id) {
		$question = Question::find($question_id);
		$exam = Exam::find($question->exam_id);
		$choices = Choice::where('question_id', '=', $question_id)->get(array('label'));

		$holder = array('' => '');
		foreach ($choices as $type) {
			$holder[$type->label] = $type->label;
		}

		$type_array = Questiontype::all();
		$types = parent::convert_to_array($type_array);
		$sets = parent::convert_to_array($exam->sets);

		return View::make('exams.edit_question')
				->with('question', $question)
				->with('exam', $exam)
				->with('types', $types)
				->with('sets', $sets)
				->with('choices', $holder);

	}


	public function update() {
		$validation = Question::validate_edit_question(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('edit_question_form/'. Input::get('exam_id') . '/' . Input::get('question_id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$question = Question::find(Input::get('question_id'));
			$question->question = Input::get('question');
			$question->answer = Input::get('answer');
			$question->save();

			return Redirect::to('view_exam/'. Input::get('exam_id'))->with('message', 'Successfully Create');
		}

	}



}	