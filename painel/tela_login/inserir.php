<?php 
$tabela = 'parametros';
require_once("../../conexao.php");

$id = $_POST['id'];
$subtitulo = $_POST['subtitulo'];

$query = $pdo->query("SELECT * FROM $tabela WHERE id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/login/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){
		
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/login/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}
if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET  subtitulo=:subtitulo, foto='$foto' ");
	$acao = 'inserção';

}else{
	$query = $pdo->prepare("UPDATE $tabela SET subtitulo=:subtitulo, foto='$foto' WHERE id = '$id'");
	$acao = 'edição';
}

	$query->bindValue(":subtitulo", "$subtitulo");
	$query->execute();
	$ult_id = $pdo->lastInsertId();

	if(@$ult_id == "" || @$ult_id == 0){
		$ult_id = $id;
	}

//inserir log
$acao = $acao;
$descricao = $subtitulo;
$id_reg = $ult_id;
require_once("../inserir-logs.php");

echo 'Salvo com Sucesso'; 

?>