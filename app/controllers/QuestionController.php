<?php

class QuestionController extends BaseController {

	public function add($id, $type, $set_id = 0) {
		$exam = Exam::find($id);
		$sets = parent::convert_to_array($exam->sets);

		return View::make('question.add')
			->with('exam', $exam)
			->with('sets', $sets)
			->with('set_id', $set_id)
			->with('type', $type);
	}
	
	public function create() {
		$question = Question::make(Input::all());

		return $question;
	}

	public function edit($id) {
		$question = Question::find($id);
		$exam = Exam::find($question->exam_id);
		$sets = parent::convert_to_array($exam->sets);

		return View::make('question.edit')
			->with('exam', $exam)
			->with('sets', $sets)
			->with('question', $question);
	}

	public function update() {
		$question = Question::modify(Input::all());

		return $question;
	}

	public function answer($id) {
		$question = Question::set_answer($id, Input::get('answer'));

		return $question;
	}

	public function remove($id) {
		$question = Question::remove($id);
		
		return $question;
		
	}

}	