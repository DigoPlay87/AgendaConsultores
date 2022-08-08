<?php 
$tabela = 'clientes';
require_once("../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = @$_POST['id'];
$tipo = @$_POST['tipo'];
$cpf_cnpj = @$_POST['cpf_cnpj'];
$telefone = @$_POST['telefone'];
$nome = @$_POST['nome'];
$email = @$_POST['email'];
$tabulacao = @$_POST['tabulacao'];
$time_reg = DATE('H:m:i');
$obs = @$_POST['obs'];

if(@$tipo == ""){
	echo 'Selecione o tipo!';
	exit();
}
if(@$nome == "" OR @$telefone == ""){
	echo 'Nome e Telefone são Obrigatórios!';
	exit();
}

if($id == ""){
	// $ativo = 'Sim';
	$query = $pdo->prepare("INSERT INTO $tabela 
							SET responsavel='$id_usuario', tipo=:tipo, cpf_cnpj=:cpf_cnpj, telefone=:telefone, nome=:nome, email=:email, tabulacao=:tabulacao, dt_registro=curDate(), hora='$time_reg', obs=:obs ");
	$acao = 'inserção';

	// $ins_historico = $pdo->prepare("INSERT INTO clientes_resumo 
	// 								SET id_cliente='$nome', id_resp='$id_usuario', tabulacao='$tabulacao', telefone='$telefone', data=curDate(), hora='$time_reg', obs=$obs ");
	// $ins_historico->execute();


}else{
	$query = $pdo->prepare("UPDATE $tabela 
							SET responsavel='$id_usuario', tipo=:tipo, cpf_cnpj=:cpf_cnpj, telefone=:telefone, nome=:nome, email=:email, tabulacao=:tabulacao, obs=:obs WHERE id = '$id'");
	$acao = 'edição';

	// $upd_historico = $pdo->prepare("INSERT INTO clientes_resumo 
	// 								SET id_cliente='$nome', id_resp='$id_usuario', tabulacao='$tabulacao', telefone='$telefone', data=curDate(), hora='$time_reg', obs=$obs ");	
}

	$query->bindValue(":tipo", "$tipo");
	$query->bindValue(":cpf_cnpj", "$cpf_cnpj");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":nome", "$nome");
	$query->bindValue(":email", "$email");	
	$query->bindValue(":tabulacao", "$tabulacao");	
	$query->bindValue(":obs", "$obs");
	$query->execute();
	$ult_id = $pdo->lastInsertId();


	$mk_nome = $pdo->query("SELECT nome FROM usuarios WHERE id = '$id_usuario' ");
	$rsp_nome = $mk_nome->fetchAll(PDO::FETCH_ASSOC);
	$rtn_nome = $rsp_nome[0]['nome'];

	$mk_tab = $pdo->query("SELECT nome FROM tabulacao WHERE id = '$tabulacao' ");
	$rsp_tab = $mk_tab->fetchAll(PDO::FETCH_ASSOC);
	$rtn_tab = $rsp_tab[0]['nome'];
	

	$query = $pdo->prepare("INSERT INTO clientes_resumo 
							SET id_cliente='$nome', id_resp='$rtn_nome', tabulacao='$rtn_tab', telefone='$telefone', data=curDate(), hora='$time_reg', obs='$obs' ");	
 	$query->execute();	

	if(@$ult_id == "" || @$ult_id == 0){
		$ult_id = $id;
	}

//inserir log
$acao = $acao;
$descricao = $nome;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

	// $query = $pdo->prepare("INSERT INTO clientes_resumo 
	// 						SET id_cliente='$nome', id_resp='$id_usuario', tabulacao='$tabulacao', telefone='$telefone', data=curDate(), hora='$time_reg', obs='$obs' ");	
 // 	$query->execute();							

echo 'Salvo com Sucesso'; 

?>