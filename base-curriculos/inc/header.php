<?php  
include (FUNCTIONS);
include (EMAILS);

/*
 *  Verificar se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema),
 * burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, 
 *  então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
*/

session_start();

if (@$_GET ['go'] == 'sair') {
	
	if(isset ($_SESSION['empresa']) == true) {

		unset($_SESSION['empresa']);
		unset($_SESSION["login"]);
		unset($_SESSION["senha"]);
		unset($_SESSION["nivel_acesso"]);
		unset($_SESSION["id"]);
		unset($_SESSION["nome"]);
		unset($_SESSION["cpf"]);
		unset($_SESSION["data_nasc"]);
		unset($_SESSION["sexo"]);
		unset($_SESSION["estado_civil"]);
		unset($_SESSION["filhos"]);
		unset($_SESSION["cod_nacionalidade"]);

		echo "<script>window.location.replace('".BASEURL."');</script>";
	}
	
}

if (@$_GET ['go'] == 'avaliar') {
	
	if ( $candidato['id'] > 0 ) {
		
		$items = "data_avaliacao='".date("Y-m-d H:i:s")."'";
		$items .= ", usuario_avaliou = ".$_SESSION['id'];
		$items .= ", avaliacao_rh = " . $_POST['hiddenAvaliacao'];
		$items .= ", status_avaliacao = " . $_POST['status_avaliacao'];
		$items .= ", observacoes_rh = '" . $_POST['observacoes_rh']."'";
		
		if ( update('candidato', $items, $cand->getId()) ) {
			$_SESSION ['message'] = 'Candidato avaliado com sucesso.';
			$_SESSION ['type'] = 'success';
		}
		
		echo "<script>window.location.replace('" . BASEURL . "candidato/curriculo.php?id=".$cand->getId()."');</script>";
	};
	
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Empresa | Recursos Humanos.</title>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="shortcut icon" href="<?php echo BASEURL; ?>favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- ICONES PARA MOBILE -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASEURL; ?>icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASEURL; ?>icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo BASEURL; ?>icons/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASEURL; ?>icons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo BASEURL; ?>icons/manifest.json">
	<link rel="mask-icon" href="<?php echo BASEURL; ?>icons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="Empresa RH">
	<meta name="application-name" content="Empresa RH">
	<meta name="theme-color" content="#606e73">
	<!-- <meta name="description" content="A maior concessionaria Marca da América Latina, e mais novo grupo de concessionária Marca2 e Marca3.">
	<meta name="robots" content="index,follow">
	<meta name="rating" content="general">
	<meta name="language" content="portuguese">
	<meta name="country" content="Brasil">
	<meta name="city" content="São Paulo">
	<meta name="distribution" content="global">
	<meta name="author" content="Grupo Empresa - rh@empresa.com.br /">
  
  
  
   //Open Graph Data
	<meta property="og:title" content="Empresa | Recursos Humanos">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.empresa.com.br">
	<meta property="og:image" content="<?php // echo BASEURL; ?>/images/empresa.png">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="600"> 
	<meta property="og:image:height" content="600"> 
	<meta property="og:description" content="Trabalhe conosco">
	<meta property="og:site_name" content="Empresa RH">
	<meta property="og:locale" content="pt_br">
	<meta property="fb:admins" content="empresamarcaoficial">
	
-->
  
<!-- METADADOS DO FRAMEWORK -->
<link rel="stylesheet" href="<?php echo BASEURL; ?>vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="<?php echo BASEURL; ?>dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="<?php echo BASEURL; ?>vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>vendor/bootstrap/js/bootstrap-show-password.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>dist/js/bootstrapValidator.js"></script>

<!-- METADADOS DA APLICAÇÃO -->
<link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
<link rel="stylesheet" href="<?php echo BASEURL; ?>vendor/font-awesome/css/font-awesome.min.css">
<script type="text/javascript" src="<?php echo BASEURL; ?>js/index.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>js/sorttable.js"></script>

<!-- METADADOS DO DATEPICKER -->
<link rel="stylesheet" href="<?php echo BASEURL; ?>vendor/datepicker/css/bootstrap-datepicker.css"/>
<script type="text/javascript" src="<?php echo BASEURL; ?>vendor/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo BASEURL; ?>vendor/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>

<!-- FUNCTIONS -->
<script type="text/javascript" src="<?php echo BASEURL; ?>js/functions.js"></script>

<style>

.bg-default2 {
	color: #333;
	background-color: #fff;
	border-color: #ccc;
}

.bg-default2:hover {
	color: #333;
	background-color: #e6e6e6;
	border-color: #adadad;
}

.bg-primary2 {
	color: #fff;
	background-color: #428bca;
	border-color: #357ebd;
}

.bg-primary2:hover {
	color:#red;
	background-color:#3071a9;
	border-color:#285e8e;
}

.bg-info2 {
	color: #fff;
	background-color: #5bc0de;
	border-color: #46b8da;
}

.bg-info2:hover {
	color:#fff;
	background-color: #31b0d5;
	border-color: #269abc;
}

.bg-danger2 {
	color: #fff;
	background-color: #d9534f;
	border-color: #d43f3a;
}

.bg-danger2:hover {
	color:#fff;
	background-color: #c9302c;
	border-color: #ac2925;
}

.bg-success2 {
	color: #fff;
	background-color: #5cb85c;
	border-color: #4cae4c;
}

.bg-success2:hover {
	color:#fff;
	background-color: #449d44;
	border-color: #398439;
}

.bg-grey2 {
	color: #fff;
	background-color: #9c9c9c;
	border-color: #969696;
}

.bg-grey2:hover {
	color:#fff;
	background-color: #868686;
	border-color: #848484;
}

</style>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<div class="bannerOpacity" style="width: 200px; height: 50px">
		<a href="<?php echo BASEURL; ?>"><img src="<?php echo BASEURL; ?>images/logo_empresa_white.png" style="padding:5px;" width="250" height="50"></a>
		</div>
	</div>

	<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav navbar-right">
		
		<li><a href="<?php echo BASEURL; ?>index.php">Início</a></li>
		<li><a href="<?php echo BASEURL; ?>sobre.php">Sobre</a></li>
		<li><a href="<?php echo BASEURL; ?>lojas.php">Lojas</a></li>
		<li><a href="#" id="modal-entrar" data-toggle="modal" data-target=".login-register-form">Entrar</a></li>
		
	<?php if ( !isset( $_SESSION["empresa"] ) ) {?>
		<!-- EXIBE MENU PARA TODOS -->

		
		<li class="bg-primary2"><a style="color: #eaeaea;" href="<?php echo BASEURL; ?>candidato/add.php" >Registre-se</a></li>

	<?php } else {?>
		<!-- SE ESTIVER LOGADO -->

		<!-- EXIBE MENU DE USUARIO -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Olá, <?php echo getNome($_SESSION["nome"]); ?> <span class="caret"></span></a>				
				<ul class="dropdown-menu">

		<?php if ( $_SESSION["nivel_acesso"] == 1 ) {?>
		<!-- EXIBE SUBMENU DE CANDIDATO -->
					<li><a href="<?php echo BASEURL.'candidato/curriculo.php?id='.$_SESSION['id']?>">Curriculo</a></li>
					<li><a href="<?php echo BASEURL.'candidato/edit.php?id='.$_SESSION['id']?>">Cadastro</a></li>

			
		<?php } else if ( $_SESSION["nivel_acesso"] == 2 ) { ?>
		<!-- EXIBE SUBMENU DE RH -->
					<li style="border-bottom: 1px solid #c4c4c4;"><a href="<?php echo BASEURL; ?>dashboard.php">Painel de Controle</a></li>
			<?php } ?>
					<li><a href="<?php echo BASEURL; ?>candidato/novasenha.php">Nova Senha</a></li>
					<li><a href="?go=sair"><span class="fa fa-sign-out fa-1x"></span> Sair</a></li>
				</ul>
			</li>

	<?php } ?>

	</ul>
	</div>
</div>
</nav>
 
<?php require_once "login-modal.php"; ?>

<main class="container" style="margin-top: 50px;">

<?php if ( !empty($_SESSION['message']) && !getUrlContent("?go=")) { ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>

<i class="fa fa-bell" style="padding-right: 10px;"></i><?php echo $_SESSION['message']; ?>

</div>

<?php
	clear_messages();
}
?>