<?php 
// require_once("verificar.php");
require_once("../conexao.php");
$pag = 'cliente_historico';

if(@$_SESSION['nivel_usuario'] == "Adminsitrador" AND @$_SESSION['nivel_usuario'] == "Consultores"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>
<div class="ml-3 mr-3 card">
<!-- 	<nav class="navbar navbar-expand navbar-white navbar-light mt-2 ml-2">
		<button onclick="inserir()" type="button" class="btn btn-info btn-flat btn-pri">
			<i class="fa fa-plus" aria-hidden="true"></i> Novo Cliente
		</button>	
	</nav> -->

	<div class="bs-example widget-shadow" style="padding:15px" id="listar"> </div>		
</div>

<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>
