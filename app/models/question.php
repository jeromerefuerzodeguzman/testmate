<?php

class Question extends Eloquent {

	public function type() {
		return $this->belongsTo('Questiontype', 'type_id');
	}

	public function choice() {
		return $this->belongsTo('Choice', 'id', 'answer');
	}

	protected $fillable = array(
			'exam_id',
			'set_id',
			'type_id',
			'question',
			'answer'
		);

	public static function validate_edit_question($data) {
		$rules = array(
			'answer' => 'required',
			'question' => 'required'
		);

		return Validator::make($data,$rules);
	}

	public static function make($input) {
		//map type_id
		$type_id = Questiontype::where('name', '=', $input['type'])->first();
		if($type_id == NULL) {
			//return var_dump($input);
			return Redirect::back()->with('error', 'Invalid Question Type')->withInput();
		}
		$input['type_id'] = $type_id->id;
		//return var_dump($input);
		//validate fields
		$rules = array(
			'exam_id' => 'required',
			'set_id' => 'required',
			'type_id' => 'required',
			'question' => 'required'
		);

		var_dump($type_id->name);

		//add required field for answer if Fill in the blanks
		if($type_id->name == 'Fill in the Blank') {
			$rules['answer'] = 'required';
		}

		$validation = Validator::make($input, $rules);

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::back()->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$question = Question::create($input);

			return Redirect::to('/exam/'. $question->exam_id)->with('message', 'Question successfully created');
		}
	}

	public static function modify($input) {
		$rules = array(
			//'answer' => 'required',
			'question' => 'required'
		);
		$validation = Validator::make($input,$rules);

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::back()->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$question = Question::find($input['question_id']);
			$question->question = $input['question'];
			$question->set_id = $input['set_id'];

			if($question->type->name == 'Fill in the Blank') {
				$question->answer = $input['answer'];
			}
			
			//$question->answer = $input['answer'];
			$question->save();

			return Redirect::to('/exam/'. $question->exam_id)->with('message', 'Question successfully updated');
		}
	}


	public static function set_answer($id, $answer) {

			$question = Question::find($id);
			$question->answer = $answer;
			$question->save();

			return Redirect::back()->with('message', 'Answer successfully updated');
	}

	public static function remove($id) {
		$question = Question::find($id);
		$question->delete();

		//also delete choices if there's any
		Choice::where('question_id', '=', $id)->delete();

		return Redirect::back()
			->with('message', 'Question deleted!');
	}
}