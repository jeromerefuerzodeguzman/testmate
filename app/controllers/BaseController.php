<?php

class BaseController extends Controller {

	public function convert_to_array($list) {
                $holder = array('' => '');
                foreach ($list as $type) {
                        $holder[$type->id] = $type->name;
                }
                return $holder;
        }

	
}