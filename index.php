<?php 
	require_once('config.php');
	require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $nome_sistema; ?></title>
	<link rel="icon" href="images/icons/<?php echo $favicon ?>" type="image/x-icon">
	<link rel="stylesheet" href="painel/plugins/fontawesome-free/css/all.min.css">
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!-- ===============================================================================================	 -->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="autenticar.php" method="POST">
					<span class="login100-form-title p-b-34">
						<?php echo $login_subtitulo ?>
					</span>

					<div class="col-md-12">
						<div class="wrap-input100  validate-input m-b-20 " >							
							<input class="input100" type="text" name="username" placeholder="E-mail ou CPF">
						</div>
					</div>
					<div class="col-md-12">
						<div class="wrap-input100  validate-input m-b-20 " >
							<input class="input100" type="password" name="password" placeholder="*******">
						</div>
					</div>


					<div class="col-md-12">
						<button class="login100-form-btn"><big><big><i class="fas fa-fingerprint"></i></big></big>
							&nbsp;&nbsp;Login
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							esqueci a senha
						</span>

						<a href="#" class="txt2" data-toggle="modal" data-target="#modal-rec" >						
							usuário / senha?
						</a>
					</div>

					<div class="w-full text-center">
						<a href="https://www.ithub.com.br" class="txt2" target="_blank">
							iTHub Tecnologia
						</a>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('images/login/<?php echo $login_foto ?>');"></div>	
				<!-- <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div> -->
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


</body>
</html>

<div class="modal fade" id="modal-rec" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recuperar Conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group mb-4">
                        <label class="text-dark" for="exampleInputEmail1">Dados Recuperação</label>
                        <input type="text" class="form-control" name="usuario" placeholder="E-mail ou CPF" required>
                    </div>

                    <div align="center" class="" id="mensagem2"> </div>                   
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button> -->
                <button  name="btn-rec" id="btn-rec" class="btn btn-block btn-info">Recuperar</button>
            </div>                
        </div>
    </div>
</div>