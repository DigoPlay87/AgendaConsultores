<?php 
// require_once("verificar.php");
require_once("../conexao.php");
$pag = 'logs';

if(@$_SESSION['nivel_usuario'] == "Adminsitrador"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}
?>
<div class="ml-3 mr-3 card">	
	<div class="bs-example widget-shadow" style="padding:15px" id="listar"> </div>
</div>

<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><h3>Tabela: <span id="nome_mostrar"> </span></h3></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>			
			<div class="modal-body">			
			
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data: </b></span>
						<span id="acao_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Ação: </b></span>
						<span id="data_mostrar"></span>
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Hora: </b></span>
						<span id="hora_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Usuário: </b></span>
						<span id="usuario_mostrar"></span>
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>ID Registro: </b></span>
						<span id="id_registro_mostrar"></span>							
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Descrição: </b></span>
						<span id="descricao_mostrar"></span>							
					</div>
				</div>

				<div class="row">
					<div class="col-md-12" align="center">		
						<img  width="200px" id="target_mostrar">	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

