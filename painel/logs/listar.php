<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM logs ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th class="esc">Usuário</th>	
				<th>Ação</th>
				<th>Tabela</th> 
				<th class="esc">Descrição</th>												
				<th class="esc">Data</th>
				<th class="esc">Hora</th> 							
				<th class="esc">ID Registro</th>				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$tabela = $res[$i]['tabela'];
$acao = $res[$i]['acao'];
$data = $res[$i]['data'];
$hora = $res[$i]['hora'];
$usuario = $res[$i]['usuario'];
$id_registro = $res[$i]['id_reg'];
$descricao = $res[$i]['descricao'];


$data_F = implode('/', array_reverse(explode('-', $data)));

$query2 = $pdo->query("SELECT * FROM usuarios WHERE id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu = $res2[0]['nome'];
}else{
	$nome_usu = 'Sem Usuário';
}

echo <<<HTML
			<tr> 
				<td class="esc" style="padding-top: 0.80%;">{$nome_usu}</td>
				<td style="padding-top: 0.80%;">{$acao}</td>				
				<td style="padding-top: 0.80%;">{$tabela}</td> 
				<td class="esc" style="padding-top: 0.80%; padding-left: 1.2%">{$descricao}</td>
				<td class="esc" style="padding-top: 0.80%;">{$data_F}</td>
				<td class="esc" style="padding-top: 0.80%;">{$hora}</td>				
				<td class="esc" style="padding-top: 0.80%; padding-left: 2.8%">{$id_registro}</td>												
				
				<td style="padding-top: 0.50%;"> 

					<a href="#" onclick="mostrar('{$id}', '{$tabela}','{$acao}', '{$data_F}','{$hora}','{$nome_usu}','{$id_registro}','{$descricao}' )" title="Ver Dados" class="btn btn-info btn-sm ml-2"><i class="fa fa-info-circle text-white"></i>
					</a>								
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


	function mostrar(id, tabela, data, acao, hora, nome_usu, id_registro, descricao){
		
		$('#nome_mostrar').text(tabela);
		$('#data_mostrar').text(data);
		$('#acao_mostrar').text(acao);				
		$('#hora_mostrar').text(hora);
		$('#usuario_mostrar').text(nome_usu);
		$('#id_registro_mostrar').text(id_registro);		
		$('#descricao_mostrar').text(descricao);	
		
		$('#modalMostrar').modal('show');		
	}

</script>



