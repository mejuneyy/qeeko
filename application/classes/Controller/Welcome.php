<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
		//$this->response->body('hello, world!');
		$data = array(
			"hello" => "hello world"
		);
		$this->lv("welcome/index", $data);
	}
}
