<?php 
$tabela = 'usuarios';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];

// $query = $pdo->query("SELECT id, ativo FROM $tabela WHERE id = '$id' ");
// $verf = $query->fetchAll(PDO::FETCH_ASSOC);
// $status = $verf[0]['ativo'];

// if($status == 'Sim'){
// 	echo 'Não pode excluir Cliente Ativo...';
// 	exit();
// }

$pdo->query("DELETE FROM $tabela WHERE id = '$id' "); //AND ativo = 'Não' ");

echo 'Excluído com Sucesso';

//inserir log
$acao = 'exclusão';
$descricao = $nome;
$id_reg = $id;
require_once("../inserir-logs.php");

?>