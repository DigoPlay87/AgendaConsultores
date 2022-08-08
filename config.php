<?php 
require_once('conexao.php');

$query3 = $pdo->query("SELECT *  FROM parametros");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$total_reg3 = @count($res3);
if($total_reg3 == 0){
	$pdo->query("INSERT INTO parametros SET foto='sem-foto.jpg', subtitulo='AUTENTICAÇÃO!!' ");
}
// $query3 = $pdo->query("SELECT *  FROM parametros");
// $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$login_foto = $res3[0]['foto'];
$login_subtitulo = $res3[0]['subtitulo'];

// //REGISTRO
// $senha_cript = md5('1234');
// $query = $pdo->query("SELECT * FROM usuarios");
// $res = $query->fetchAll(PDO::FETCH_ASSOC);
// $total_reg = @count($res);
// if($total_reg == 0){
// 	$pdo->query("INSERT INTO usuarios SET foto='sem-perfil.jpg', nome='Root', email='diego@ithub.com.br', cpf='000.000.000-00', senha='$senha_cript', nivel='Administrador', dt_registro='0000-00-00' ");
// }

// //REGISTRO CONFIG
// $query = $pdo->query("SELECT * FROM config");
// $res = $query->fetchAll(PDO::FETCH_ASSOC);
// $total_reg = @count($res);
// if($total_reg == 0){
// 	$pdo->query("INSERT INTO config 
// 			SET nome = 'AGENDA', email_adm = 'diego@ithub.com.br', logs = 'Sim', logo='logo.png', logo_rel='logo.jpg', favicon='favicon.ico', dias_limpar_logs=40, relatorio='HTML' ");
// }

// 	// VARIAVELS DE CONFIGURAÇÕES
// 	$query = $pdo->query("SELECT * FROM config");
// 	$res = $query->fetchAll(PDO::FETCH_ASSOC);
// 	$logs = $res[0]['logs'];	
// 	$nome_sistema = $res[0]['nome'];
// 	$email_adm = $res[0]['email_adm'];
// 	$tel_sistema = $res[0]['telefone'];
// 	$end_sistema = $res[0]['endereco'];
// 	$logo = $res[0]['logo'];
// 	$logo_rel = $res[0]['logo_rel'];	
// 	$favicon = $res[0]['favicon'];	
// 	$dias_limpar_logs = $res[0]['dias_limpar_logs'];
// 	$relatorio_pdf = $res[0]['relatorio'];

?>