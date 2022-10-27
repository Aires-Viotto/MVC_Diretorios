<?php 
namespace Core;

class Language {

	private $l;
	private $ini;

	public function __construct(){
		global $config;//variavel config sendo recebida lá do arquivo config.php.

		$this->l = $config['default_lang'];//recebo a linguagem padrão setada no config.

		//verifico se a sessão não está vazia e se o arquivo da linguagem existe
		if(!empty($_SESSION['lang']) && file_exists('lang/'.$_SESSION['lang'].'.ini')){
			$this->l = $_SESSION['lang'];//passo o arquivo para a sessão.
		}

		//pego o arquivo e transformo ele de .ini em um array para manipular com o PHP
		$this->ini = parse_ini_file('../app/lang/'.$this->l.'.ini');
	}

	//método para pegar as palavras
	public function get($word, $return = false){
		//pego a palavra passada no arquivo e armazeno em $text
		$text = $word;

		//verifico se ela está setada no array e pego o valor dela vindo na variável $word
		if(isset($this->ini[$word])){
			$text = $this->ini[$word];//se está setada eu jogo ela pra $text
		}

		if($return){//se o retorno for verdadeiro, isto é, existe, eu retorno a palavra.
			return $text;
		}else{
			echo $text;//se nao eu retorno o echo ela normal sem puxar nada do dicionário.
		}
	}
}