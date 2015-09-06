<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Common extends Controller {

	public function __construct(Request $request, Response $response)
	{
		parent::__construct($request, $response);
	}

	//加载视图
	public function lv($view, $data = null)
	{
		$body = View::factory($view);
		$body->set($data);
		$this->response->body($body);
	}

	public function jsReturn($ret, $msg = '', $data = array())
	{
		header('Content-type: application/json');
		echo json_encode(array('ret'=> $ret, 'msg'=> $msg, 'data'=>$data));
		exit;
	}


	public function pageReturn($total, $pageData)
	{
		header('Content-type: application/json');
		$page = array(
			"draw" => intval($_GET['draw']),
			"recordsTotal" => $total,
			"recordsFiltered" => $total,
			"data" => $pageData
		);
		echo json_encode($page);
		exit;
	}

	public function get_array($array)
	{
		$a = array();
		foreach ($array as $k) {
			$a[] = $k->object();
		}
		return $a;
	}
} 
