<?php
	require_once 'connect.php'; 
	require_once 'erro.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="assets/style/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/style/css/index.css" />
	<meta charset="utf-8"> 
	<title>Lista de Ramais, Bips e Linhas diretas</title>
	<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&amp;family=Poppins:wght@400;600&amp;display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="assets/image/favico.png" />
</head>
<body>
<header class="fixed-top shadow-sm">
		<div class="container-fluid text-white bg-lock">
			<div class="container d-flex flex-row bg-lock">
				<div class="container d-flex justify-content-end p-0">
					<a href="./">Início</a>
					<a href="?l=bips" class="text-white">Bip's</a>
					<a href="?l=linhasdiretas" class="text-white">Linhas diretas</a>
					<a href="login">Fazer login</a>
				</div>
			</div>
		</div>
		<div class="container pt-2 pb-2 d-flex">
			<div class="">
				<a href="./"></a>
			</div>
			<div class="container p-0 d-flex justify-content-end align-self-center">
				<div>
				<form class="" id="search" method="POST" action="">
					<input type="text" class="form-control border-top-0 border-right-0 border-left-0 border-lock rounded-0 p-0" name="pesquisar" placeholder="Digite o setor" required="required" >
					</div>
					<div>
						<button type="submit" class="btn btn-primary mb-2 ml-2 rounded bg-lock border-0">
							Pesquisar 
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
							  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
							</svg>
						</button>
					</div>
				</form>
			</div>		
		</div>
</header>

