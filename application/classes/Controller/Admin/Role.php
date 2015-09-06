<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Role extends Controller_Admin_Base {

	public function action_index()
	{
		$auth = Auth::instance();
		$this->cv('admin/dashboard/index');
	}
	
}