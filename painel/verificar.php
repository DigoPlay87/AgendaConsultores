<?php 
	@session_start();

	//inserir log
	$acao = 'Deslogado';
	$descricao = 'Sessão Expirou';
	require_once("inserir-logs.php");

	if(@$_SESSION['id_usuario'] == ""){
		echo "<script>window.location='../index.php'</script>";
		exit();
	}

?>
	