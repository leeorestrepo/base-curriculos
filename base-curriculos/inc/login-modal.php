<?php
$db = open_database();

if (@$_GET ['go'] == 'login') {
	
	$login = removeMask($_POST ['cpf']);
	$senha = $_POST ['pwd'];
	
	if (empty ( $login )) {
		echo "<script>alert('Preencha todos os campos.'); history.back();</script>";
	} elseif (empty ( $senha )) {
		echo "<script>alert('Preencha todos os campos.'); history.back();</script>";
	} else {
		$database = open_database();
		
		try {
			$sql = "SELECT * FROM candidato WHERE cpf = $login AND senha = '$senha'";
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc ();
				
				if ($found['situacao'] == 1 ) {
					$_SESSION['empresa'] = true;
					// Guarda na sessão os dados de acesso informados
					$_SESSION["login"] = $login;
					$_SESSION["senha"] = $senha;
					
					$_SESSION["nivel_acesso"] = $found["nivel_acesso"];
					
					$_SESSION["id"] = $found["id"];
					$_SESSION["nome"] = $found["nome"];
					$_SESSION["cpf"] = $found["cpf"];
					$_SESSION["data_nasc"] = $found["data_nasc"];
					$_SESSION["sexo"] = $found["sexo"];
					$_SESSION["estado_civil"] = $found["estado_civil"];
					$_SESSION["filhos"] = $found["filhos"];
					$_SESSION["cod_nacionalidade"] = $found["cod_nacionalidade"];
					
					$_SESSION ['message'] = 'Olá ' . getNome($_SESSION["nome"]) . ', seja bem-vindo ao nosso Recursos Humanos.';
					$_SESSION ['type'] = 'success';
					
				} else if ($found['situacao'] == 0) {
					$_SESSION ['message'] = 'Sua conta não foi ativada.';
					$_SESSION ['type'] = 'warning';
					
				}
			} else {
				
				$_SESSION ['message'] = 'CPF ou Senha estão incorretos, certifique-se de informar os dados corretamente e tente novamente.';
				$_SESSION ['type'] = 'danger';
			}
		} catch ( Exception $e ) {
			
			$_SESSION ['message'] = $e->GetMessage ();
			$_SESSION ['type'] = 'danger';
		}
	
		if ( $_SESSION['nivel_acesso'] == 2 ) echo "<script>window.location.replace('" . BASEURL . "dashboard.php');</script>";
		else echo "<script>window.location.replace('" . BASEURL . "');</script>";
		close_database ( $database );
	}
}

