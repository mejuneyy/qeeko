<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Base extends Controller_Common {

	public $_user;

	public function __construct(Request $request, Response $response)
	{
		parent::__construct($request, $response);

		if(!Auth::instance()->logged_in())
		{
			if($this->request->controller() != "Welcome")
			{
				HTTP::redirect("/admin/welcome/logout");
			}
		}
		else
		{
			$auth = Auth::instance()->get_user();
			$this->_user = $auth->object();	
		}
	}


	public function cv($view, $data = null)
	{
		$global_view = View::factory('admin/global/index');
		$global_view->_user = $this->_user;
	    $global_view->title = "QeeKo Demo";
	    $global_view->content = View::factory($view);
	    $global_view->content->set($data);
	    $this->response->body($global_view);
	}

	//列表操作链接
	public function getOptUserHref($model, $id)
	{
		return "<a href='/admin/{$model}/edit/{$id}'>编辑</a> <a dataval='{$id}' class='delOne' href='javascript:;' >删除</a>";
	}

	public function showError($msg)
	{
		$view = View::factory("admin/global/500");
		$view->msg = $msg;
	    $this->response->body($view);
	}

	public function formatOrmValErrors($e)
	{
		$err = '';
		foreach ($e as $k=>$v) {
			if(is_array($v))
			{
				foreach($v as $vv)
				{
					$err.= $vv."<br/>";
				}
			}
			else{
				$err.= $v."<br/>";
			}
		}
		return $err;
	}
} 
