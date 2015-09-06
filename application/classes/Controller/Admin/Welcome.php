<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Welcome extends Controller_Admin_Base {

	public function action_index()
	{
		$auth = Auth::instance();

		if($auth->logged_in() || $auth->auto_login())
		{
			HTTP::redirect("/admin/dashboard/index");
		}

		$this->lv("admin/welcome/index");
	}


	public function action_login()
	{
		if($this->request->method() == "POST")
		{
			$auth = Auth::instance();

			try{
				$rem = $this->request->post('rem') == 1 ? true : 0;
				$success = $auth->login($this->request->post('username'), $this->request->post('password'), $rem);
				if($success)
				{
					$this->jsReturn(1);
				}
			}
			catch(ORM_Validation_Exception $e)
			{
				$this->jsReturn(0, "数据库操作异常");
			}
			
			if(!$success)
			{
				$this->jsReturn(0, "用户名或密码错误");
			}
		}
		$this->jsReturn(0, "非法操作");
	}

	public function action_logout()
	{
		Auth::instance()->logout();
		HTTP::redirect("/admin/welcome/index");
	}
}
