<?php 

namespace Hcode;
//utiliza a extensão para herdar tudo o que tem na classe page, so mudando a pasta a ser acessada.
class PageAdmin extends Page {

	public function __construct($opts = array(), $tpl_dir = "/views/admin/")
	{
		
		parent::__construct($opts, $tpl_dir);

	}
}

 ?>