if (@$_GET ['go'] == 'forgot') {
	if ( !empty( $_POST['recover_cpf'] ) ) $cpf = removeMask($_POST ['recover_cpf']);
	if ( !empty( $_POST['recover_nasc'] ) ) $data_nasc = dateFormat('Y-m-d', $_POST['recover_nasc'] );
	if ( !empty( $_POST['recover_email'] ) ) $email = $_POST ['recover_email'];

	if (empty ( $cpf )) {
		echo "<script>alert('Preencha todos os campos.'); window.location.replace('" . BASEURL . "');</script>";
	} elseif (empty ( $data_nasc )) {
		echo "<script>alert('Preencha todos os campos.'); window.location.replace('" . BASEURL . "');</script>";
	} elseif (empty ( $email )) {
		echo "<script>alert('Preencha todos os campos.'); window.location.replace('" . BASEURL . "');</script>";
	} else{
		$database = open_database();
		
		try {
			$candidato = selectOne('candidato', "SELECT * FROM candidato WHERE cpf = $cpf AND data_nasc = '$data_nasc' AND email = '$email'");

			if ($candidato['id'] > 0) {
				$novasenha = getCriptografado(6);
				
				update('candidato', "senha='$novasenha'", $candidato['id']);
				
				$corpo = '<table class="body-wrap" style="margin: auto; padding: 0px; font-size: 16px; font-family: calibri; line-height: 1.65; height: 821px; background: rgb(248, 248, 248); width: 1817px;">
	<tbody style="margin: 0px; padding: 0px; line-height: 1.65;">
		<tr style="margin: 0px; padding: 0px; line-height: 1.65;">
			<td class="container" style="padding: 0px; line-height: 1.65; margin: 0px auto !important; display: block !important; clear: both !important; max-width: 580px !important;">
			<table style="margin: 0px; padding: 0px; line-height: 1.65; border-collapse: collapse; width: 580px;">
				<tbody style="margin: 0px; padding: 0px; line-height: 1.65;">
					<tr style="margin: 0px; padding: 0px; line-height: 1.65;">
						<td align="center" style="margin: 0px; padding: 0px; line-height: 1.65;"><img class="masthead" src="http://www.empresa.com.br/images/background-email-white.jpg" style="margin: 0px auto; padding: 20px 0px; line-height: 1.65; max-width: 100%; display: block; background: rgb(29, 29, 29); color: white;" /></td>
					</tr>
					<tr style="font-family: calibri;margin: 0px; padding: 0px; line-height: 1.65;">
						<td class="content" style="margin: 0px; padding: 30px 7%; line-height: 1.65; background: white;">
						<h2 style="font-family: calibri; margin: 0px 0px 20px; padding: 0px; font-size: 28px; line-height: 1.25;">Ol&aacute;, ' . getNome( $candidato['nome'] ) . '</h2>

						<p style="font-family: calibri; margin: 0px 0px 20px; padding: 0px; line-height: 1.65;">Foi solicitada a recupera&ccedil;&atilde;o de senha de sua conta em nosso site&nbsp;<a href="http://www.empresa.com.br/" style="margin: 0px; padding: 0px; line-height: 1.65; color: rgb(29, 29, 29); text-decoration: none;"><b>www.empresa.com.br</b></a><br style="margin: 0px; padding: 0px; line-height: 1.65;" />
						<p>N&oacute;s validamos, e todos os dados informados para a recupera&ccedil;&atilde;o de senha s&atilde;o validos. Conforme abaixo:</p><br>
						CPF:&nbsp;<b style="margin: 0px; padding: 0px; line-height: 1.65;">' . mask( $candidato['cpf'] , '###.###.###-##' ) . '</b><br style="margin: 0px; padding: 0px; line-height: 1.65;" />
						Data de Nascimento:&nbsp;<b style="margin: 0px; padding: 0px; line-height: 1.65;">' . date_format(date_create($candidato['data_nasc']), 'd/m/Y') . '</b><br style="margin: 0px; padding: 0px; line-height: 1.65;" />
						E-mail:&nbsp;<b style="margin: 0px; padding: 0px; line-height: 1.65;">' . $candidato['email'] . '</b></p>
						<br><br><p style="margin: 0px 0px 20px; padding: 0px; line-height: 1.65; text-align: center"><b>Portanto, n&oacute;s geramos uma nova senha para voc&ecirc;!</b></p>

						<table style="margin: 0px; padding: 0px; line-height: 1.65; border-collapse: collapse; width: 510px;">
							<tbody style="margin: 0px; padding: 0px; line-height: 1.65;">
								<tr style="margin: 0px; padding: 0px; line-height: 1.65;">
									<td align="center" style="margin: 0px; padding: 0px; line-height: 1.65;">
									<br>
									<p style="margin: 0px 0px 20px; line-height: 1.65;"><span style="padding: 15px 40px 15px 40px; background-color: lightyellow; border: 1px solid orange; color: black;text-decoration: none; font-weight: bold">' . $novasenha . '</span></p>
									</td>
								</tr>
							</tbody>
						</table>
						<br>
						<p style="margin: 0px 0px 20px; padding: 0px; line-height: 1.65;">Em caso de d&uacute;vidas, ficamos &agrave; disposi&ccedil;&atilde;o atrav&eacute;s do e-mail&nbsp;<b style="margin: 0px; padding: 0px; line-height: 1.65;"><a href="mailto:rh@empresa.com.br?subject=Empresa%20RH%20-%20D%C3%BAvida" style="margin: 0px; padding: 0px; line-height: 1.65; color: rgb(29, 29, 29); text-decoration-line: none;">rh@empresa.com.br</a></b>.</p>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr style="margin: 0px; padding: 0px; line-height: 1.65;">
			<td class="container" style="padding: 0px; line-height: 1.65; margin: 0px auto !important; display: block !important; clear: both !important; max-width: 580px !important;">
			<table style="margin: 0px; padding: 0px; line-height: 1.65; border-collapse: collapse; width: 580px;">
				<tbody style="margin: 0px; padding: 0px; line-height: 1.65;">
					<tr style="margin: 0px; padding: 0px; line-height: 1.65;">
						<td align="center" class="content footer" style="margin: 0px; padding: 30px 35px; line-height: 1.65; background: none;">
						<p style="margin: 0px; padding: 0px; font-size: 14px; line-height: 1.65; color: rgb(136, 136, 136); font-family: helvetica;">Empresa | Recursos Humanos</p>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>';
				$email_enviado = sendMail( $candidato['email'], $corpo, 'Empresa RH | Recuperação de Senha');
				
				if ($email_enviado) {
					$_SESSION ['message'] = 'Sua nova senha foi enviada com sucesso.';
					$_SESSION ['type'] = 'success';
				} else {
					$_corpo = "<h2>Por algum motivo o candidato n&atilde;o conseguiu finalizar sua recupera&ccedil;&atilde;o de senha.</h2>
								<b>Foram informados os seguintes dados:</b><br>
								<b>CPF</b>: $cpf<br>
								<b>Data de Nascimento</b>: $data_nasc<br>
								<b>E-mail</b>: $email<br>";
					sendMail( EmailList::$desenvolvimento, $_corpo, '[ERRO] Empresa RH | Recupera&ccedil;&atilde;o de Senha');
					$_SESSION ['message'] = 'Houve algum problema, e seu e-mail n&atilde;o foi enviado. Nossa equipe foi notificada e estaremos entrando em contato assim que possível.';
					$_SESSION ['type'] = 'danger';
				}
			} else {
				$_SESSION ['message'] = 'Seu cadastro n&atilde;o foi encontrado. Certifique-se de ter informado os dados corretos.';
				$_SESSION ['type'] = 'danger';
			}
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->GetMessage ();
			$_SESSION ['type'] = 'danger';
			
		}
		
		echo "<script>window.location.replace('" . BASEURL . "');</script>";
		close_database ( $database );
	}
}

