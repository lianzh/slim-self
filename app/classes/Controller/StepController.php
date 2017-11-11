<?php

namespace SelfApp\Controller;

use SelfApp\Helper\Debuger;
use SelfApp\Helper\Arrays;

class StepController extends BaseController
{

	public function index($request, $response, $args)
    {
        //your code
        //to access items in the container... $this->container->get('');
        
        
        // Debuger::dump($this->app);

        // Debuger::dump(func_get_args());
        
        $arr = $this->app->db->sqlMaster()->getDataSource()->all('show tables');

        Debuger::dump($arr);
		
		$this->viewData['get'] = $_GET;
		$this->viewData['name'] = '申昊晨';
		$this->viewData['mn'] = Arrays::val($args, 'mn');

        return $this->view($response, 'step/index.phtml');
   	}

}