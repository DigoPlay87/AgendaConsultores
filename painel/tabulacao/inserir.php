<?php 
$tabela = 'tabulacao';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$obs = $_POST['obs'];

if($nome == ""){
	echo 'Defina o Nome da Tabulação!';
	exit();
}

if($id == ""){
	// $ativo = 'Sim';
	$query = $pdo->prepare("INSERT INTO $tabela SET nome=:nome, obs=:obs");
	$acao = 'inserção';

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome=:nome, obs=:obs WHERE id = '$id'");
	$acao = 'edição';
}

	$query->bindValue(":nome", "$nome");
	$query->bindValue(":obs", "$obs");	
	$query->execute();
	$ult_id = $pdo->lastInsertId();


if(@$ult_id == "" || @$ult_id == 0){
	$ult_id = $id;
}

//inserir log
$acao = $acao;
$descricao = $nome;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

echo 'Salvo com Sucesso'; 

?>