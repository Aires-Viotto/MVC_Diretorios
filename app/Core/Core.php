<?php
namespace Core;

class Core {

	public function run() {

		$url = '/';
		if(isset($_GET['url'])){
			$url .= $_GET['url'];
		}

		//$url = $this->checkRoutes($url);
		$params = array();

		if(!empty($url) && $url != '/') {
			$url = explode('/', $url);//pega o valor do endereço anterior
			array_shift($url);//desmonta o endereço anterior
		

			$currentController = $url[0].'Controller';//recebe o nome do endereço e concatena com o seu Controller
			array_shift($url);//desmonta o endereço anterior.

			if(isset($url[0]) && !empty($url[0])) {
				$currentAction = $url[0];
				array_shift($url);
			}else{
				$currentAction = 'index';
			}

			if(count($url) > 0){
				$params = $url;
			}

		}else{
			//esse é o controller de acesso que o index chama ao acessar o link
			$currentController = 'HomeController';
			$currentAction = 'index';
		}

		$currentController = ucfirst($currentController);

		$prefix = '\Controller\\';

		if(!file_exists('Controller/'.$currentController.'.php') ||
			!method_exists($prefix.$currentController, $currentAction)){
			
			$currentController = 'NotFoundController';
			$currentAction = 'index';
		}

		$newController = $prefix.$currentController;

		$c = new $newController();

		call_user_func_array(array($c, $currentAction), $params);

	}

	public function checkRoutes($url) {
		global $routers;

		foreach($routers as $pt => $newurl) {

			// Identifica os argumentos e substitui por regex
			$pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $pt);

			// Faz o match da URL
			if(preg_match('#^('.$pattern.')*$#i', $url, $matches) === 1) {
				array_shift($matches);
				array_shift($matches);

				// Pega todos os argumentos para associar
				$itens = array();
				if(preg_match_all('(\{[a-z0-9]{1,}\})', $pt, $m)) {
					$itens = preg_replace('(\{|\})', '', $m[0]);
				}

				// Faz a associação
				$arg = array();
				foreach($matches as $key => $match) {
					$arg[$itens[$key]] = $match;
				}

				// Monta a nova url
				foreach($arg as $argkey => $argvalue) {
					$newurl = str_replace(':'.$argkey, $argvalue, $newurl);
				}

				$url = $newurl;
				break;

			}

		}
		return $url;
	}
}