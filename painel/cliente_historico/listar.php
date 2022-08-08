<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');

@session_start();
$id_usuario = $_SESSION['id_usuario'];
	
$mk_nome = $pdo->query("SELECT nome FROM usuarios WHERE id = '$id_usuario' ");
$rsp_nome = $mk_nome->fetchAll(PDO::FETCH_ASSOC);
$rtn_nome = $rsp_nome[0]['nome'];

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM clientes_resumo WHERE id_resp = '$rtn_nome' ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr>
				<th>CLIENTE</th>
				<th>RESPONSÁVEL</th> 				
				<th class="esc">TABULACAO</th> 
				<th class="esc">TELEFONE</th>								
				<th class="esc">DATA</th>
				<th class="esc">HORA</th>
				<th class="esc">OBS</th>				
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$id_cliente = $res[$i]['id_cliente'];
$id_resp = $res[$i]['id_resp'];
$tabulacao = $res[$i]['tabulacao'];
$telefone = $res[$i]['telefone'];
$data = $res[$i]['data'];
$hora = $res[$i]['hora'];
$obs = $res[$i]['obs'];

//retirar quebra de texto do obs
$obs = str_replace(array("\n", "\r"), ' + ', $obs);

$dataF = implode('/', array_reverse(explode('-', $data)));

echo <<<HTML
			<tr style="font-size: 16px;"> 
				<td style="vertical-align: middle; padding-left:  1.2%">{$id_cliente}</td>
				<td style="vertical-align: middle; padding-left:  1.2%">{$id_resp}</td>														
				<td class="esc" style="vertical-align: middle; padding-left:  1.2%">{$tabulacao}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  1.2%">{$telefone}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  1.2%">{$dataF}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  0.45%">{$hora}</td>										
				<td class="esc" style="vertical-align: middle; padding-left:  0.45%">{$obs}</td>														
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
</script>



