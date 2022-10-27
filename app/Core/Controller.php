<?php
namespace Core;

class Controller {

	protected $lang;

	public function __construct(){
		global $config;
		$this->lang = new Language();
	}

	public function loadView($viewName, $viewData = array()){
		extract($viewData);
		require '../app/Views/'.$viewName.'.php';
	}
	public function loadTemplate($viewName, $viewData = array()){
		require '../app/Views/template.php';
	}

	public function loadTemplateSite($viewName, $viewData = array()){
		require '../app/Views/site.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array()) {
		extract($viewData);
		require '../app/Views/'.$viewName.'.php';
	}
}