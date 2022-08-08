<?php
  require_once("../config.php");
  require_once("../conexao.php");

  @session_start();
$id_usuario = $_SESSION['id_usuario'];
//recuperar os dados do usuário logado
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
  $nome_usu = $res[0]['nome'];
  $foto_usu = $res[0]['foto'];
  $nivel_usu = $res[0]['nivel'];
  $cpf_usu = $res[0]['cpf'];
  $senha_usu = $res[0]['senha'];
  $email_usu = $res[0]['email'];
  $id_usu = $res[0]['id'];  
}  

if(@$_GET['pagina'] == ""){
  $pagina = 'home';
}else{
  $pagina = @$_GET['pagina'];
}

$esconder = '';
// PERMISSÕES USUÁRIOS
if($nivel_usu == 'Administrador' OR $nivel_usu == 1){
}else{
  $esconder = 'ocultar';
}



  if($nivel_usu == '1' ){ $painel = 'Painel Adminsitrador'; }
  else if($nivel_usu == '2') { $painel = 'Painel Consultor'; }
  else{
    $painel = 'Painel';
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $nome_sistema ?></title>

  <link rel="icon" href="../images/icons/<?php echo $favicon ?>" type="image/x-icon">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="dist/css/painel.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
   
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="dist/js/adminlte.js"></script>

  <script src="dist/js/demo.js"></script>

  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <script src="plugins/chart.js/Chart.min.js"></script>


  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
  <script type="text/javascript" src="DataTables/datatables.min.js"></script>

<!-- SELECT 2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?pagina=home" class="nav-link <?php echo $item1ativo ?>">Home</a>
      </li>
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php echo @$nome_usu ?>
          <i class="fas fa-sign-out-alt ml-1"></i>
          
        </a>
<!-- PERFIL -->
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="" data-toggle="modal" data-target="#modalPerfil" class="dropdown-item">
            
            <div class="media">
              <img src="../images/usuarios/<?php echo $foto_usu ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo @$nome_usu ?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star text-success"></i></span>
                </h3>
                 <small><?php echo @$email_usu ?></small>
               
              </div>
            </div>            
          </a>

        <div class="<?php echo $esconder ?>">
          <div class="dropdown-divider"></div>
          <a href="" data-toggle="modal" data-target="#modalConfig" class="dropdown-item">            
            <div class="media">
              <img src="../images/cadeado.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Parametros do Sistema
                  <span class="float-right text-sm text-danger"><i class="fas fa-star text-success"></i></span>
                </h3>
                 <small><?php echo 'contato@ithub.com.br' ?></small>
               
              </div>
            </div>            
          </a>
        </div>

          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../images/logout.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Sair do Site
                  <span class="float-right text-sm text-muted"><i class="fas fa-star text-danger"></i></span>
                </h3>
                <p class="text-sm">Voltar para o Login</p>
                
              </div>
            </div>
            <!-- Message End -->
          </a>
         
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
     
      <span class="brand-text font-weight-light ml-4"><?php echo $painel ?></span>
   
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/usuarios/<?php echo $foto_usu ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo @$nome_usu ?></a>
        </div>
      </div>

<!-- Sidebar Menu SISTEMA-->
      <?php 
        $itemAtivo = 'active';
      ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="index.php?pagina=home" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Home</p></a>
          </li> 
               
          <li class="nav-item ">
            <a href="index.php?pagina=cliente_lista" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Clientes</p></a>
          </li> 
          <li class="nav-item ">
            <a href="index.php?pagina=cliente_historico" class="nav-link"><i class="nav-icon fas fa-users"></i><p> Histórico</p></a>
          </li> 

          <li class="nav-item <?php echo $esconder ?>">
            <a href="index.php?pagina=tela_login" class="nav-link"><i class="nav-icon fas fa-key"></i><p> Tela Login</p></a>
          </li> 

          <li class="nav-item <?php echo $esconder ?>">
            <a href="index.php?pagina=usuarios" class="nav-link"><i class="nav-icon fas fa-user"></i><p> Usuários</p></a>
          </li> 
          
          <li class="nav-item <?php echo $esconder ?>">
            <a href="index.php?pagina=tabulacao" class="nav-link"><i class="nav-icon fas fa-tablet-alt"></i><p> Tabulação</p></a>
          </li> 
          <li class="nav-item <?php echo $esconder ?>">
            <a href="index.php?pagina=logs" class="nav-link"><i class="nav-icon fas fa-user-lock"></i><p> Logs</p></a>
          </li> 

        </ul>
      </nav>      
    </div>    
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

       <!-- /.Chamadas dos Includes das páginas -->
      <?php       
          require_once(@$pagina.'.php');        
      ?>
           
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 
</div>
    <script type="text/javascript" src="js/mascaras.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

</body>
</html>


<!-- Modal Config  -->
<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Configurações do Sistema</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-config">
      <div class="modal-body">

        <div class="row">
          <div class="col-md-4">            
            <div class="form-group"> 
              <label>Nome</label> 
              <input type="text" class="form-control" name="cfg_nome" value="<?php echo @$nome_sistema ?>" required> 
            </div>            
          </div>
          <div class="col-md-3">
            <div class="form-group"> 
              <label>Telefone</label> 
              <input type="text" class="form-control" id="telefone" name="cfg_telefone" value="<?php echo $tel_sistema ?>" > 
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group"> 
              <label>E-mail</label> 
              <input type="email" class="form-control" id="cfg_email" name="cfg_email" value="<?php echo $email_adm ?>" > 
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">            
            <div class="form-group"> 
              <label>Endereço</label> 
              <input type="text" class="form-control" name="cfg_endereco" value="<?php echo $end_sistema ?>"> 
            </div>            
          </div>
          <div class="col-md-2">
            <div class="form-group"> 
              <label>Log's</label>&nbsp;&nbsp;
              <i class="glyphicon glyphicon-tag" data-toggle="tooltip" data-original-title="Ativar captura de Log's" data-placement="bottom"></i> 
              <select class="form-control" name="logs"> 
                <option <?php if($logs == 'Sim') { ?>selected <?php } ?> value="Sim">Sim</option>
                <option <?php if($logs == 'Não') { ?>selected <?php } ?> value="Não">Não</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group"> 
              <label>Drop Log's</label>&nbsp;&nbsp;
                <i class="glyphicon glyphicon-tag" data-toggle="tooltip" data-original-title="Qtd dias manter Log's" data-placement="bottom"></i> 
              <input type="number" class="form-control" id="dias_limpar_logs" name="dias_limpar_logs" value="<?php echo $dias_limpar_logs ?>" required > 
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group"> 
              <label>PDF / HTML</label>&nbsp;&nbsp;
              <i class="glyphicon glyphicon-tag" data-toggle="tooltip" data-original-title="Relatório em PDF ou HTML" data-placement="bottom"></i> 
              <select class="form-control" name="rel"> 
                <option <?php if($relatorio_pdf == 'PDF') { ?>selected <?php } ?> value="PDF">PDF</option>
                <option <?php if($relatorio_pdf == 'HTML') { ?>selected <?php } ?> value="HTML">HTML</option>
              </select>
            </div>
          </div>                      
        </div>  

        <div class="row">
          <div class="col-md-6">            
            <div class="form-group"> 
              <label>Logo</label><br />
              <input type="file" name="logo" onChange="carregarImgLogo();" id="foto-logo">
            </div>            
          </div>
          <div class="col-md-6">            
            <div class="form-group"> 
              <label>Ícone Favicon (ico)</label> 
              <input type="file" name="favicon" onChange="carregarImgFavicon();" id="foto-favicon">
            </div>            
          </div>                            
        </div>

        <div class="row">
          <div class="col-md-6">
            <div id="divImgLogo" style="text-align: center">
              <img src="../images/config/<?php echo $logo ?>"  width="100px" id="target-logo">                  
            </div>
          </div>
          <div class="col-md-6">
            <div id="divImgLogo" style="text-align: center">
              <img src="../images/icons/<?php echo $favicon ?>"  width="20" id="target-favicon">                 
            </div>
          </div>                    
        </div>

        <div class="row">
          <div class="col-md-6">            
            <div class="form-group"> 
              <label>Relatório (*jpg) </label>
              <small>
                <i class="glyphicon glyphicon-tag" data-toggle="tooltip" data-placement="bottom" title="Imagem 200x60 para relatório"></i>
              </small> 
              <input type="file" name="imgRel" onChange="carregarImgRel();" id="foto-rel">
            </div>            
          </div>
          <div class="col-md-6">
            <div id="divImgRel" style="text-align: center">
              <img src="../images/config/<?php echo $logo_rel ?>"  width="100" id="target-rel">                 
            </div>
          </div>                    
        </div>        

        <input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">
        <input type="hidden" name="foto_usu" value="<?php echo $foto_usu ?>">

        <small><div id="msg-config" align="center" class="mt-3"></div></small>          

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;Editar Dados</button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal Editar  -->
<div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Editar Dados</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="form-usu">
      <div class="modal-body">

        <div class="row">
          <div class="col-md-6">            
            <div class="form-group"> 
              <label>Nome</label> 
              <input type="text" class="form-control" name="nome_usu" value="<?php echo $nome_usu ?>" required> 
            </div>            
          </div>
          <div class="col-md-6">
            <div class="form-group"> 
              <label>CPF</label> 
              <input type="text" class="form-control" id="cpf_usu" name="cpf_usu" value="<?php echo $cpf_usu ?>" required> 
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6">            
            <div class="form-group"> 
              <label>Email</label> 
              <input type="email" class="form-control" name="email_usu" value="<?php echo $email_usu ?>" required> 
            </div>            
          </div>
          <div class="col-md-6">
            <div class="form-group"> 
              <label>Senha</label> 
              <input type="password" class="form-control" name="senha_usu" value="<?php echo $senha_usu ?>" required> 
            </div>
          </div>

        </div>  


        <div class="row">
          <div class="col-md-9">            
            <div class="form-group"> 
              <label>Foto</label> 
              <input type="file" name="foto" onChange="carregarImg2();" id="foto-usu">
            </div>            
          </div>
          <div class="col-md-3">
            <div id="divImg">
              <img src="../images/usuarios/<?php echo $foto_usu ?>"  width="100px" id="target-usu">                  
            </div>
          </div>

        </div>

        <input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">
        <input type="hidden" name="foto_usu" value="<?php echo $foto_usu ?>">

        <small><div id="msg-usu" align="center" class="mt-3"></div></small>         

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
      </div>
      </form>

    </div>
  </div>
</div>


<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip() 
 })
