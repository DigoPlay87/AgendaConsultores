<?php 
// require_once("verificar.php");
require_once("../conexao.php");
$pag = 'cliente_lista';

if(@$_SESSION['nivel_usuario'] == "Adminsitrador" AND @$_SESSION['nivel_usuario'] == "Consultores"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>
<div class="ml-3 mr-3 card">
	<nav class="navbar navbar-expand navbar-white navbar-light mt-2 ml-2">
		<button onclick="inserir()" type="button" class="btn btn-info btn-flat btn-pri">
			<i class="fa fa-plus" aria-hidden="true"></i> Novo Cliente
		</button>	
	</nav>

	<div class="bs-example widget-shadow" style="padding:15px" id="listar"> </div>		
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
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
						<div class="col-md-4">						
							<div class="form-group"> 															
								<label>Física / Jurídica</label> 
								<select class="form-control pessoa" name="tipo" id="tipo" style="width:100%;"> 								
									<option value="">Selecione Tipo</option>
									<option value="PF">Física</option>
									<option value="PJ">Jurídica</option>
								</select>
							</div>						
						</div>	

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>CPF / CNPJ</label> 
								<input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj"> 
							</div>						
						</div>					
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Telefone *</label> 
								<input type="text" class="form-control" name="telefone" id="telefone"> 
							</div>						
						</div>
					</div>
						
					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Nome *</label> 
								<input type="text" class="form-control" name="nome" id="nome"> 
							</div>						
						</div>		
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Tabulação *</label> 
								<select class="form-control sel2" name="tabulacao" id="tabulacao" required style="width:100%;"> 
									<option value="">Selecione Tabulação</option>
									<?php 
									$query = $pdo->query("SELECT * FROM tabulacao ORDER BY id ASC");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>
							</div>						
						</div>
					</div>		

					<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>E-mail</label> 
								<input type="email" class="form-control" name="email" id="email"> 
							</div>						
						</div>						
					</div>		

					<div class="row">
						<div class="col-md-12">
							<div class="form-group"> 
								<label>OBS <small>(Max 255 Caracteres)</small></label> 
								<textarea maxlength="255" cols="2" rows="4" type="text" class="form-control" name="obs" id="obs"> </textarea>
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

<!-- modal exibir -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="nome_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>			
			<div class="modal-body">			

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Tabulação: </b></span>
						<span id="tabulacao_mostrar"></span>							
					</div>
				</div>				
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Tipo: </b></span>
						<span id="tipo_mostrar"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Documento: </b></span>
						<span id="cpf_cnpj_mostrar"></span>							
					</div>					
				</div>			
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Pessoa: </b></span>
						<span id="telefone_mostrar"></span>							
					</div>
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>E-mail: </b></span>
						<span id="email_mostrar"></span>
					</div>					
				</div>
				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Data Registro: </b></span>
						<span id="dt_registro_mostrar"></span>							
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>OBS: </b></span>
						<span id="obs_mostrar"></span>						
					</div>
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

<!-- modal baixa dando tabulação cliente  -->
<div class="modal fade" id="modalBaixa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="baixa_nome"> </span></h4>
				<button id="btn-close" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-baixa">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Tabulação *</label> 
								<select class="form-control sel2" name="baixa_tabulacao" id="baixa_tabulacao" required style="width:100%;"> 
									<option value="">Selecione Tabulação</option>
									<?php 
									$query = $pdo->query("SELECT * FROM tabulacao ORDER BY id ASC");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>
							</div>						
						</div>
					</div>			

					<div class="row">
						<div class="col-md-12">
							<div class="form-group"> 
								<label>OBS *<small>(Max 255 Caracteres)</small></label> 
								<textarea maxlength="255" cols="2" rows="4" type="text" class="form-control" name="baixa_obs" id="baixa_obs" required> </textarea>
							</div>
						</div>														
					</div>	
				
					<input type="hidden" name="baixa_id" id="baixa_id">					
					<div id="baixa_msg" align="center" class="mt-3"></div>

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

<script>
	$(document).ready(function() {
		$('#cpf_cnpj').mask('000.000.000-00');
		$('#cpf_cnpj').attr('placeholder', ' CPF');

		$('#tipo').change(function(){
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
</script>

<style type="text/css">
	.select2-selection__rendered {
		line-height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;
	}
	.select2-selection {
		height: 36px !important;
		font-size:16px !important;
		color:#666666 !important;

	}
</style>  

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


<script type="text/javascript">
	$("#form-baixa").submit(function () {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/inserir-baixa.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				// $('#baixa_msg').text('');
				$('#baixa_msg').removeClass()
				// if(mensagem == 'Cadastrado com Sucesso!!'){

				if (mensagem == 'Inserido com Sucesso') {                    				
					$('#baixa_tabulacao').val('');
					$('#baixa_obs').val('');	

					$('#mensagem').addClass('text-success')
					$('#btn-close').click();
					listar();
			} else {
				$('#baixa_msg').addClass('text-danger')
				$('#baixa_msg').text(mensagem)
			}
		},
		cache: false,
		contentType: false,
		processData: false,
	});

	});
</script>