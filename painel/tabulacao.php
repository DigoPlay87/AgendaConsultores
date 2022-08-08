<?php 
// require_once("verificar.php");
require_once("../conexao.php");
$pag = 'tabulacao';

if(@$_SESSION['nivel_usuario'] == "Adminsitrador"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>
<div class="ml-3 mr-3 card">
	<nav class="navbar navbar-expand navbar-white navbar-light mt-2 ml-2">
		<button onclick="inserir()" type="button" class="btn btn-info btn-flat btn-pri">
			<i class="fa fa-plus" aria-hidden="true"></i> Nova Tabulação
		</button>	
	</nav>

	<div class="bs-example widget-shadow" style="padding:15px" id="listar"> </div>		
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

					<div class="row">			
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Tabulação *</label> 
								<input type="text" class="form-control" name="nome" id="nome"> 
							</div>						
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group"> 
								<label>Descrição <small>(Max 255 Caracteres)</small></label> 
								<textarea maxlength="255" cols="2" rows="2" type="text" class="form-control" name="obs" id="obs"> </textarea>
							</div>
						</div>														
					</div>	

					
					<input type="hidden" name="id" id="id">			
					<div id="mensagem" align="center" class="mt-3"></div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-save" style="color: white" ></i>&nbsp; Salvar</button>
				</div>


			</form>
		</div>
	</div>
</div>

<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">	
	$('#modalForm').on('shown.bs.modal', function(event) {
	  $("#nome").focus();
	})	
</script>
