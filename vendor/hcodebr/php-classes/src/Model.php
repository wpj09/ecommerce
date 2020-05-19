<?php 

namespace Hcode;

class Model {
	//$values conten todos os valores doss campos que tem dentro do objeto
	private $values = [];
	//__call metodo magico para identificar qundo o metodo é chamado.
	public function __call($name, $args)
	{
		//identificadores par contar o nome dos metodos a serem chamados contando suas letras.
		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));//usado para descobrir o nome do campo que foi chamado, descartando os 3 primeiro e pegando o restante.
		//identificado se o metodo requisitado é get (traz e retorna) ou set (atribuir valor)
		switch ($method)
		{

			case "get":
				return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;
			break;

			case "set":
				$this->values[$fieldName] = $args[0];
			break;

		}

	}
	//Serve para criar um atributo que foi retorando do banco com seus respctivos valores
	public function setData ($data = array())
	{

		foreach ($data as $key => $value) {

			$this->{"set".$key}($value);

		}

	}
	//retorna o atributo values do setData
	public function getValues ()
	{
		return $this->values;
	}

}

 ?>