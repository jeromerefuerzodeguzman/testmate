<?php

class ApplicantsController extends BaseController {


	//List all applicants
	public function index() {
		return View::make('applicants.index')
			->with('applicants', Applicant::all());
	}



}	