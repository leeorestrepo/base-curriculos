<?php
require_once 'config.php';
require_once DBAPI;

include (HEADER_TEMPLATE);

@session_start();

$db = open_database();

if ($db):



?>

<style>

.item img {
	width: 1140px;
	height: 335px;
}

.card-img-top {
	box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}

</style>

<div id="bannerCarousel" style="margin-top:20px;" class="carousel slide" data-ride="carousel">

<!-- Indicadores -->
<ol class="carousel-indicators">
	<li data-target="#bannerCarousel" data-slide-to="0" class="active"></li>
<!--	<li data-target="#bannerCarousel" data-slide-to="1"></li>-->
</ol>

<!-- Wrapper dos slides -->
<div class="carousel-inner">
	<div class="item active">
		<img src="<?php echo BASEURL; ?>images/banner/banner-mit4.jpg" alt="Mitsubishi" style="width: 100%">
		<div class="carousel-caption">
			<h3>Empresa Marca</h3>
			<p>Trabalhe conosco!</p>
		</div>
	</div>

</div>

<!-- Controles de Slide -->
	<a class="left carousel-control" href="#bannerCarousel" data-slide="prev"  style="padding-top:15%;width:7%">
		<span class="fa fa-chevron-left"></span>
		<span class="sr-only">Anterior</span>
	</a>
	<a class="right carousel-control" href="#bannerCarousel" data-slide="next" style="padding-top:15%;width:7%">
		<span class="fa fa-chevron-right"></span>
		<span class="sr-only">Próximo</span>
	</a>
