<?php

class Result extends Eloquent {

	protected $fillable = array(
			'applicant_id',
			'exam_id',
			'session_id',
			'score',
			'percent',
			'remark'
		);

	public static function applicantResult ($data) {
		return Result::create(array(
			'applicant_id' =>  $data['applicant_id'],
			'exam_id' => $data['exam_id'],
			'session_id' => $data['session_id'],
			'score' => $data['score'],
			'percent' => $data['percent'],
			'remark' => $data['remark'],
			));

	}
}