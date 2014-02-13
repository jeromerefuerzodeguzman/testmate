<?php

class ApplicantsController extends BaseController {


	//List all applicants
	public function index() {
		return View::make('applicants.index')
			->with('applicants', Applicant::all());
	}


	//show add applicant form
	public function add() {
		$exams = Exam::lists('title', 'id');
		
		return View::make('applicants.add')
			->with('exams', $exams);
	}


	//create new applicant
	public function create() {
		$applicant = Applicant::try_create(Input::all());

		return $applicant;
	}

	//show view applicant info
	public function view($id) {
		$applicant = Applicant::find($id);
		
		return View::make('applicants.view')
			->with('applicant', $applicant)
			->with('exams', $applicant->exams);
	}




}	