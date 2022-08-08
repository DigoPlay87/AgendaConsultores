<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');

@session_start();
$id_usuario = $_SESSION['id_usuario'];

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM clientes WHERE responsavel = '$id_usuario' ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr>
				<th>TIPO</th>
				<th>NOME</th> 				
				<th class="esc">TELEFONE</th> 
				<th class="esc">E-MAIL</th>								
				<th class="esc">TABULAÇÃO</th>
				<th class="esc">DT.REG</th>
				<th style=""></th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$tipo = $res[$i]['tipo'];
$cpf_cnpj = $res[$i]['cpf_cnpj'];
$telefone = $res[$i]['telefone'];
$nome = $res[$i]['nome'];
$email = $res[$i]['email'];
$tabulacao = $res[$i]['tabulacao'];
$obs = $res[$i]['obs'];
$dt_registro = $res[$i]['dt_registro'];
// $foto = $res[$i]['foto'];

//retirar quebra de texto do obs
// $obs = str_replace(array("\n", "\r"), ' + ', $obs);

$dt_registroF = implode('/', array_reverse(explode('-', $dt_registro)));

$query2 = $pdo->query("SELECT * FROM tabulacao WHERE id = '$tabulacao'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_tabulacao = $res2[0]['nome'];
}else{
	$nome_tabulacao = 'Sem Tabulação';
}
echo <<<HTML
			<tr style="font-size: 16px;"> 
				<td style="vertical-align: middle; padding-left:  1.2%">{$tipo}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  1.2%">{$nome}</td>														
				<td style="vertical-align: middle; padding-left:  1.2%">{$telefone}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  1.2%">{$email}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  1.2%">{$nome_tabulacao}</td>
				<td class="esc" style="vertical-align: middle; padding-left:  0.45%">{$dt_registroF}</td>										
				<td style="vertical-align: middle;"> 
				
				<big><big>
					<a href="#" title="Próximo" onclick="baixa('{$id}', '{$nome}', '{$tabulacao}')" >
						<i class="fas fa-paper-plane text-success"></i>
					</a>
				</big></big>
				&nbsp;&nbsp;				
				<big><big>
					<a href="#" title="Ver Dados" onclick="mostrar('{$id}', '{$tipo}', '{$cpf_cnpj}', '{$nome}', '{$telefone}','{$email}', '{$nome_tabulacao}', '{$obs}', '{$dt_registroF}')" ><i class="fa fa-info-circle text-primary"></i>
					</a>
				</big></big>			
				&nbsp;
				<big><big>
				<a href="#" title="Editar Dados" onclick="editar('{$id}', '{$tipo}', '{$cpf_cnpj}', '{$nome}', '{$telefone}','{$email}', '{$tabulacao}', '{$obs}' )">
					<i class="fa fa-edit text-info"></i>
				</a>
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

	function baixa(id, nome, tabulacao){		
		$('#baixa_id').val(id);
		$('#baixa_nome').text(nome);
		$('#baixa_tabulacao').val(tabulacao);		

		$('#modalBaixa').modal('show');
		// $('#mensagem').text('');		
	}

	function editar(id, tipo, cpf_cnpj, nome, telefone, email, tabulacao, obs){
		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#tipo').val(tipo);
		$('#cpf_cnpj').val(cpf_cnpj);
		$('#nome').val(nome);
		$('#telefone').val(telefone);
		$('#email').val(email);
		$('#tabulacao').val(tabulacao);
		$('#obs').val(obs);
		
		// $('#foto').val('');
		// $('#target').attr('src','images/clientes/' + foto);	

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function mostrar(id, tipo, cpf_cnpj, nome, telefone, email, tabulacao, obs, dt_registro){

		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}
		
		if(tipo == 'PJ'){
			tipo = 'Pessoa Jurídica';
		}
		if(tipo == 'PF'){
			tipo = 'Pessoa Física'
		}
		
		$('#id_mostrar').text(id);
		$('#tipo_mostrar').text(tipo);
		$('#cpf_cnpj_mostrar').text(cpf_cnpj);
		$('#nome_mostrar').text(nome);
		$('#telefone_mostrar').text(telefone);
		$('#email_mostrar').text(email);
		$('#tabulacao_mostrar').text(tabulacao);
		$('#obs_mostrar').text(obs);
		$('#dt_registro_mostrar').text(dt_registro);		
				
		// $('#target_mostrar').attr('src','images/clientes/' + foto);	

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#tipo').val('');
		$('#cpf_cnpj').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#email').val('');
		$('#tabulacao').val('');
	}

</script>