</script>

<script>
  $(function () {
    $('[data-toggle="popover"]').popover()
  })
</script>

<script type="text/javascript">
  function carregarImg2() {
    var target = document.getElementById('target-usu');
    var file = document.querySelector("#foto-usu").files[0];

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
  $("#form-usu").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "editar-dados.php",
      type: 'POST',
      data: formData,

      success: function (mensagem) {
        $('#msg-usu').text('');
        $('#msg-usu').removeClass()
        if (mensagem.trim() == "Salvo com Sucesso") {         
          location.reload();
        } else {

          $('#msg-usu').addClass('text-danger')
          $('#msg-usu').text(mensagem)
        }


      },

      cache: false,
      contentType: false,
      processData: false,

    });

  });
</script>

<script type="text/javascript">
  function carregarImgLogo() {
    var target = document.getElementById('target-logo');
    var file = document.querySelector("#foto-logo").files[0];

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
  function carregarImgFavicon() {
    var target = document.getElementById('target-favicon');
    var file = document.querySelector("#foto-favicon").files[0];

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
  function carregarImgRel() {
    var target = document.getElementById('target-rel');
    var file = document.querySelector("#foto-rel").files[0];

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
  $("#form-config").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "editar-config.php",
      type: 'POST',
      data: formData,

      success: function (mensagem) {
        $('#msg-config').text('');
        $('#msg-config').removeClass()
        if (mensagem.trim() == "Salvo com Sucesso") {         
          location.reload();
        } else {

          $('#msg-config').addClass('text-danger')
          $('#msg-config').text(mensagem)
        }
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  });
</script>


<!-- modalRelatórios BEGIN-->
<script type="text/javascript">
  $(document).ready(function() {
    $('.sel2index').select2({
      dropdownParent: $('#RelLogs')
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
<!-- modalRelatórios END -->


<script type="text/javascript">
  function datas(data, id, campo){
    var data_atual = "<?=@$data_atual?>";
    $('#dataInicialRel-'+campo).val(data);
    $('#dataFinalRel-'+campo).val(data_atual);

    document.getElementById('hoje-'+campo).style.color = "#000";
    document.getElementById('mes-'+campo).style.color = "#000";
    document.getElementById(id).style.color = "blue"; 
    document.getElementById('tudo-'+campo).style.color = "#000";
    document.getElementById('ano-'+campo).style.color = "#000";
    document.getElementById(id).style.color = "blue";   
  }
</script>