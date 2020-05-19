<?php 
// namespace é o nome da pasta raiz
namespace Hcode;
//Quando se usa outra classe de outro namespace faz isso abaixo para para qndo char um neu tpl ele identifica e q é da quela classe
use Rain\Tpl;

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [ //rota padrão para o header e o footer
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];
	//criação das variaveis de acordo com a rota, se não pode definir as rotas padrões caso n receba nada
	public function __construct($opts = array(), $tpl_dir = "/views/") {

		$this->defaults["data"]["session"] = $_SESSION;
		//junda as informações passadas com os defaults, esse array_merge um sobrescreve o outro, $opts ele vai sobrescrever o default no caso de conflito,
		$this->options = array_merge($this->defaults, $opts);

		$config = array(//=> apartir do diretorio rro do projeto procura a pastal tal, DOCUMENT_ROOT traz onde esta a pasta o diretorio root do servidor configurado. ."onde esta o seu tamplete"
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"			=> false
		);

		Tpl::configure( $config );
		//para ser usado o tpl em outros metodos coloca o $this antes dele, pq ele vai ser um atributo da classe.
		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);
		//validando a chamada do header
		if ($this->options["header"] === true) $this->tpl->draw("header");

	}
	//serve para tirar as repetições do foreach.
	private function setData($data = array())
	{
		//os dados vai estar na chave data desse opts.
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}
	//metodo para html do conteudo
	public function setTpl($name, $data = array(), $returnHTML = false)
	{

		$this->setData($data);
		//desenhar o template na tela passado pelo $name eo retorno do HTML
		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct() {
		//validando a chamada do footer
		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}
}

 ?>