<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Common {

	public function __construct(Request $request, Response $response)
	{
		parent::__construct($request, $response);
	}

} 
