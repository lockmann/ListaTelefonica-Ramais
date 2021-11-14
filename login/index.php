,,<?php
	require_once("../connect.php");

	if((isset($_POST['user'])) && (isset($_POST['pass']))){
		$usuario = mysqli_real_escape_string($connect, $_POST['user']);
		$senha = mysqli_real_escape_string($connect, $_POST['pass']);
		$senha = md5($senha);
			
		$result_usuario = "SELECT * FROM user WHERE login = '$usuario' && password = '$senha' LIMIT 1";
		$resultado_usuario = mysqli_query($connect, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
		
		if(empty($resultado)){
			$_SESSION['loginErro'] = "<div class='alert alert-danger m-0 text-center text-danger mt-2'role='alert'>
  										Usuário e/ou senha inválidos.
									</div>";
		}elseif(isset($resultado) and ($resultado['status'] == 2)){
			$_SESSION['loginErro'] = "<div class='alert alert-danger m-0 text-center text-danger mt-2'role='alert'>
  										Usuário desativado.<br>Entre em contato com o administrator do sistema.
									</div>";
		}elseif(($usuario == $resultado['login']) and ($senha == $resultado['password'])){
			if($resultado['accesslevel'] == 1){
				session_start();
				$_SESSION['userId'] = $resultado['id'];
				$_SESSION['userName'] = $resultado['name'];
				$_SESSION['userRole'] = $resultado['role'];
				$_SESSION['userAl'] = $resultado['accesslevel'];
				$_SESSION['userStatus'] = $resultado['status'];
				$_SESSION['userLogin'] = $resultado['login'];
				header("Location: ../dashboard/");
			}else{
				header("Location: ../");
			}		
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../assets/style/css/bootstrap.css" />
	<link rel="stylesheet" href="../assets/style/css/login.css" />
	<link rel="shortcut icon" href="../assets/image/favico.png" />
	<meta charset="utf-8">
	<title>Login - Lista de Ramais</title>
</head>
<body>
<div class="container-fluid">
	<div class="container mx-auto">
		<div class="border rounded shadow p-3 mb-5 bg-white box">
			<div class="logo">
			</div>
			<form method="POST" action="">
				<div class="form-group form-login">
				    <label class="titulo">Usuário</label>				
				    <input type="text" class="form-control" name="user" required autofocus>
	  			</div>
				<div class="form-group form-login">
				    <label class="titulo">Senha</label>
				    <input type="password" class="form-control" name="pass" required>
				</div>
				<div class="form-login">
				    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
				    	<?php if(isset($_SESSION['loginErro'])){
							echo $_SESSION['loginErro'];
							unset($_SESSION['loginErro']);
							}
						?>
				  	
				</div>
			</form>
			<div class="container text-center alert alert-danger">
				<a href=".././">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
					</svg>
					Voltar para lista de ramais
				</a>
			</div>
		</div>
	</div>
</div>
<footer>
	<div class="footer-copyright">
        <p>Copyright © <?php echo date("Y"); ?> - Desenvolvido por Henrique Lockmann</p>
    </div>
</footer>


<script type="text/javascript" src="assets/style/jquery/jquery.js"></script>
<script type="text/javascript" src="assets/style/js/bootstrap.bundle.min.js"></script>
</body>
</html>