<?php 
	session_start();	
	
	$banco_dados_mock = array(
		"login" => "lffsant", 
		"senha" => "12345",
		"nome"  => "Luís Felipe"
	);
	
	if ($_POST["operation"] == 'load') {
		
		if (isset($_SESSION["login"])) {
			echo '{ "nome" : "' . $_SESSION["nome"] . 
			'", "login" : "' . $_SESSION["login"] . '" }';
		} else {
			echo '{ "nome" : "undefined" }';
		}
		
	} else if ($_POST["operation"] == 'login') {
		if(!(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))){
		   echo '{ "status" : "nao_logado" }';
		   header('HTTP/1.0 401 Unauthorized');
		} else {
			$login = $_SERVER['PHP_AUTH_USER'];
			$senha = $_SERVER['PHP_AUTH_PW'];
			
			if ($login == $banco_dados_mock["login"] &&
				$senha == $banco_dados_mock["senha"]) {
				$_SESSION["nome"] = $banco_dados_mock["nome"];
				$_SESSION["login"] = $banco_dados_mock["login"];
				
				echo '{ "nome" : "' . $_SESSION["nome"] . 
					 '", "login" : "' . $_SESSION["login"] .
					 '", "status" : "logado" }';			
			} else {
				 echo '{ "status" : "nao_logado" }';
				 header('HTTP/1.0 401 Unauthorized');
			 }
		}

	} else if ($_POST["operation"] == 'logout') {
		
		session_destroy();
		echo '{ "nome" : "undefined" }';
		
	} else {
		
		echo '{ "invalid_operation" : "' . $_POST["operation"] . '" }';
		
	}
?>