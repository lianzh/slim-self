<?php

namespace SelfApp\Controller;

use Psr\Container\ContainerInterface;

abstract class BaseController
{

	/**
	 * 容器对象
	 * 
	 * @var ContainerInterface
	 */
	protected $app = null;

	/**
	 * 视图对象
	 * 
	 * @var array
	 */
	protected $viewData = [];

	/**
	 * 构造函数
	 * 
	 * @param ContainerInterface $ci
	 */
	public function __construct(ContainerInterface $app)
	{
    	$this->app = $app;
    	$this->init();
	}

	/**
	 * 子类覆盖
	 */
	protected function init()
	{
		$this->viewData = [];
	}

	public function view($response, $template)
	{
		return $this->app->renderer->render($response, $template, (array) $this->viewData);	
	}

	public function test($request, $response, $args) {
        // var_dump(get_class($this));
        // // print_r(func_get_args());

        print_r(func_get_args());
   	}


}