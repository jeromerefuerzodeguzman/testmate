<?php

class UserController extends BaseController {

	public function login() {
		return View::make('users.login');
	}

	public function logout() {
		Auth::logout();

		return Redirect::to('admin_login');
	}

	public function authenticate() {
		$validation = User::validate_login(Input::all());

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('admin_login')->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$credentials = array(
			  'username' => Input::get('username'),
			  'password' => Input::get('password')
			);

			if (Auth::attempt($credentials)) {
				if (Session::get('redir_url')) {
					$baseURL = URL::to('/');
					$route = explode($baseURL, Session::get('redir_url'));
					return Redirect::to($route[1]);
				} else {
					return Redirect::to('/');
				}
			} else {
				return Redirect::to('admin_login')
		            ->with('flash_error', 'Your username/password was incorrect.')
		            ->withInput();
			}

		}

	}

}	