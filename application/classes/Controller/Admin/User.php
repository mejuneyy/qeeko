<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Admin_Base {

	public function action_list()
	{
		$auth = Auth::instance();
		$this->cv('admin/user/list');
	}

	public function action_edit()
	{
		$user_id = $this->request->param('id');
		$userModel = ORM::factory('User', $user_id);
		if(!$userModel->loaded())
		{
			$this->showError("用户不存在，请误非法操作");
		}

		$data['user'] = $userModel->object();
		$data['opt'] = "编辑";
		$this->cv('admin/user/edit', $data);
	}

	public function action_add()
	{
		$data['opt'] = "增加";
		$this->cv('admin/user/edit', $data);
	}

	public function action_ajax_do_user()
	{
		if($this->request->method() == "POST")
		{
			$post = $this->request->post();
			
			try {

				if(isset($post['id']) && !empty($post['id']))
				{
					$userModel = ORM::factory('User', $post['id'])->update_user($post);
				}
				else
				{
					$userModel = ORM::factory('User');
					$post['created'] = time();
					$userModel = ORM::factory('User', $post['id'])->create_user($post, array('username','password','mobile','email','created'));
				}
				$this->jsReturn(1);
			}
			catch (ORM_Validation_Exception $e)
	        {
	            $errors = $e->errors('models');
	            $err = $this->formatOrmValErrors($errors);
	            $this->jsReturn(0, $err);
	        }
			
		}
		$this->jsReturn(0, "非法操作");
	}

	public function action_ajax_get_list()
	{
		$userModel = ORM::factory("User");
		//搜索key
		$this->_doParams($userModel);
		$total = $userModel->count_all();
		//count_all函数会reset操作sql，得重新初始化key
		$this->_doParams($userModel);
		$userList = $userModel->order_by('id', 'desc')->offset($this->request->query('start'))->limit($this->request->query('length'))->find_all();
		$userList = $this->get_array($userList);
		$_userList = array();
		foreach ($userList as $user) {
			$user['last_login'] = $user['last_login'] == 0 ? "-" : date('Y-m-d H:i:s', $user['last_login']);
			$user['created'] = date('Y-m-d H:i:s', $user['created']);
			$user['optHref'] = $this->getOptUserHref('user', $user['id']);
			$user['DT_RowId'] = "user_{$user['id']}";
			$_userList[] = $user;
		}
		$this->pageReturn($total, $_userList);
	}

	public function action_ajax_del_one()
	{
		if($this->request->method() == "POST")
		{
			$user = ORM::factory('User', $this->request->post('id'));
			if($user->delete())
			{
				$this->jsReturn(1);
			}
		}
		$this->jsReturn(0, "非法操作");
	}

	protected function _doParams($model)
	{
		$k = $this->request->query('search');
		if(!empty($k['value']))
		{
			$k = $this->request->query('search');
			$model->where_open();
			$model->where('username', 'like', "%{$k['value']}%");
			$model->or_where('mobile', 'like', "%{$k['value']}%");
			$model->or_where('email', 'like', "%{$k['value']}%");
			$model->where_close();
		}
	}
}