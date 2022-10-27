<?php
namespace Controller;

use \Core\Controller;
use \Model\Users;
use \Model\Companies;


class HomeController extends Controller {

	
    public function index() {
        
        $data = array(
			'error' => ''
		);
		$this->loadTemplate('home', $data);
    }


}