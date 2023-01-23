<?php
require_once 'config.php';
require_once DBAPI;

include (HEADER_TEMPLATE);
	$db = open_database();

	if ($db):

	@session_start();

	if( !isset ($_SESSION['brabusrh']) == true or $_SESSION['nivel_acesso'] != 2 ) {
		unset($_SESSION["login"]);
		unset($_SESSION["senha"]);
		echo "<script>alert('Para acessar essa página você precisa estar logado');  window.location.replace('".BASEURL."');</script>";
	}
	
	$logado = $_SESSION["login"];
	

?>

<h1>Painel de Controle</h1>
<hr />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="row">
	<div class="col-xs-6 col-sm-3 col-md-2">
		<a href="candidato" class="btn btn-default">
			<div class="row">
				<div class="col-xs-12 text-center"><i class="fa fa-search fa-5x"></i></div>
				<div class="col-xs-12 text-center"><p>Candidatos</p></div>
			</div>
		</a>
	</div>
</div>

<?php else : ?>

<div class="alert alert-danger" role="alert">
	<p>
		<strong>ERRO:</strong> Não foi possível conectar-se ao Banco de Dados!
	</p>
</div>


<?php endif; ?>		
<?php include(FOOTER_TEMPLATE); ?>