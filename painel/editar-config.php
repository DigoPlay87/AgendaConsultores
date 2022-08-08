<?php 
require_once("../conexao.php");

$nome = $_POST['cfg_nome'];
$telefone = $_POST['cfg_telefone'];
$email = $_POST['cfg_email'];
$endereco = $_POST['cfg_endereco'];
$logs = $_POST['logs'];
$logo = 'logo.png';
$logo_rel = 'logo.jpg';
$favicon = 'favicon.ico';
$dias_limpar_logs = $_POST['dias_limpar_logs'];
$relatorio_pdf = $_POST['rel'];
// $logo_rel = ['logo_rel'];

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
	$caminho = '../images/config/logo.png';
	$imagem_temp = @$_FILES['logo']['tmp_name']; 
	if(@$_FILES['logo']['name'] != ""){
		$ext = pathinfo(@$_FILES['logo']['name'], PATHINFO_EXTENSION);   
		if($ext == 'png'){ 
			move_uploaded_file($imagem_temp, $caminho);
		}else{
			echo 'Extensão de Imagem para a logo, somente se for .PNG';
			exit();
		}
	}

	$caminho = '../images/icons/favicon.ico';
	$imagem_temp = @$_FILES['favicon']['tmp_name']; 
	if(@$_FILES['favicon']['name'] != ""){
		$ext = pathinfo(@$_FILES['favicon']['name'], PATHINFO_EXTENSION);   
		if($ext == 'ico'){ 
			move_uploaded_file($imagem_temp, $caminho);
		}else{
			echo 'Extensão do ícone Favicon é somente .ICO';
			exit();
		}
	}

	$caminho = '../images/config/logo.jpg';
	$imagem_temp = @$_FILES['imgRel']['tmp_name']; 
	if(@$_FILES['imgRel']['name'] != ""){
		$ext = pathinfo(@$_FILES['imgRel']['name'], PATHINFO_EXTENSION);   
		if($ext == 'jpg'){ 
			move_uploaded_file($imagem_temp, $caminho);
		}else{
			echo 'Extensão do Logo é somente .JPG';
			exit();
		}
	}

	$query = $pdo->prepare("UPDATE config 
								SET nome=:nome, telefone=:telefone, endereco=:endereco, logo='$logo', logo_rel='$logo_rel', favicon='$favicon', email_adm=:email_adm, logs='$logs', dias_limpar_logs='$dias_limpar_logs', relatorio='$relatorio_pdf'
						   ");

	$query->bindValue(":nome", "$nome");
	$query->bindValue(":telefone", "$telefone");
	$query->bindValue(":endereco", "$endereco");
	$query->bindValue(":email_adm", "$email_adm");
	$query->execute();

	echo 'Salvo com Sucesso'; 


	//inserir log
	$tabela = 'config';
	$acao = 'edição';
	$descricao = 'Dados do Config';
	require_once("inserir-logs.php");
	
?>