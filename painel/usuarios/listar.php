<?php 
require_once("../../conexao.php");

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM usuarios ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){	
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 
				<th>NOME</th> 
				<th>TELEFONE</th>
				<th>TIPO</th> 
				<th>E-MAIL</th> 
				<th>SEXO</th> 
				<th>DT.NASC</th> 
				<th>CPF</th> 
				<th>STATUS</th> 
				<th style="float: right;">AÇÕES</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$telefone = $res[$i]['telefone'];
$nivel = $res[$i]['nivel'];
$email = $res[$i]['email'];
$sexo = $res[$i]['sexo'];
$dt_nascimento = $res[$i]['dt_nascimento'];
$cpf = $res[$i]['cpf'];
$status = $res[$i]['status'];
$foto = $res[$i]['foto'];

// Verificações
$query2 = $pdo->query("SELECT * FROM nivel WHERE id = '$nivel' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);
if($total_reg2 > 0){	
	$nome_nivel = $res2[0]['nome'];
}else{
	$nome_nivel = 'Indefinido';
}
$query3 = $pdo->query("SELECT * FROM sexo WHERE id = '$sexo' ");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$total_reg3 = @count($res3);
if($total_reg3 > 0){	
	$nome_sexo = $res3[0]['nome'];
}else{
	$nome_sexo = 'Indefinido';
}

$data_nascF = implode('/', array_reverse(explode('-', $dt_nascimento)));

$query4 = $pdo->query("SELECT * FROM status WHERE id = '$status' ");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
$total_reg4 = @count($res4);
if($total_reg4 > 0){	
	$nome_status = $res4[0]['nome'];
}else{
	$nome_status = 'Indefinido';
}

echo <<<HTML
			<tr> 				
				<td style="vertical-align: middle; width: 20%">
					<img src="../images/usuarios/{$foto}" width="27px" class="mr-2">{$nome}
				</td>
				<td style="vertical-align: middle; padding-left: 0.80%; width: 10%">{$telefone}</td>
				<td style="vertical-align: middle; padding-left: 0.80%; width: 10%">{$nome_nivel}</td>
				<td style="vertical-align: middle; padding-left: 1%; width: 20%">{$email}</td>
				<td style="vertical-align: middle; padding-left: 0.75%; width: 10%">{$nome_sexo}</td>
				<td style="vertical-align: middle; padding-left: 0.80%; width: 10%">{$data_nascF}</td>
				<td style="vertical-align: middle; padding-left: 1%; width: 10%">{$cpf}</td>
				<td style="vertical-align: middle; padding-left: 1.2%; width: 10%">{$nome_status}</td>				
				<td style="vertical-align: middle; float: right;">
					<big><big><big>
						<a href="#" onclick="editar('{$id}', '{$nome}','{$telefone}', '{$nivel}', '{$email}', '{$sexo}', '{$dt_nascimento}', '{$cpf}', '{$status}', '{$foto}' )" title="Editar Dados" class="">
							<i class="fas fa-edit text-info"></i>
						</a>
					</big></big></big>
					<big><big><big>
						<a href="#" onclick="excluir('{$id}', '{$nome}')" title="Excluir Item">
							<i class="far fa-trash-alt text-danger"></i>
						 </a>
					</big></big></big>
				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
	</table>
</small>
HTML;
}else{
	echo '<center><h3>Não possui nenhum registro cadastrado!</h3></center>';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	} );



	function editar(id, nome, telefone, nivel, email, sexo, dt_nascimento, cpf, status, foto){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#telefone').val(telefone);
		$('#nivel').val(nivel);
		$('#email').val(email);
		$('#sexo').val(sexo);
		$('#dt_nascimento').val(dt_nascimento);
		$('#cpf').val(cpf);			
		$('#status').val(status);

		$('#foto').val('');
		$('#target').attr('src','../images/usuarios/' + foto);				
			
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#nivel').val('');
		$('#email').val('');
		$('#sexo').val('');
		$('#dt_nascimento').val('');
		$('#cpf').val('');
		$('#status').val('');
		$('#foto').val('');
		$('#target').attr('src','../images/usuarios/sem-perfil.jpg');
	}

</script>



