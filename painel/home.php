<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usu = $_SESSION['nivel_usuario'];

$usr = $pdo->query("SELECT nome FROM usuarios WHERE id = '$id_usuario' ");
$usr_rec = $usr->fetchAll(PDO::FETCH_ASSOC);
$usr_nome = $usr_rec[0]['nome'];

if($nivel_usu == '1'){
	@$valor = 1;
	
	$slc_prim_cont = "SELECT COUNT(*) AS qtd_prim FROM clientes WHERE tabulacao = 1 AND responsavel > ".$valor." ";
	$slc_neg = "SELECT COUNT(*) AS qtd_neg FROM clientes WHERE tabulacao = 2 AND responsavel > ".$valor." ";
	$slc_res_fech = "SELECT COUNT(*) AS qtd_fech FROM clientes WHERE tabulacao = 3 AND responsavel = ".$valor." ";
	$slc_fech_terc = "SELECT COUNT(*) AS qtd_fech_terc FROM clientes WHERE tabulacao = 4 AND responsavel = ".$valor." ";
}else {
	@$valor = $id_usuario;	
	$slc_prim_cont = "SELECT COUNT(*) AS qtd_prim FROM clientes WHERE tabulacao = 1 AND responsavel = ".$valor." ";
	$slc_neg = "SELECT COUNT(*) AS qtd_neg FROM clientes WHERE tabulacao = 2 AND responsavel = ".$valor." ";
	$slc_res_fech = "SELECT COUNT(*) AS qtd_fech FROM clientes WHERE tabulacao = 3 AND responsavel = ".$valor." ";
	$slc_fech_terc = "SELECT COUNT(*) AS qtd_fech_terc FROM clientes WHERE tabulacao = 4 AND responsavel = ".$valor." ";
}

//primeiro contato.
$prim = $pdo->query($slc_prim_cont);
$qtd_prim = $prim->fetchAll(PDO::FETCH_ASSOC);
$res_pri_cont = $qtd_prim[0]['qtd_prim'];

//contatos em negociação
$neg = $pdo->query($slc_neg);
$qtd_neg = $neg->fetchAll(PDO::FETCH_ASSOC);
$res_neg = $qtd_neg[0]['qtd_neg'];

// contatos fechado. 
$fech = $pdo->query($slc_res_fech);
$qtd_fech = $fech->fetchAll(PDO::FETCH_ASSOC);
$res_fech = $qtd_fech[0]['qtd_fech'];

//contato fechado terceiros
$fech_terc = $pdo->query($slc_fech_terc);
$qtd_fech_terc = $fech_terc->fetchAll(PDO::FETCH_ASSOC);
$res_fech_terc = $qtd_fech_terc[0]['qtd_fech_terc'];


?>
<div class="content">

<div class="row">
 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-secondary"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Importados</span>
				<span class="info-box-number">0</span>
			</div>		
	 	</div>
 	</div>
 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-secondary"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Contas Pessoas Jurídica</span>
				<span class="info-box-number">0</span>
			</div>		
	 	</div>
 	</div>
 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-secondary"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Contas Pessoas Física</span>
				<span class="info-box-number">0</span>
			</div>		
	 	</div>
 	</div> 	 	
</div>


<div class="row">
 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-info"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">1* Contato</span>
				<span class="info-box-number"><?php echo @$res_pri_cont ?></span>
			</div>		
	 	</div>
 	</div>	

 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-warning"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Negociação</span>
				<span class="info-box-number"><?php echo @$res_neg ?></span>
			</div>		
	 	</div>
 	</div>		 	 	

 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-success"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Fechados</span>
				<span class="info-box-number"><?php echo @$res_fech ?></span>
			</div>		
	 	</div>
 	</div>

 	<div class="col-md-3">
	 	<div class="info-box shadow">
	 		<span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Fechou com Terceiro</span>
				<span class="info-box-number"><?php echo @$res_fech_terc ?></span>
			</div>		
	 	</div>
 	</div>	 	
</div>