</div>



    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-sm-8">
          <h2 class="mt-4">A Empresa</h2>
          <p>O grupo Empresa iniciou suas atividades no ano de 1991 com a inauguração de sua primeira loja e hoje é referência entre os grupos de concessionárias no País. São mais de 500 colaboradores, entre eles 50 técnicos treinados e certificados pelas montadoras para cuidar das revisões e manutenções do seu veículo.
          <p>Esta equipe faz da Empresa hoje uma das maiores concessionárias das Américas e também a mais completa, com venda de veículos novos, seminovos, peças originais, serviços de mecânica e funilaria.</p>
          <p>Todos os serviços do mercado de veículos premium com atendimento personalizado com o objetivo de proporcionar ao cliente a melhor experiência.</p> 
          <p>
            <a class="btn btn-primary" href="<?php echo BASEURL; ?>sobre.php">Mais sobre &raquo;</a>
          </p>
        </div>
        <div class="col-sm-3">
        
        <!-- Formulário de login na página inicial -->
        <?php if ( !isset( $_SESSION["empresa"] ) ) {?>
          <h3 class="mt-4"><span class="fa fa-sign-in"></span> Acessar minha conta</h3>
			<div class="modal-body">
				<div class="tab-content">
					<div id="login-form" class="tab-pane fade in active">
						<form id="index-form" method="post" action="?go=login">
							<div class="form-group">
								<label for="cpf">CPF</label>
								<input type="text" class="form-control" id="index_cpf" placeholder="Informe seu CPF" maxlength="14" name="cpf" OnKeyPress="formatar('###.###.###-##', this);  return inputNumber(event)">
							</div>
							<div class="form-group">
								<label for="pwd">Senha</label>
								<input type="password" class="form-control" id="index_pwd" placeholder="Informe sua senha" name="pwd" >
							</div>

							<button type="submit" class="btn btn-success">Entrar</button>
							<a href="#" id="" data-toggle="modal" style="padding-left: 20px;" data-target=".forgot-password-form">Esqueci minha senha</a>
							
							<div class="form-group">
								<br>
								<a class="btn btn-primary btn-block" href="candidato/add.php">Cadastre-se</a>

							</div>
						</form>
					</div>
				</div>
			</div>
			
			<?php } else { ?>

			<h3 class="mt-4"><span class="fa fa-user"></span> Painel de Controle</h3>
			<?php if ( $_SESSION['nivel_acesso'] == 2 ) {?>
				<!-- PENSAR EM POSSIBILIDADES -->
				<!-- Lista otimizada de candidatos -->
				<!-- Lista otimizada de candidatos -->
				<!-- Lista otimizada de candidatos -->
				
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-6">
						<a href="dashboard.php" class="btn btn-primary">
							<div class="row">
								<div class="col-xs-12 text-center"><i class="fa fa-list-alt fa-2x"></i></div>
								<div class="col-xs-12 text-center"><p>Dashboard</p></div>
							</div>
						</a>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-6">
						<a href="candidato/" class="btn btn-default">
							<div class="row">
								<div class="col-xs-12 text-center"><i class="fa fa-search fa-2x"></i></div>
								<div class="col-xs-12 text-center"><p>Candidatos<br></p></div>
							</div>
						</a>
					</div>
				</div>
				
				<?php } else { ?>

				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-6">
						<a href="candidato/curriculo.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">
							<div class="row">
								<div class="col-xs-12 text-center"><i class="fa fa-file-text-o fa-1x"></i></div>
								<div class="col-xs-12 text-center"><p>Curriculo</p></div>
							</div>
						</a>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-6">
						<a href="candidato/edit.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-default">
							<div class="row">
								<div class="col-xs-12 text-center"><i class="fa fa-pencil fa-1x"></i></div>
								<div class="col-xs-12 text-center"><p>Cadastro<br></p></div>
							</div>
						</a>
					</div>
				</div>

			<?php }
				} ?>
        </div>
      </div>
      <!-- /.row -->

	<!-- unidades -->
      <div class="row">
        <div class="col-sm-12">
        <h2 class="mt-4"><span class="fa fa-map-marker"></span> Unidades</h2>
        
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniNacoes.jpg" alt="">
            <div class="card-body">
				<h4 class="card-title">Unidade 1</h4>
				<span class="card-text"><b>Serviços</b></span><br>
				<span class="card-text">Endereço, Número</span>
				<p><span class="card-text">Cidade, Estado</span></p>
				<p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniBand.jpg" alt="">
            <div class="card-body">
				<h4 class="card-title">Unidade 2</h4>
				<span class="card-text"><b>Serviços</b></span><br>
				<span class="card-text">Endereço, Número</span>
				<p><span class="card-text">Cidade, Estado</span></p>
				<p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniEuropa.jpg" alt="">
            <div class="card-body">
				<h4 class="card-title">Unidade 3</h4>
				<span class="card-text"><b>Serviços</b></span><br>
				<span class="card-text">Endereço, Número</span>
				<p><span class="card-text">Cidade, Estado</span></p>
				<p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniKennedy.jpg" alt="">
            <div class="card-body">
				<h4 class="card-title">Unidade 4</h4>
				<span class="card-text"><b>Serviços</b></span><br>
				<span class="card-text">Endereço, Número</span>
				<p><span class="card-text">Cidade, Estado</span></p>
				<p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

		<div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniStoAndre.jpg" alt="">
            <div class="card-body">
				<h4 class="card-title">Unidade 5</h4>
				<span class="card-text"><b>Serviços</b></span><br>
				<span class="card-text">Endereço, Número</span>
				<p><span class="card-text">Cidade, Estado</span></p>
				<p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        
        <div class="col-sm-3 my-4" style="margin-top: 20px">
          <div class="card">
            <img class="card-img-top" src="<?php echo BASEURL; ?>images/lojas/miniRudge.jpg" alt="">
            <div class="card-body">
				<h4 class="card-title">Unidade 6</h4>
				<span class="card-text"><b>Serviços</b></span><br>
				<span class="card-text">Endereço, Número</span>
				<p><span class="card-text">Cidade, Estado</span></p>
				<p><span class="fa fa-phone"></span> Tel: (11) 9999-9999</p>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
          </div>
        </div>
      </div>
	</div>
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
