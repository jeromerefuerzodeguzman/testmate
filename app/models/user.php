<?php

class User extends Eloquent {

	public static function validate_login($data) {
		$rules = array(
			'username' => 'required',
			'password' => 'required'
		);

		return Validator::make($data,$rules);
	}
}