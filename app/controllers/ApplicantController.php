<?php

class ApplicantController extends BaseController {

	public function index() {
		return View::make('frontend');
	}

	//Code Authentication before the exam starts
	public function codeauth() {
		$code = Applicant::where('code', '=', Input::json('code'))->first();

		if(!is_null($code)) {
			return Response::json(array('code' => $code->code));
		} else {
			return Response::json(array('flash' => 'Invalid Code'));
		}

	}


	//receive a code and get what exam is assigned to it
	public function examquestions($code) {
		
		$data = array();

		//creates a session id
		$ses_id = session_id(); 
		$bsid_exists = false;
		$bsid_exists = Answer::check_session($ses_id); 
		if (!is_null($bsid_exists)){ 
			 //This is a reentry and the session already exists 
			 // create a new session ID and start a new 
			session_regenerate_id();         
			$ses_id = session_id(); 
		}

		//search for applicant's code and exam id
		$applicant = Applicant::where('code', '=', $code)->first();

		//add code in the data array
		$data['applicant_id'] = $applicant->id;
		$data['code'] = $applicant->code;
		$data['session_id'] = $ses_id;
		
		//search and add 'exam' information in the data array
		$exam = Exam::find($applicant->exam_id)->toArray();
		$data = array_merge($data, $exam);
		
		//search for all the sets of the exam
		$sets = Set::where('exam_id', '=', $exam['id'])->get()->toArray();
		
		foreach ($sets as $setkey => $setvalue) {

			$data['sets'][$setkey] = $setvalue;
	
			//search for all the question on each set
			$questions = Question::where('set_id', '=', $setvalue['id'])->get()->toArray();
			
			foreach ($questions as $questionkey => $questionvalue) {
				
				$data['sets'][$setkey]['questions'][$questionkey] = $questionvalue;

				//search for all the choices if the question needs to have a choice
				$choices = Choice::where('question_id', '=', $questionvalue['id'])->get()->toArray();
				
				foreach ($choices as $choicekey => $choicevalue) {
					
					$data['sets'][$setkey]['questions'][$questionkey]['choices'][$choicekey] = $choicevalue;
				}
				
			}

			
		}
		/*echo '<pre>';
		print_r($data);
		echo '</pre>'; */
		return Response::json($data);
	}

	//Update answer if exist and create if not
	public function answer_update() {
		var_dump(Input::all());
		$examinee = Applicant::where('code', '=', Input::json('code'))->first();

		$answer = Answer::check_answer(Input::json('question_id'), $examinee->id, Input::json('session_id'));
		
		if(is_null($answer)) {
			$new = Answer::new_answer($examinee, Input::all());
		} else {
			$update = Answer::find($answer->id);
			$update->label = Input::json('lbl');
			$update->save();
		}

	}


	public function answer_check () {
		$score = 0;
		$applicant = Applicant::find(Input::json('applicant_id'));

		$applicant_answer = Answer::where('session_id', '=', Input::json('session_id'))->get();

		foreach ($applicant_answer as $answer) {
			$question = Question::find($answer->question_id);
			$type = $question->type->name;
			if($type == 'Multiple Choice') {
				$ans = Choice::find($question->answer);
				if(strcasecmp($ans->label, trim($answer->label)) == 0 ) {
					$score++;
				}
			} else {
				if(strcasecmp($question->answer, trim($answer->label)) == 0 ) {
					$score++;
				}
			}
			
		}

		$items = Question::where('exam_id', '=', $applicant->exam_id)->count();
		$score_percent = ($score/$items) * 100;
		$passing = Exam::find($applicant->exam_id);
		if($score_percent >= $passing->passing_score) {
			$remark = "Passed";
		} else	{
			$remark = "Failed";
		}
		

		$data = array(
				'applicant_id' => Input::json('applicant_id'),
				'exam_id' => $applicant->exam_id,
				'session_id' => Input::json('session_id'),
				'score' => $score . '/' . $items,
				'percent' => $score_percent,
				'remark' => $remark
			);

		$result = Result::applicantResult($data);

	}

}	