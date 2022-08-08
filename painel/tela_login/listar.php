<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM parametros ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th class="esc">ID</th> 
				<th>TÍTULO</th>				
				<th>IMAGEM</th>															
				<th></th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}

$id = $res[$i]['id'];
$subtitulo = $res[$i]['subtitulo'];
$foto = $res[$i]['foto'];

echo <<<HTML
			<tr style="font-size: 23px;"> 				
				<td class="esc" style="vertical-align: middle; padding-left: 1.2%">{$id}</td>
				<td style="vertical-align: middle; padding-left: 1.2%">{$subtitulo}</td>
				<td style="vertical-align: middle; padding-left: 1.2%"><img src="../images/login/{$foto}" width="40px" class="mr-2"></td> 

				<td style="padding-top: 0.50%;"> 
				<big><big><big>				
					<a href="#" onclick="editar('{$id}','{$subtitulo}','{$foto}' )" title="Editar Dados">
						<i class="fa fa-edit text-default"></i>
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


	function editar(id, subtitulo, foto) {

		$('#id').val(id);
		$('#subtitulo').val(subtitulo);		
		$('#foto').val('');
		$('#target').attr('src','../images/login/' + foto);	

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}
	

	function limparCampos(){
		$('#id').val('');
		$('#subtitulo').val('');		
		$('#target').attr('src','../images/login/sem-foto.jpg');
	}

</script>



