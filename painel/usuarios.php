<?php 
// require_once("verificar.php");
require_once("../conexao.php");
$pag = 'usuarios';

if(@$_SESSION['nivel_usuario'] == "Adminsitrador"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>
<div class="ml-3 mr-3 card">
	<nav class="navbar navbar-expand navbar-white navbar-light mt-2 ml-2">

	<button onclick="inserir()" type="button" class="btn btn-info btn-flat btn-pri">
		<i class="fa fa-plus" aria-hidden="true"></i> Novo Usuario</button>

	</nav>

	<div class="bs-example widget-shadow" style="padding:15px" id="listar">	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
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
								<label>Nome</label> 
								<input type="text" class="form-control" placeholder="Nome Completo" name="nome" id="nome"> 
							</div>						
						</div>
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>DT Nascimento</label> 
								<input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento"> 
							</div>						
						</div>
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Sexo</label> 
								<select class="form-control sel2" name="sexo" id="sexo" style="width:100%;"> 
									<?php 
										$query = $pdo->query("SELECT * FROM sexo ORDER BY id ASC");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}
									?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>
							</div>						
						</div>		
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>CPF</label> 
								<input type="text" class="form-control" placeholder="000.000-000-00" name="cpf" id="cpf"> 
							</div>						
						</div>	
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Telefone</label> 
								<input type="text" class="form-control" placeholder="(00) 00000-0000" name="telefone" id="telefone"> 
							</div>	
						</div>															
					</div>

					<div class="row">
						<div class="col-md-5">						
							<div class="form-group"> 
								<label>E-mail</label> 
								<input type="text" class="form-control" placeholder="seu e-mail" name="email" id="email"> 
							</div>	
						</div>	
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Cargo</label> 
								<select class="form-control sel2" name="nivel" id="nivel" style="width:100%;"> 
									<option value="">Selecione o Cargo</option>
									<?php 
										$query = $pdo->query("SELECT * FROM nivel ORDER BY id ASC");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}
									?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>
								</select>
							</div>		
						</div>
 						<div class="col-md-3">						
							<div class="form-group"> 
								<label>Status</label> 
								<select class="form-control sel2" name="status" id="status" style="width:100%;"> 
									<option value="">Selecione o Status</option>
									<?php 
										$query = $pdo->query("SELECT * FROM status ORDER BY id ASC");
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
					<br />
					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Foto</label>
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>						
						</div>		
						<div class="col-md-6">							
							<div id="divImg">
								<center><img src="../images/usuarios/sem-perfil.jpg"  width="100px" height="100px" id="target"></center>
							</div>							
						</div>							
					</div>

					<input type="hidden" name="id" id="id"> 
					<div id="mensagem" align="center" class="mt-3"></div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><i class="fas fa-save text-white"></i>&nbsp; Salvar</button>					
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
<br />
					<div class="row" align="center">
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="width:100px">
								<i class="fas fa-check text-white"></i>&nbsp; Sim
							</button>
						</div>
						<div class="col-md-6">
							<button type="button" data-dismiss="modal" class="btn btn-danger" style="width:100px">
								<i class="fas fa-times text-white"></i>&nbsp; Não
							</button>	
						</div>
					</div>				
									
					<input type="hidden" name="id" id="id-excluir"> 
					<input type="hidden" name="nome" id="nome-excluir"> 
					<br /><div id="mensagem-excluir" align="center" class="mt-3"></div>

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