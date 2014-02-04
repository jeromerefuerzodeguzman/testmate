<?php

class ChoiceController extends BaseController {

	public function add_choices_form($exam_id,$question_id) {
		$exam = Exam::find($exam_id);
		$question = Question::find($question_id);
		$choices = Choice::where('question_id', '=', $question_id)->get();

		return View::make('exams.add_choices')
			->with('question', $question)
			->with('exam', $exam)
			->with('choices', $choices);

	}

	public function add_choice() {
		$validation = Choice::validate_new_choice(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_choices_form/' . Input::get('exam_id') . '/' . Input::get('question_id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			Choice::create(array(
					'question_id' => Input::get('question_id'),
					'label' => Input::get('label')
				));

			return Redirect::to('add_choices_form/' . Input::get('exam_id') . '/' . Input::get('question_id'))->with('message', 'Successfully Create');
		}
	}


	public function try_update() {
		$validation = Choice::validate_new_choice(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('add_choices_form/' . Input::get('exam_id') . '/' . Input::get('question_id'))->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			Choice::find(Input::get('choice_id'))->update(array('label' => Input::get('label')));

			return Redirect::to('add_choices_form/' . Input::get('exam_id') . '/' . Input::get('question_id'))->with('message', 'Successfully Updated');
		}
	}

}	