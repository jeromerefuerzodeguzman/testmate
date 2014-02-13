<?php

class Applicant extends Eloquent {

	protected $fillable = array(
		'question_id',
		'label',
		'name',
		'code'
	);
}