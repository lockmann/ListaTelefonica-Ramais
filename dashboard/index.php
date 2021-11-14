<?php
session_start();
$id_user = $_SESSION['userId'];
$al_user = $_SESSION['userAl'];
$dt_ = date("Y-m-d H:i");
require_once('../connect.php');
if(!isset($_SESSION['userId'])){
	header("Location: ../");
};

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../assets/style/css/bootstrap.css" />
	
	<script src="../assets/style/jquery/jquery.js"></script>
	<script src="../assets/style/jquery/jquery_mask.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

	<link rel="stylesheet" type="text/css" href="assets/style/style-dashboard.css">
	<link rel="shortcut icon" href="../assets/image/favico.png" />
	<meta charset="utf-8">
	<title>Dashboard - Lista de Ramais</title>
</head>
<body class="d-flex">
		<div class="bar-left">
				<div class="perfil">
					<div class="avatar text-center p-2 mt-2">
					</div>
					<div class="text-white text-center ">
						<p class="m-0"><?php echo $_SESSION['userName']?></p>
						<small class="text-info"><?php echo $_SESSION['userRole']?></small>
						<hr class="border-info">
					</div>
				</div>
				<div class="menu mt-3">
					<ul>
						<a href="./">
							<li class="align-items-center">
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-house-door-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
								  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
								</svg>
								Início
							</li>
						</a>
						<a href="./?p=bips">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-phone-landscape-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M2 12.5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H2zm11-6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
								</svg>
								Bip's
							</li>
						</a>
						<a href="./?p=linhas-diretas">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-telephone-forward-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.761.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z"/>
							</svg>
							Linhas Diretas
							</li>
						</a>
						<a href="./?p=ramais">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-telephone-fill mr-1 " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
								</svg>
								Ramais
							</li>
						</a>
						<a href="./?p=restritos">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-x-octagon-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
								</svg>
								Restritos
							</li>
						</a>
						<a href="./?p=usuarios">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-person-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
								</svg>
								Usuários
							</li>
						</a>
						<a href="./?p=alterar-senha">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-key-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
								</svg>
								Alterar Senha
							</li>
						</a>
						<a href="../" target="_blank">
							<li>
								<svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-journal-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1H2a2 2 0 0 1 2-2z"/>
								  <path d="M2 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H2zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H2zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H2z"/>
								  <path fill-rule="evenodd" d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
								</svg>
								Visualizar Lista
							</li>
						</a>
						<a href="sair">
							<li>
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-open-fill mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
								</svg>
								Sair
							</li>
						</a>
					</ul>
				</div>
		</div>
		<div class="main p-0">
			<?php
				$p = @$_GET['p'];
				if(empty($p)){
				    require_once('page/home.php');
				}elseif ($p == "bips") {
					require_once('page/bips.php');
				}elseif ($p == "linhas-diretas") {
					require_once('page/linhasdiretas.php');
				}elseif ($p == "ramais") {
					require_once('page/ramais.php');
				}elseif ($p == "restritos") {
					require_once('page/restritos.php');
				}elseif ($p == "usuarios") {
					require_once('page/usuarios.php');
				}elseif ($p == "alterar-senha") {
					require_once('page/alterarsenha.php');
				}elseif ($p == "adicionar-bip") {
					require_once('page/actions/addbip.php');
				}elseif ($p == "adicionar-ramal") {
					require_once('page/actions/addramal.php');
				}elseif ($p == "adicionar-linha-direta") {
					require_once('page/actions/addlinhadireta.php');
				}elseif ($p == "adicionar-numero-restrito") {
					require_once('page/actions/addrestrito.php');
				}elseif ($p == "adicionar-contato-restrito") {
					require_once('page/actions/addcontatorestrito.php');
				}elseif ($p == "adicionar-usuario") {
					require_once('page/actions/addusuario.php');
				}elseif ($p == "e") {
					require_once('page/modeledit.php');
				}elseif ($p == "d") {
					require_once('page/modeldelete.php');
				}elseif ($p == "r") {
					require_once('page/editrestrito.php');
				}elseif ($p == "dr") {
					require_once('page/modeldelete.php');
				}elseif ($p == "ue") {
					require_once('page/editusuarios.php');
				}else{
					printf('<script>window.location.href = "./";</script>');
				};
			?>
		</div>
	
<script src="../assets/style/js/bootstrap.bundle.min.js"></script>
</body>
</html>