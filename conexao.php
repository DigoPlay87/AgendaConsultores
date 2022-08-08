<?php 
	date_default_timezone_set('America/Sao_Paulo');
	//quando for hospedar e tiver subpasta colocar subistituindo caminho --> [/app/dochub]
	$url_sistema = "http://$_SERVER[HTTP_HOST]/app/agendaConsultores/";
	$url = explode("//", $url_sistema);
	if($url[1] == 'localhost:81/'){
		$url_sistema = 'http://$_SERVER[HTTP_HOST]/app/agendaConsultores/';
	}

	$usuario = 'root';
	$senha = '';
	$servidor = 'localhost';
	$banco = 'crmagenda';

	try {
		$pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha");
	} catch (Exception $e) {
		echo 'Erro ao conectar com o banco de dados! <br>';
		echo $e;
	}


	$nome_sistema = 'Agenda';
	$favicon = 'favicon.ico';
	$email_adm = 'diego@ithub.com.br';	
	// $foto_padrao = 'sem-foto.jpg';

// REGISTRO
$senha_cript = md5('1234');
$query = $pdo->query("SELECT * FROM usuarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO usuarios SET foto='sem-perfil.jpg', nome='Root', email='diego@ithub.com.br', cpf='000.000.000-00', senha='$senha_cript', nivel='Administrador', dt_registro='0000-00-00' ");
}

//REGISTRO CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config 
			SET nome = 'AGENDA', email_adm = 'diego@ithub.com.br', logs = 'Sim', logo='logo.png', logo_rel='logo.jpg', favicon='favicon.ico', dias_limpar_logs=40, relatorio='HTML' ");
}

	// VARIAVELS DE CONFIGURAÇÕES
	$query = $pdo->query("SELECT * FROM config");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$logs = $res[0]['logs'];	
	$nome_sistema = $res[0]['nome'];
	$email_adm = $res[0]['email_adm'];
	$tel_sistema = $res[0]['telefone'];
	$end_sistema = $res[0]['endereco'];
	$logo = $res[0]['logo'];
	$logo_rel = $res[0]['logo_rel'];	
	$favicon = $res[0]['favicon'];	
	$dias_limpar_logs = $res[0]['dias_limpar_logs'];
	$relatorio_pdf = $res[0]['relatorio'];
	
?>