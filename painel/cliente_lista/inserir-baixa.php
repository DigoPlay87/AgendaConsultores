<?php 
$tabela = 'clientes';
require_once("../../conexao.php");

$id = $_POST['baixa_id'];
$baixa_tabulacao = $_POST['baixa_tabulacao'];
$baixa_obs = $_POST['baixa_obs'];
$time_reg = DATE('H:m:i');

if($baixa_obs == ''){
	echo "Para proceguir precisa de um comentário!";
	exit();
}
else{

	$mk_cli = $pdo->query("SELECT * FROM clientes WHERE id = '$id' ");
	$rsp_cli = $mk_cli->fetchAll(PDO::FETCH_ASSOC);
	$rtn_cli = $rsp_cli[0]['nome'];
	$rtn_resp = $rsp_cli[0]['responsavel'];
	$rtn_tel = $rsp_cli[0]['telefone'];

	$mk_nome = $pdo->query("SELECT nome FROM usuarios WHERE id = '$rtn_resp' ");
	$rsp_nome = $mk_nome->fetchAll(PDO::FETCH_ASSOC);
	$rtn_nome = $rsp_nome[0]['nome'];

	$mk_tab = $pdo->query("SELECT nome FROM tabulacao WHERE id = '$baixa_tabulacao' ");
	$rsp_tab = $mk_tab->fetchAll(PDO::FETCH_ASSOC);
	$rtn_tab = $rsp_tab[0]['nome'];

	// atualiza tabela principal clientes
	$upd = $pdo->prepare("UPDATE $tabela SET tabulacao='$baixa_tabulacao' WHERE id = '$id' ");
	$upd->execute();

	$query = $pdo->prepare("INSERT INTO clientes_resumo 
							SET id_cliente='$rtn_cli', id_resp='$rtn_nome', tabulacao='$rtn_tab', telefone='$rtn_tel', data=curDate(), hora='$time_reg', obs='$baixa_obs' ");	
 	$query->execute();	


	echo "Inserido com Sucesso";
}


?>