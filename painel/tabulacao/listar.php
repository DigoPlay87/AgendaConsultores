<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM tabulacao ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr>
				<th>ID</th>
				<th>NOME</th> 				
				<th class="esc">OBS</th> 
				<th style=""></th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$obs = $res[$i]['obs'];
// $dt_registro = $res[$i]['dt_registro'];

//retirar quebra de texto do obs
$obs = str_replace(array("\n", "\r"), ' + ', $obs);

// $dt_registroF = implode('/', array_reverse(explode('-', $dt_registro)));


echo <<<HTML
			<tr style="font-size: 16px;"> 
				<td style="vertical-align: middle; padding-left:  1.2%">{$id}</td>
				<td style="vertical-align: middle; padding-left:  1.2%">{$nome}</td>				
				<td class="esc" style="vertical-align: middle; padding-left:  0.45%">{$obs}</td>										
				<td style="vertical-align: middle;"> 
				
				<big><big>
					<a href="#" onclick="editar('{$id}', '{$nome}', '{$obs}')" title="Editar Dados" ><i class="fa fa-edit text-info"></i></a>
				</big></big>								
				
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

	function editar(id, nome, obs){
		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#obs').val(obs);
		
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	// function mostrar(id, nome, obs){
	// 	for (let letra of obs){  				
	// 				if (letra === '+'){
	// 					obs = obs.replace(' +  + ', '\n')
	// 				}			
	// 			}
		
	// 	$('#tipo_mostrar').text(tipo);
	// 	$('#cpf_cnpj_mostrar').text(cpf_cnpj);
	// 	$('#nome_mostrar').text(nome);
	// 	$('#telefone_mostrar').text(telefone);
	// 	$('#email_mostrar').text(email);
	// 	$('#dt_registro_mostrar').text(dt_registro);
	// 	$('#obs_mostrar').text(obs);
		
	// 	// $('#target_mostrar').attr('src','images/clientes/' + foto);	

	// 	$('#modalMostrar').modal('show');		
	// }

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#obs').val('');
	}

</script>



