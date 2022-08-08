<?php 
$tabela = 'usuarios';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$dt_nascimento = $_POST['dt_nascimento'];
$sexo = $_POST['sexo'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$nivel = $_POST['nivel'];
$status = $_POST['status'];
$senha = md5($_POST['cpf']);

//validar nome
$query = $pdo->query("SELECT * FROM usuarios WHERE cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Usuário já Cadastrado, escolha Outro!';
	exit();
}

$query = $pdo->query("SELECT * FROM $tabela WHERE id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-perfil.jpg';
}
//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/usuarios/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){
		
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-perfil.jpg"){
				@unlink('../../images/usuarios/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}

// if(@$foto == ""){
// 	$foto = 'sem-perfil.jpg';
// 	// exit();
// }

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome=:nome, dt_nascimento=:dt_nascimento, sexo=:sexo, cpf=:cpf, telefone=:telefone, email=:email, nivel=:nivel, status=:status, senha='$senha', foto='$foto' ");
	$acao = 'inserção';
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome=:nome, dt_nascimento=:dt_nascimento, sexo=:sexo, cpf=:cpf, telefone=:telefone, email=:email, nivel=:nivel, status=:status, foto='$foto' WHERE id = '$id'");
	$acao = 'edição';
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":dt_nascimento", "$dt_nascimento");
$query->bindValue(":sexo", "$sexo");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":email", "$email");
$query->bindValue(":nivel", "$nivel");
$query->bindValue(":status", "$status");
$query->execute();
$ult_id = $pdo->lastInsertId();

if($ult_id == "" || $ult_id == 0){
	$ult_id = $id;
}

//inserir log
$acao = $acao;
$descricao = $nome;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

echo 'Salvo com Sucesso'; 

	
?>