?>

<!-- Login / Register Modal-->
<div class="modal fade login-register-form" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>
				</button>

				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#login-form"> Login <span class="glyphicon glyphicon-user"></span></a></li>
					<li><a href="<?php echo BASEURL;?>candidato/add.php"> Cadastro <span class="glyphicon glyphicon-pencil"></span></a></li>
				</ul>
			</div>

			<div class="modal-body">
				<div class="tab-content">
					<div id="login-form" class="tab-pane fade in active">
						<form id="access-form" method="post" action="?go=login">
							<div class="form-group">
								<label for="cpf">CPF</label>
								<input type="text" class="form-control" id="cpf" placeholder="Informe seu CPF" maxlength="14" name="cpf" OnKeyPress="formatar('###.###.###-##', this); return inputNumber(event)" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="pwd">Senha</label>
								<input type="password" class="form-control" id="pwd" placeholder="Informe sua senha" name="pwd" >
							</div>
							<div class="form-group">
								<a href="#" id="" data-toggle="modal" data-target=".forgot-password-form">Esqueci minha senha</a>
							</div>
							<button type="submit" class="btn btn-primary">Entrar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Login / Register Modal-->
<div class="modal fade forgot-password-form" role="dialog">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-body">
<div class="tab-content">
<button type="button" class="close" data-dismiss="modal">
	<span class="glyphicon glyphicon-remove"></span>
</button>

<div id="forgot-password-form" class="tab-pane fade in active">
<div class="">
	<div class="text-center">
		<h3><i class="fa fa-lock fa-4x"></i></h3>
		<h3 class="text-center">Esqueceu sua senha?</h3>
		<p>Se todos os campos forem validos, ao clicar em <i>resetar senha</i> uma nova senha será enviada ao seu e-mail cadastrado.</p>
		
		<div class="panel-body">

		<form id="forgot-pass-form" role="form" autocomplete="off" class="form" method="post" action="?go=forgot">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user color-blue"></i></span>
					<input type="text" class="form-control" name="recover_cpf" placeholder="CPF" maxlength="14" OnKeyPress="formatar('###.###.###-##', this); return inputNumber(event)" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar color-blue"></i></span>
					<input type="text" class="form-control" name="recover_nasc" maxlength="10" placeholder="<?php echo date("d/m/Y"); ?>" onkeypress="formatar('##/##/####', this); return inputNumber(event)" autocomplete="off" style="padding-right:10px;" />
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope color-blue"></i></span>
					<input type="email" class="form-control" name="recover_email" placeholder="Endereço de e-mail">
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success btn-block" >Enviar nova senha</button>
			</div>

			<input type="hidden" class="hide" name="token" id="token" value=""> 
		</form>

		</div>
	</div>
<!-- </DIV> -->
<!-- </div> -->

</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>