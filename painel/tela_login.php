<?php 
// require_once("verificar.php");
require_once("../conexao.php");
$pag = 'tela_login';

if(@$_SESSION['nivel_usuario'] == "Adminsitrador" AND @$_SESSION['nivel_usuario'] == "Gerente"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}
?>
<div class="ml-3 mr-3 card">
	<!-- <nav class="navbar navbar-expand navbar-white navbar-light mt-2 ml-2">
		<button onclick="inserir()" type="button" class="btn btn-info btn-flat btn-pri">
			<i class="fa fa-key" aria-hidden="true"></i> Parametrização Tela Login
		</button>	
	</nav> -->

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
								<label>Sub-Título Login</label> 
								<input type="text" class="form-control" name="subtitulo" id="subtitulo" required> 
							</div>						
						</div>				
					</div>
					<br />
					<div class="row">
						<div class="col-md-8">						
							<div class="form-group"> 
								<label>Foto</label>
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>		
						<div class="col-md-4">							
							<div id="divImg">
								<center><img src="../images/login/sem-foto.jpg"  width="100px" height="100px" id="target"></center>
							</div>							
						</div>														
					</div>	
					
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						<i class="fa fa-save" style="color: white" ></i>&nbsp; Salvar</button>
				</div>


			</form>
		</div>
	</div>
</div>


<!-- ModalExcluir -->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content" style="width:400px; margin:0 auto;">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal">Excluir Registro: <span id="nome-excluido"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-excluir">
				<div class="modal-body">
					
					<div class="row" align="center">
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="width:100px">
								<i class="glyphicon glyphicon-ok" style="color: white" ></i>&nbsp; Sim
							</button>
						</div>
						<div class="col-md-6">
							<button type="button" data-dismiss="modal" class="btn btn-danger" style="width:100px">
								<i class="glyphicon glyphicon-remove" style="color: white" ></i>&nbsp; Não
							</button>	
						</div>
					</div>
					<br />
					
					<input type="hidden" name="id" id="id-excluir"> 
					<input type="hidden" name="nome" id="nome-excluir"> 
					<small><div id="mensagem-excluir" align="center" class="mt-3"></div></small>					

				</div>
			</form>

		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">	
	$('#modalForm').on('shown.bs.modal', function(event) {
	  $("#subtitulo").focus();
	})	
</script>

<!-- <script>
	$(document).ready(function() {
		$('#cpf_cnpj').mask('000.000.000-00');
		$('#cpf_cnpj').attr('placeholder', ' CPF');

		$('#pessoa').change(function(){
			if($(this).val() == 'PF'){
				$('#cpf_cnpj').mask('000.000.000-00');
				$('#cpf_cnpj').attr('placeholder', ' CPF');	
				document.getElementById('dt_nasc').style.display = 'block';
			}else{
				$('#cpf_cnpj').mask('00.000.000/0000-00');
				$('#cpf_cnpj').attr('placeholder', ' CNPJ');				
				document.getElementById('dt_nasc').style.display = 'none';
			}
		});
	});
</script> -->

<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>
