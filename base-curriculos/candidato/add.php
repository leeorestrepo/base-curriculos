<?php
require_once('functions.php');
require_once('_optionS.php');

include(HEADER_TEMPLATE);

$db = open_database();


if ($db){

if (@$_GET ['go'] == 'cad') {
	$columns = "data_criacao";
	$values = "'" . date("Y-m-d H:i:s") . "'";
	
	/** DADOS PESSOAIS **/
	
	if ( !empty($_POST['candidato_nome'] ) ) {
		$columns .= ", nome";
		$values .= ", '" . getNomeTratado($_POST ['candidato_nome']) . "'";
		
	}
	
	if ( !empty($_POST['candidato_cpf'] ) ) {
		$columns .= ", cpf";
		$values .= ", '" . removeMask($_POST['candidato_cpf']) . "'";
		
	}
	
	if ( !empty($_POST['candidato_data_nasc'] ) ) {
		$columns .= ", data_nasc";
		// $values .= ", '" . $_POST['candidato_data_nasc']->format("Y-m-d H:i:s") . "'";
		
		$values .= ", '" . dateFormat('Y-m-d', $_POST['candidato_data_nasc'] ) . " 00:00:00'";
		
	}
	
	if ( !empty($_POST['candidato_sexo'] ) ) {
		$columns .= ", sexo";
		$values .= ", '" . $_POST['candidato_sexo'] . "'";
		
	}
	
	if ( !empty( $_POST['candidato_estado_civil'] ) ) {
		$columns .= ", estado_civil";
		$values .= ", '" . $_POST['candidato_estado_civil'] . "'";
		
	}
	
	if ( $_POST['candidato_filhos'] >= 0 && $_POST['candidato_filhos'] <= 5) {
		$columns .= ", filhos";
		$values .= ", '" . $_POST['candidato_filhos'] . "'";
		
	}
	
	if ( !empty( $_POST['candidato_nacionalidade'] ) ) {
		$columns .= ", cod_nacionalidade";
		$values .= ", '" . $_POST['candidato_nacionalidade'] . "'";
		
	}
	
	if ( !empty( $_POST['candidato_confirmar_senha'] ) && $_POST['candidato_senha'] == $_POST['candidato_confirmar_senha'] ) {
		$columns .= ", senha";
		$values .= ", '" . $_POST['candidato_confirmar_senha'] . "'";
	}
	/** /.dados pessoais **/
	
	
	/** ENDEREÇO **/
	
	if ( !empty( $_POST['candidato_cep'] ) ) {
		$columns .= ", cep";
		$values .= ", '" . removeMask($_POST['candidato_cep']) . "'";
	}
	
	if ( !empty( $_POST['candidato_endereco'] ) ) {
		$columns .= ", endereco";
		$values .= ", '" . getNomeTratado($_POST['candidato_endereco']) . "'";
	}
	
	if ( !empty( $_POST['candidato_endereco_numero'] ) ) {
		$columns .= ", endereco_numero";
		$values .= ", '" . $_POST['candidato_endereco_numero'] . "'";
	}
	
	if ( !empty( $_POST['candidato_endereco_complemento'] ) ) {
		$columns .= ", endereco_complemento";
		$values .= ", '" . $_POST['candidato_endereco_complemento'] . "'";
	}
	
	if ( !empty( $_POST['candidato_bairro'] ) ) {
		$columns .= ", bairro";
		$values .= ", '" . getNomeTratado($_POST['candidato_bairro']) . "'";
	}
	
	if ( !empty( $_POST['candidato_cidade'] ) ) {
		$columns .= ", cod_cidade";
		$values .= ", '" . $_POST['candidato_cidade'] . "'";
	}
	
	if ( !empty( $_POST['candidato_estado'] ) ) {
		$columns .= ", cod_estado";
		$values .= ", '" . strtoupper($_POST['candidato_estado']) . "'";
	}
	/** /.endereco **/
	
	/** CONTATO **/
	if ( !empty( $_POST['candidato_email'] ) ) {
		$columns .= ", email";
		$values .= ", '" . strtolower($_POST['candidato_email']) . "'";
	}
	
	if ( !empty( $_POST['candidato_celular'] ) ) {
		$columns .= ", celular";
		$values .= ", '" . removeMask($_POST['candidato_celular']) . "'";
	}
	
	if ( !empty( $_POST['candidato_tel_residencial'] ) ) {
		$columns .= ", tel_residencial";
		$values .= ", '" . removeMask($_POST['candidato_tel_residencial']) . "'";
	}
	
	if ( !empty( $_POST['candidato_preferencia_contato'] ) ) {
		$columns .= ", cod_preferencia_contato";
		$values .= ", '" . $_POST['candidato_preferencia_contato'] . "'";
	}
	/** /.enderecos **/
	
	/** LINKS E REDES SOCIAIS **/
	if ( !empty( $_POST['candidato_linkedin'] ) ) {
		$columns .= ", linkedin";
		$values .= ", '" . $_POST['candidato_linkedin'] . "'";
	}
	
	if ( !empty( $_POST['candidato_facebook'] ) ) {
		$columns .= ", facebook";
		$values .= ", '" . $_POST['candidato_facebook'] . "'";
	}
	
	if ( !empty( $_POST['candidato_twitter'] ) ) {
		$columns .= ", twitter";
		$values .= ", '" . $_POST['candidato_twitter'] . "'";
	}
	
	if ( !empty( $_POST['candidato_blog'] ) ) {
		$columns .= ", blog";
		$values .= ", '" . $_POST['candidato_blog'] . "'";
	}
	/** /.links e redes sociais **/
	
	/** DEFICIENCIA **/
	if ( !empty( $_POST['candidato_deficiente'] ) ) {
		$columns .= ", deficiente";
		$values .= ", b'" . $_POST['candidato_deficiente'] . "'";
	}
	
	if ( !empty( $_POST['deficiencia_auditiva'] ) ) {
		$columns .= ", deficiencia_auditiva";
		$values .= ", b'" . $_POST['deficiencia_auditiva'] . "'";
	}
	
	if ( !empty( $_POST['deficiencia_fala'] ) ) {
		$columns .= ", deficiencia_fala";
		$values .= ", b'" . $_POST['deficiencia_fala'] . "'";
	}
	
	if ( !empty( $_POST['deficiencia_fisica'] ) ) {
		$columns .= ", deficiencia_fisica";
		$values .= ", b'" . $_POST['deficiencia_fisica'] . "'";
	}
	
	if ( !empty( $_POST['deficiencia_mental'] ) ) {
		$columns .= ", deficiencia_mental";
		$values .= ", b'" . $_POST['deficiencia_mental'] . "'";
	}
	
	if ( !empty( $_POST['deficiencia_visual'] ) ) {
		$columns .= ", deficiencia_visual";
		$values .= ", b'" . $_POST['deficiencia_visual'] . "'";
	}
	/** /.deficiencia **/
	
	/** OBJETIVOS **/
	$usouCargo3 = $usouSetor3 = false;
	
	if ( !empty ( $_POST['candidato_objetivo'] ) ) {
		$columns .= ", objetivo";
		$values .= ", '" . $_POST['candidato_objetivo'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_setor1'] ) ) {
		$columns .= ", id_setor1";
		$values .= ", '" . $_POST['candidato_setor1'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_cargo1'] ) ) {
		$columns .= ", id_cargo1";
		$values .= ", '" . $_POST['candidato_cargo1'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_setor2'] ) ) {
		$columns .= ", id_setor2";
		$values .= ", '" . $_POST['candidato_setor2'] . "'";
	} else if ( !empty ( $_POST['candidato_setor3'] ) ) {
		$columns .= ", id_setor2";
		$values .= ", '" . $_POST['candidato_setor3'] . "'";
		
		$usouSetor3 = true;
	}
	
	if ( !empty ( $_POST['candidato_cargo2'] ) ) {
		$columns .= ", id_cargo2";
		$values .= ", '" . $_POST['candidato_cargo2'] . "'";
	} else if ( !empty ( $_POST['candidato_cargo3'] ) ) {
		$columns .= ", id_cargo2";
		$values .= ", '" . $_POST['candidato_cargo3'] . "'";
		
		$usouCargo3 = true;
	}
	
	if ( !empty ( $_POST['candidato_setor3'] ) && !$usouSetor3) {
		$columns .= ", id_setor3";
		$values .= ", '" . $_POST['candidato_setor3'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_cargo3'] )  && !$usouCargo3) {
		$columns .= ", id_cargo3";
		$values .= ", '" . $_POST['candidato_cargo3'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_nivel_interesse'] ) ) {
		$columns .= ", nivel_interesse";
		$values .= ", '" . $_POST['candidato_nivel_interesse'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_pretensao_salarial'] ) ) {
		$columns .= ", cod_pretensao_salarial";
		$values .= ", '" . $_POST['candidato_pretensao_salarial'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_regiao_sp'] ) ) {
		$columns .= ", regiao_sp";
		$values .= ", b'" . $_POST['candidato_regiao_sp'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_regiao_abc'] ) ) {
		$columns .= ", regiao_abc";
		$values .= ", b'" . $_POST['candidato_regiao_abc'] . "'";
	}
	
	if ( !empty ( $_POST['candidato_regiao_barueri'] ) ) {
		$columns .= ", regiao_barueri";
		$values .= ", b'" . $_POST['candidato_regiao_barueri'] . "'";
	}	
	/** /.objetivos **/
	
	/** FORMAÇÃO ACADÊMICA **/
	if ( !empty( $_POST['candidato_nivel_escolaridade'] ) ) {
		$columns .= ", cod_nivel_escolaridade";
		$values .= ", '" . $_POST['candidato_nivel_escolaridade'] . "'";
	}
	/** /.formação acadêmica **/

	/** Verifica se já existe este CPF **/
	if ( findCPF( 'id', removeMask( $_POST['candidato_cpf'] ) ) > 0 ) {
		$_SESSION ['message'] = 'Este CPF já está cadastrado em nosso sistema. Verifique e tente novamente!';
		$_SESSION ['type'] = 'danger';
		// echo "<script>window.location.replace('" . BASEURL . "candidato/add.php');</script>";
		
	} else if ( save('candidato', $columns, $values) ) {
		
		$id_candidato = findCPF( 'id', removeMask( $_POST['candidato_cpf'] ) );
		
		/** CURSOS **/
		if ( $_POST['hiddenCursoS'] > 0) {
			$qtdCursoS = $_POST['hiddenCursoS'];
			
			for ($i = 1; $i <= $qtdCursoS; $i++) {
				$columns = "id_candidato";
				$values = $id_candidato["id"];
				
				if ( !empty( $_POST['curso_nome'.$i] ) ) {
					$columns .= ", nome";
					$values .= ", '" . getNomeTratado($_POST['curso_nome'.$i]) . "'";
				}
				
				if ( !empty( $_POST['curso_id_tipo'.$i] ) ) {
					$columns .= ", cod_tipo";
					$values .= ", '" . $_POST['curso_id_tipo'.$i] . "'";
				}
				
				if ( !empty( $_POST['curso_instituicao'.$i] ) ) {
					$columns .= ", instituicao";
					$values .= ", '" . getNomeTratado($_POST['curso_instituicao'.$i]) . "'";
				}
				
				if ( !empty( $_POST['curso_pais'.$i] ) ) {
					$columns .= ", pais";
					$values .= ", '" . getNomeTratado($_POST['curso_pais'.$i]) . "'";
				}
				
				if ( !empty( $_POST['curso_estado'.$i] ) ) {
					$columns .= ", estado";
					$values .= ", '" . getNomeTratado($_POST['curso_estado'.$i]) . "'";
				}
				
				if ( !empty( $_POST['curso_data_inicio'.$i] ) ) {
					$columns .= ", data_inicio";
					$values .= ", '" . dateFormat('Y-m-d', "00/". $_POST['curso_data_inicio'.$i] ) . " 00:00:00'";
				}
				
				if ( !empty( $_POST['curso_data_final'.$i] ) ) {
					$columns .= ", data_final";
					$values .= ", '" . dateFormat('Y-m-d', "00/" . $_POST['curso_data_final'.$i] ) . " 00:00:00'";
				}
				
				if ( !empty( $_POST['curso_situacao'.$i] ) ) {
					$columns .= ", situacao";
					$values .= ", '" . $_POST['curso_situacao'.$i]. "'";
				}
				
				save('curso', $columns, $values);
			}
		}
		/** /.cursos **/
		
		/** IDIOMAS **/
		$qtdIdiomaS = $_POST['hiddenIdiomaS'];
		
		for ($i = 1; $i <= $qtdIdiomaS; $i++) {
			$columns = "id_candidato";
			$values = $id_candidato["id"];
			
			if ( !empty( $_POST['idioma_nome'.$i] ) ) {
				$columns .= ", cod_idioma";
				$values .= ", " . $_POST['idioma_nome'.$i];
			}
			
			if ( !empty( $_POST['idioma_nivel_leitura'.$i] ) ) {
				$columns .= ", nivel_leitura";
				$values .= ", " . $_POST['idioma_nivel_leitura'.$i];
			}
			
			if ( !empty( $_POST['idioma_nivel_escrita'.$i] ) ) {
				$columns .= ", nivel_escrita";
				$values .= ", " . $_POST['idioma_nivel_escrita'.$i];
			}
			
			if ( !empty( $_POST['idioma_nivel_conversacao'.$i] ) ) {
				$columns .= ", nivel_conversacao";
				$values .= ", " . $_POST['idioma_nivel_conversacao'.$i];
			}
			
			save('idioma', $columns, $values);
		}
		/** /.idiomas **/
		
		if ( !empty( $_POST['primeiro_emprego'] ) && $_POST['primeiro_emprego'] == 2 ) {
			
			$qtdEmpregoS = $_POST['hiddenExperienciaS'];
			
			for ($i = 1; $i <= $qtdEmpregoS; $i++) {
				$columns = "id_candidato";
				$values = $id_candidato["id"];
				
				if ( !empty( $_POST['experiencia_empresa'.$i] ) ) {
					$columns .= ", empresa";
					$values .= ", '" . getNomeTratado($_POST['experiencia_empresa'.$i]) . "'";
				}
				
				if ( !empty( $_POST['experiencia_cargo'.$i] ) ) {
					$columns .= ", cargo";
					$values .= ", '" . getNomeTratado($_POST['experiencia_cargo'.$i]) . "'";
				}
				
				if ( !empty( $_POST['experiencia_salario'.$i] ) ) {
					$columns .= ", salario";
					$values .= ", '" . formatarMoeda( $_POST['experiencia_salario'.$i], 'php' ). "'";
				}
				
				if ( !empty( $_POST['experiencia_atual'.$i] ) ) {
					$columns .= ", atual";
					$values .= ", b'1'";
				
				} else {
				
					if ( !empty( $_POST['experiencia_data_admissao'.$i] ) ) {
						$columns .= ", data_admissao";
						$values .= ", '" . dateFormat('Y-m-d', "00/" . $_POST['experiencia_data_admissao'.$i]) . " 00:00:00'";
					}
					
					if ( !empty( $_POST['experiencia_data_demissao'.$i] ) ) {
						$columns .= ", data_demissao";
						$values .= ", '" . dateFormat('Y-m-d', "00/" . $_POST['experiencia_data_demissao'.$i]) . " 00:00:00'";
					}

				}

				if ( !empty( $_POST['experiencia_motivo_demissao'.$i] ) ) {
					$columns .= ", motivo_demissao";
					$values .= ", '" . $_POST['experiencia_motivo_demissao'.$i]. "'";
				}
				
				if ( !empty( $_POST['experiencia_atividades'.$i] ) ) {
					$columns .= ", atividades";
					$values .= ", '" . $_POST['experiencia_atividades'.$i]. "'";
				}
				
				save('experiencia', $columns, $values);
			}
		}
		
		$corpo = "
	<html>
	<head>
	<style>
	body {
	    padding: 0;
	    margin: 0;
	}
				
	html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
	@media only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
	    *[class='table_width_100'] {
			width: 96% !important;
		}
		*[class='border-right_mob'] {
			border-right: 1px solid #dddddd;
		}
		*[class='mob_100'] {
			width: 100% !important;
		}
		*[class='mob_center'] {
			text-align: center !important;
		}
		*[class='mob_center_bl'] {
			float: none !important;
			display: block !important;
			margin: 0px auto;
		}
		.iage_footer a {
			text-decoration: none;
			color: #929ca8;
		}
		img.mob_display_none {
			width: 0px !important;
			height: 0px !important;
			display: none !important;
		}
		img.mob_width_50 {
			width: 40% !important;
			height: auto !important;
		}
	}
				
	.table_width_100 {
		width: 680px;
	}
	</style>
	</head>
	<body>
				
	<div id='mailsub' class='notification' align='center'>
				
	<table width='100%' border='0' cellspacing='0' cellpadding='0' style='min-width: 320px;'><tr><td align='center' bgcolor='#eff3f8'>
				
	<table border='0' cellspacing='0' cellpadding='0' class='table_width_100' width='100%' style='max-width: 680px; min-width: 300px;'>
	    <tr><td>
		<!-- padding -->
		</td></tr>
		<!--header -->
		<tr><td align='center' bgcolor='#ffffff'>
			<!-- padding -->
			<table width='90%' border='0' cellspacing='0' cellpadding='0'><div style='height: 30px; line-height: 30px; font-size: 10px;'></div>
				<tr><td align='center'>
				    		<a href='#' target='_blank' style='color: #596167; font-family: Arial, Helvetica, sans-serif; float:left; width:100%; padding:20px;text-align:center; font-size: 13px;'>
										<font face='Arial, Helvetica, sans-seri; font-size: 13px;' size='3' color='#596167'>
										<img src='http://www.empresa.com.br/images/logo_Empresa.png' width='120' alt='Grupo Empresa' border='0'  /></font></a>
						</td>
						<td align='right'>
					<!--[endif]-->
			<!-- padding --><div style='height: 50px; line-height: 50px; font-size: 10px;'></div>
		</td></tr>
		<!--header END-->
		<!--content 1 -->
		<tr><td align='center' bgcolor='#fbfcfd'>
			<table width='90%' border='0' cellspacing='0' cellpadding='0'>
				<tr><td align='center'>
					<br><br><br>
					<div style='line-height: 44px;'>
						<font face='Arial, Helvetica, sans-serif' size='5' color='#57697e' style='font-size: 34px;'>
						<span style='font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;'>
							Ol&aacute;, " . getNome( getNomeTratado($_POST['candidato_nome']) ) . "!'
						</span></font>
					</div>
					<br>
					<!-- padding --><div style='height: 40px; line-height: 40px; font-size: 10px;'></div>
				</td></tr>
				<tr><td align='center'>
					<div style='line-height: 24px;'>
						<font face='Arial, Helvetica, sans-serif' size='4' color='#57697e' style='font-size: 15px;'>
						<p style='font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;'>
							Agradecemos sua candidatura em nosso site para fazer parte da equipe do Grupo Empresa.
						</p>
						<p>
						    Para n&oacute;s &eacute; muito importante saber que nossa empresa despertou seu interesse. Informamos que seu curr&iacute;culo ser&aacute; mantido em nosso banco de dados para as oportunidades de trabalho no Grupo.
						</p>
						</font>
					</div>
						<img src='http://www.empresa.com.br/images/mail-line-default.png'/>
					<br>
					<br>
				</td></tr>
				<tr><td align='center'>
					<div style='line-height: 24px;'>
									
					    <font face='Arial, Helvetica, sans-serif' size='4' color='#57697e' style='font-size: 15px;'>
						<span style='font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;'>
							Voc&ecirc; pode visualizar e atualizar seus dados cadastrais em nosso site, basta acessar com seu CPF e senha cadastrada.
						</span>
						</font>
					</div>
					<br><br>
					<div>
						<a href='http://www.empresa.com.br/' target='_blank'>
							<img src='http://www.empresa.com.br/images/mail-acessa-btn.png' border='0'/>
						</a>
					</div>
									
					<!-- padding --><br><br><br>
				</td></tr>
			</table>
		</td></tr>
		<!--content 1 END-->
									
									
		<!--footer -->
		<tr><td class='iage_footer' align='center' bgcolor='#ffffff'>
									
									
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				<tr><td align='center' style='padding:20px;flaot:left;width:100%; text-align:center;'>
					<font face='Arial, Helvetica, sans-serif' size='3' color='#96a5b5' style='font-size: 13px;'>
					<span style='font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;'>
						Empresa | Recursos Humanos.
					</span></font>
				</td></tr>
			</table>

		</td></tr>
		<!--footer END-->
		<tr><td>

		</td></tr>
	</table>
									
	</td></tr>
	</table>
	</body>
	</html>";
		
		if ($id_candidato > 0) {
			$email_enviado = sendMail( $_POST['candidato_email'], $corpo, 'Seu cadastro no Empresa RH foi efetuado com sucesso!');
		}
		
		if( $email_enviado){
			$_corpo = "<h4>Novo cadastro realizado <b>com sucesso</b>:</h4>
								<b>ID:</b> " . $id_candidato['id'] . "<br>
								<b>Nome:</b> " . getNomeTratado($_POST['candidato_nome']) . "<br>
								<b>Filhos:</b> " . getIdade($_POST['candidato_data_nasc']) . "<br>
								<b>Filhos:</b> " . $_POST['candidato_filhos'] . "<br>
								<b>E-mail:</b> " . $_POST['candidato_email'] . "<br>
								<b>Celular:</b> " . $_POST['candidato_celular'] . "<br><br>
								<b><a href='http://www.empresa.com.br/candidato/curriculo.php?id=" . $id_candidato['id'] . "'>Clique aqui</a> para acessar o curriculo.";
			
			sendMail( EmailList::$desenvolvimento, $_corpo, "[Empresa RH] Novo cadastro realizado" );
			// sendMail( EmailList::$rh, $_corpo, "[Empresa RH] Novo cadastro realizado" );
			
		}
		
		echo "<script>window.location.replace('" . BASEURL . "');</script>";
	}
	
}
?>

<div class="container">
<h2>Cadastro</h2>
<hr>
<div class="row">
	<form id="defaultForm" method="post" class="form-horizontal" action="?go=cad">
<div class="panel-group col-lg-12" id="forms">

<!-- Dados Pessoais -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-dados-pessoais">Dados Pessoais</a></h4>
	</div>

	<div id="form-dados-pessoais" class="panel-collapse collapse in">
		<div class="panel-body">
			<div class="form-group">
					<label class="col-lg-2 control-label">Nome <font color="red">*</font></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" name="candidato_nome" placeholder="Nome completo" autocomplete="off" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">CPF <font color="red">*</font></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="candidato_cpf" placeholder="123.456.789-10" maxlength="14" onkeypress="formatar('###.###.###-##', this); return inputNumber(event)" autocomplete="off"/>
				</div>	

					<label class="col-lg-2 control-label">Nascimento <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="text" class="form-control" name="candidato_data_nasc" maxlength="10" placeholder="<?php echo date("d/m/Y"); ?>" onkeypress="formatar('##/##/####', this); return inputNumber(event)" autocomplete="off" style="padding-right:10px;" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">Sexo <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_sexo" >
						<option value=""></option>
						<option value="m">Masculino</option>
						<option value="f">Feminino</option>
					</select>
				</div>
				
					<label class="col-lg-2 control-label">Estado Civil <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_estado_civil" >
						<option value=""></option>
						<option value="1">Solteiro(a)</option>
						<option value="2">Casado(a)</option>
						<option value="3">Separado(a)</option>
						<option value="4">Divorciado(a)</option>
						<option value="5">Viúvo(a)</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-2 control-label">Possui filho(s)? <font color="red">*</font></label>
				<div class="col-lg-2">
					<select class="form-control" name="candidato_filhos">
						<option value=""></option>
						<option value="0">Não</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5 ou mais</option>
					</select>
				</div>
			
				<label class="col-lg-3 control-label">Nacionalidade <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_nacionalidade">
						<option value=""></option>
						<?php for ($value = 1; $value < count($nacionalidadeS); $value++):
									if ($nacionalidadeS[$value] == 'Brasil') echo "<option value=" . $value . " class='option-selected' selected>" . $nacionalidadeS[$value] . "</option>";
									else echo "<option value=" . $value . " class='option-selected'>" . $nacionalidadeS[$value] . "</option>";
							endfor; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
					<label class="col-lg-2 control-label">Senha <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="password" class="form-control" name="candidato_senha" data-toggle="password" />
				</div>
					<label class="col-lg-3 control-label">Confirmar Senha <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="password" class="form-control" name="candidato_confirmar_senha" data-toggle="password" />
				</div>
			</div>		
		</div>
	</div>
</div>
<!-- /.dados pessoais-->

<!-- Endereço -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-endereco">Endereço</a></h4>
	</div>

	<div id="form-endereco" class="panel-collapse collapse">
<div class="panel-body">
			<div class="form-group">
					<label class="col-lg-1 control-label">CEP <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="text" class="form-control" id="cep" name="candidato_cep" placeholder="00000-000" maxlength="9" onkeypress="formatar('#####-###', this); return inputNumber(event)" onblur="getEndereco(this.id);" autocomplete="off" />
				</div>
					<span class="col-lg-2 control-label"><a href="http://www.buscacep.correios.com.br/" target="_blank">
    				  Esqueci meu CEP
    				</a></span>
			</div>
			
			<div class="form-group">
					<label class="col-lg-1 control-label">Endereço<font color="red">*</font></label>
				<div class="col-lg-6">
					<input type="text" class="form-control" id="endereco" name="candidato_endereco" placeholder="Endereço"/>
				</div>
			</div>
			<div class="form-group">
					<label class="col-lg-1 control-label">Núm. <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="text" class="form-control" id="endereco_numero" name="candidato_endereco_numero" placeholder="Número" onkeypress="return inputNumber(event)" />
				</div>
					<label class="col-lg-2 control-label">Complemento</label>
				<div class="col-lg-2">
					<input type="text" class="form-control" id="complemento" name="candidato_endereco_complemento" placeholder="Complemento" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-1 control-label" style="padding-left: 0px;">Bairro <font color="red" >*</font></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" id="bairro" name="candidato_bairro" />
				</div>

					<label class="col-lg-1 control-label" style="padding-left: 0px;">Cidade <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" id="cidade" name="candidato_cidade">
						<option value=""></option>
						<?php for ($value = 1; $value < count($cidadeS); $value++):?>
							<option value="<?php echo $value; ?>" class="option-selected"><?php echo $cidadeS[$value];?></option>
						<?php endfor; ?>
					</select>					
				</div>
				
				
					<label class="col-lg-1 control-label" style="padding-left: 0px;">UF <font color="red">*</font></label>
				<div class="col-lg-2">
					<select class="form-control" id="estado" name="candidato_estado">
						<option value=""></option>
						<?php for ($value = 1; $value < count($ufEstadoS); $value++):?>
							<option value="<?php echo $value; ?>" class="option-selected"><?php echo $ufEstadoS[$value];?></option>
						<?php endfor; ?>
					</select>					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.endereco -->

<!-- Contato -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-contato">Contato</a></h4>
	</div>

	<div id="form-contato" class="panel-collapse collapse">
<div class="panel-body">
			<div class="form-group">
					<label class="col-lg-2 control-label">E-mail <font color="red">*</font></label>
				<div class="col-lg-5">
					<input type="text" class="form-control" name="candidato_email" placeholder="E-mail" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">Celular <font color="red">*</font></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="candidato_celular" maxlength="13" placeholder="00 00000-0000" onkeypress="formatar('## #####-####', this); return inputNumber(event)" autocomplete="off" 
					/>
				</div>

					<label class="col-lg-2 control-label" style="padding-left: 0px;">Residencial</label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="candidato_tel_residencial" maxlength="13" name="candidato_celular" maxlength="13" placeholder="00 0000-0000" onkeypress="formatar('## ####-####', this); return inputNumber(event)" autocomplete="off" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">Preferência <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_preferencia_contato">
						<option value=""></option>
						<option value="1">E-mail</option>
						<option value="2">Celular</option>
						<option value="3">Tel. Residencial</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.contato -->

<!-- Links e Redes Sociais -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-redesocial">Links e Redes Sociais</a></h4>
	</div>

	<div id="form-redesocial" class="panel-collapse collapse">
<div class="panel-body">
			<div class="form-group">
						<label class="col-lg-2 control-label">LinkedIn</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-primary2"><span class="fa fa-linkedin"></span></span>
						<input name="candidato_linkedin" class="form-control" type="text" placeholder="linkedin.com/in/">
					</div>
				</div>
			</div>

			<div class="form-group">
						<label class="col-lg-2 control-label">Facebook</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-primary2"><span class="fa fa-facebook"></span></span>
						<input name="candidato_facebook" class="form-control" type="text" placeholder="facebook.com/">
					</div>
				</div>
			</div>
			
			<div class="form-group">
						<label class="col-lg-2 control-label">Twitter</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-info2"><span class="fa fa-twitter"></span></span>
						<input name="candidato_twitter" class="form-control" type="text" placeholder="twitter.com/">
					</div>
				</div>
			</div>
			<div class="form-group">
						<label class="col-lg-2 control-label">Blog</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-danger2"><span class="fa fa-rss"></span></span>
						<input name="candidato_blog" class="form-control" type="text" placeholder="Informe o endereço de seu site">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.links e redes sociais -->

<!-- Deficiência -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-deficiencia">Deficiência</a></h4>
	</div>

	<div id="form-deficiencia" class="panel-collapse collapse">
<div class="panel-body">
			<div class="form-group">
					<label class="col-lg-4 control-label">Possui algum tipo de deficiencia? <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" id="deficiente" name="candidato_deficiente" >
						<option value="" id=""></option>
						<option value="0" id="def_no">Não</option>
						<option value="1" id="def_yes">Sim</option>
					</select>
				</div>
			</div>

			<div id="deficiencia" style="display: none;">
				<div class="form-group">
                        <label class="col-lg-4 control-label">A que tipo(s) se enquadra: <font color="red">*</font></label>
                        <div class="col-lg-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="0" id="auditiva" onclick="checkThisBox(this, '#deficiencia_auditiva');" /> Auditiva
                                    <input type="hidden" name="deficiencia_auditiva" id="deficiencia_auditiva" value="0" />
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="0" id="fala" onclick="checkThisBox(this, '#deficiencia_fala')" /> Fala
                                    <input type="hidden" name="deficiencia_fala" id="deficiencia_fala" value="0" />
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="0" id="fisica" onclick="checkThisBox(this, '#deficiencia_fisica')" /> Fisica
                                    <input type="hidden" name="deficiencia_fisica" id="deficiencia_fisica" value="0" />
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="0" id="mental" onclick="checkThisBox(this, '#deficiencia_mental')" /> Intelectual/Mental
                                    <input type="hidden" name="deficiencia_mental" id="deficiencia_mental" value="0" />
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="0" id="visual" onclick="checkThisBox(this, '#deficiencia_visual')" /> Visual
                                    <input type="hidden" name="deficiencia_visual" id="deficiencia_visual" value="0" /> 
                                </label>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
	</div>
</div>
<!-- /.deficiencia -->

<!-- Objetivos -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-objetivos">Objetivos</a></h4>
	</div>

	<div id="form-objetivos" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="form-group">
                        <label class="col-lg-2 control-label">Objetivo Profissional <font color="red">*</font></label>
                        <div class="col-lg-8">
                            <textarea class="form-control" name="candidato_objetivo" maxlength="250" style="height: 100px;"></textarea>
                        </div>
                    </div>

			<div class="form-group">
				<label class="col-lg-3 control-label h4">Área de Interesse:</label>
			</div>

		<!-- PRINCIPAL -->
			<div class="form-group">
					<label class="col-lg-2 control-label">Setor <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_setor1">
						<option value=""></option>
						<?php foreach ( $setoreS as $setor ) : ?>
							<option value="<?php echo $setor['id']; ?>"> <?php echo $setor['nome']; ?></option>	
						<?php endforeach; ?>
					</select>
				</div>

					<label class="col-lg-2 control-label">Cargo <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_cargo1">
						<option value=""></option>
						<?php foreach ( $cargoS as $cargo ) : ?>
							<option value="<?php echo $cargo['id']; ?>"> <?php echo $cargo['nome']; ?></option>	
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="col-lg-2">
					<button type="button" class="btn btn-primary btn-sm" id="btn1" onclick="showArea('#area2', this );" > <b>+</b></button>
				</div>
			</div>
			
			
		<div id="area2" style="display: none;">
			<div class="form-group" >
					<label class="col-lg-2 control-label">Setor</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_setor2">
						<option value=""></option>
						<?php foreach ( $setoreS as $setor ) : ?>
							<option value="<?php echo $setor['id']; ?>"> <?php echo $setor['nome']; ?></option>	
						<?php endforeach; ?>
					</select>
				</div>
	
					<label class="col-lg-2 control-label">Cargo</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_cargo2">
						<option value=""></option>
						<?php foreach ( $cargoS as $cargo ) : ?>
							<option value="<?php echo $cargo['id']; ?>"> <?php echo $cargo['nome']; ?></option>	
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="col-lg-2">
					<button type="button" class="btn btn-default btn-sm" id="btn-area2"onclick="showArea('#area3', this);"> <b>+</b></button>
				</div>
			</div>
		</div>
		
		<div id="area3" style="display: none;">
			<div class="form-group" >
					<label class="col-lg-2 control-label">Setor</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_setor3">
						<option value=""></option>
						<?php foreach ( $setoreS as $setor ) : ?>
							<option value="<?php echo $setor['id']; ?>"> <?php echo $setor['nome']; ?></option>	
						<?php endforeach; ?>
					</select>
				</div>
	
					<label class="col-lg-2 control-label">Cargo</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_cargo3">
						<option value=""></option>
						<?php foreach ( $cargoS as $cargo ) : ?>
							<option value="<?php echo $cargo['id']; ?>"> <?php echo $cargo['nome']; ?></option>	
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="col-lg-2">
					<button type="button" class="btn btn-default btn-sm" onclick="showArea('#area3', '#btn-area2');" > <b>-</b></button>
				</div>
			</div>
		</div>
		

			<div class="form-group">
					<label class="col-lg-2 control-label">Nível <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_nivel_interesse">
						<option value=""></option>
						<?php for ($value = 1; $value < count($nivelInteresseS); $value++):?>
							<option value="<?php echo $value; ?>" class="option-selected"><?php echo $nivelInteresseS[$value];?></option>
						<?php endfor; ?>
					</select>
				</div>
				
				<label class="col-lg-2 control-label">Pret. Salarial <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_pretensao_salarial">
						<option value=""></option>
						<?php for ($value = 1; $value < count($salarioS); $value++):?>
							<option value="<?php echo $value; ?>" class="option-selected"><?php echo $salarioS[$value];?></option>
						<?php endfor; ?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
					<label class="col-lg-2 control-label">Região de Interesse <font color="red">*</font></label>
				<div class="col-lg-3">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="candidato_regiao_interesse" value="0" id="regiao_sp" onclick="checkThisBox(this, '#candidato_regiao_sp')" /> São Paulo - SP
							<input type="hidden" name="candidato_regiao_sp" value="0" id="candidato_regiao_sp" />
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="candidato_regiao_interesse" value="0" id="regiao_abc" onclick="checkThisBox(this, '#candidato_regiao_abc')" /> Região ABC - SP
							<input type="hidden" name="candidato_regiao_abc" value="0" id="candidato_regiao_abc" />
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.objetivos -->

<!-- Formação Acadêmica -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-formacao">Formação Acadêmica</a></h4>
	</div>

	<div id="form-formacao" class="panel-collapse collapse">
		<div class="panel-body">
		
		<div class="form-group">
			<label class="col-lg-2 control-label">Nível de Escolaridade <font color="red">*</font></label>
				<div class="col-lg-5">
					<select class="form-control" name="candidato_nivel_escolaridade">
						<option value=""></option>
					<?php for ($value = 1; $value < count($escolaridadeS); $value++):?>
						<option value="<?php echo $value; ?>" class="option-selected"><?php echo $escolaridadeS[$value];?></option>
					<?php endfor; ?>
					</select>
				</div>
			</div>
			
			<input type="hidden" value="0" name="hiddenCursoS" id="hiddenCursoS" />
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			</div>

			<div class="col-md-12 text-center" style="margin-top:15px;">
				<button class="btn btn-primary" id="addButton" value="">Adicionar Curso</button>
			</div>
		</div>
		<!-- /.panel-body -->
		<div class="panel-footer">
			<div class="col-sm-offset-3 col-sm-6 text-center">

			</div>
		</div>
	</div>
</div>
<!-- /.formacao academica -->

<!-- Idiomas -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-idiomas">Idiomas</a></h4>
	</div>
	<div id="form-idiomas" class="panel-collapse collapse">
		<div class="panel-body">
			<div class="table-responsive col-md-8">
			<input type="hidden" value="1" name="hiddenIdiomaS" id="hiddenIdiomaS" />
				<table class="table table-striped" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th class="text-center">Idioma</th>
							<th class="text-center">Leitura</th>
							<th class="text-center">Escrita</th>
							<th class="text-center">Conversação</th>
						</tr>
					</thead>
					<tbody id="tbody-idiomas">
						<tr>
						<td>
						<select class="form-control" name="idioma_nome1" style="color: #fff; background-color: #428bca; border-color: #357ebd;" >
							<?php for ($value = 1; $value < count($listaIdiomaS); $value++) {
								if ($listaIdiomaS[$value] == 'Português') echo "<option value=" . $value . " selected>" . $listaIdiomaS[$value] . "</option>";
							} ?>
						</select>
						</td>
						<td>
							<select class="form-control" name="idioma_nivel_leitura1">
								<option value=""></option>
								<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=" . $value . " class='option-selected'>" . $nivelIdiomaS[$value] . "</option>"; ?>
							</select>
						</td>
						<td>
							<select class="form-control" name="idioma_nivel_escrita1">
								<option value=""></option>
								<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=" . $value . " class='option-selected'>" . $nivelIdiomaS[$value] . "</option>"; ?>
							</select>
						</td>
						<td>
							<select class="form-control" name="idioma_nivel_conversacao1">
								<option value=""></option>
								<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=" . $value . " class='option-selected'>" . $nivelIdiomaS[$value] . "</option>"; ?>
							</select>
						</td>
						<td>
        					<div class="btn btn-primary btn-xs" onclick="addIdiomaS();" style="margin-top:15%;"><i class="fa fa-plus"></i></div>
      					</td>
      					</tr>
					</tbody>
				</table>
				</div>
		</div>
	</div>
</div>
<!-- /.idiomas -->

<!-- Experiência Profissional -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-experiencia">Experiência Profissional</a></h4>
	</div>
	<div id="form-experiencia" class="panel-collapse collapse">
		<div class="panel-body">
		
		<div class="form-group">
					<label class="col-lg-2 control-label">Primeiro emprego? <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" id="primeiro_emprego" name="primeiro_emprego">
						<option value="" id=""></option>
						<option value="2">Não</option>
						<option value="1">Sim</option>
					</select>
				</div>
			</div>
		
			<div id="trabalhou" style="display: none;">
				<input type="hidden" value="0" name="hiddenExperienciaS" id="hiddenExperienciaS" />
				
				<div class="panel-group" id="accordionExp" role="tablist" aria-multiselectable="true">
				</div>

				<div class="col-md-8 text-center" style="margin-top:15px;">
					<button class="btn btn-primary" id="addButtonExp" value="">Adicionar Empresa</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.experiencia profissional -->

<br>
<div id="actions" class="row">
	<div class="col-md-12">
		<button type="submit" class="btn btn-primary" name="validate">Salvar</button>
		<a href="<?php echo BASEURL; ?>" class="btn btn-default">Cancelar</a>
	</div>
</div>
</div>
</form>
</div>
</div>
<script>

function datePicker(local, formato) {
	$(local).datepicker({
    	format: formato,
    	startView: 1,
    	minViewMode: 1,
    	language: "pt-BR"
	});
}


// exp
$(document).ready(function(){
    var counterExp = 1;
    var wrapperExp = $("#accordionExp");

	 $("#addButtonExp").on("click", function(e){ 
    	e.preventDefault();
    	var catgNameExp = prompt("Informe o nome da Empresa");
		if(catgNameExp == ''){
			catgNameExp = 'Empresa #'+counterExp;
		}
		if(catgNameExp != null){
			var ariaExpandedExp = false;
			var expandedClassExp = '';
			var collapsedClassExp = 'collapsed';
			if(counterExp==1){
				  ariaExpandedExp = true;
				  expandedClassExp = 'in';
				  collapsedClassExp = '';
			}
			$(wrapperExp).append(

					'<div class="col-sm-12" id="painel-experiencia" style="margin-bottom: 0;"><div class="panel panel-default" id="panel-exp'+ counterExp +'">' + 
				     '<div class="panel-heading" role="tab" id="headingExp'+ counterExp +'"><h4 class="panel-title">' +
					 '<a class="' + collapsedClassExp + '" id="panel-lebel-exp'+ counterExp +'" role="button" data-toggle="collapse" data-parent="#accordionExp" href="#collapseExp'+ counterExp +'" ' +
					 'aria-expanded="'+ ariaExpandedExp +'" aria-controls="collapse'+ counterExp +'"> '+catgNameExp+' </a><div class="actions_div" style="position: relative; top: -26px;">' +
					 '<a href="#" accesskey="'+ counterExp +'" class="remove_ctg_panel_exp exit-btn pull-right"><span class="fa fa-trash-o"></span></a>' +
					 '<a href="#" accesskey="'+ counterExp +'" class="edit_ctg_label_exp pull-right"><span class="fa fa-pencil-square-o "></span></a>' +
					 '<a href="#" accesskey="'+ counterExp +'" class="pull-right" id="addButtonExp2"></a></div></h4></div>' +
					 '<div id="collapseExp'+ counterExp +'" class="panel-collapse collapse '+expandedClassExp+'"role="tabpanel" aria-labelledby="headingExp'+ counterExp +'">'+
					 '<div class="panel-body"><div id="TextBoxDiv'+ counterExp +'"> ' +
					 
					'<div class="form-group">' +
					'<label class="col-lg-2 control-label">Nome da Empresa <font color="red">*</font></label>' +
					'<div class="col-lg-4">' +
					'<input type="text" class="form-control" id="experiencia_empresa'+ counterExp +'" name="experiencia_empresa'+ counterExp +'" value="' + catgNameExp + '" data-bv-notempty data-bv-notempty-message="O nome da empresa obrigatório e não pode estar vazio"/>' +
					'</div>' +
					'</div>' +
	
					'<div class="form-group">' +
					'<label class="col-lg-2 control-label">Cargo <font color="red">*</font></label>' +
					'<div class="col-lg-4">' +
					'<input type="text" class="form-control" id="experiencia_cargo" name="experiencia_cargo'+ counterExp +'" data-bv-notempty data-bv-notempty-message="Informe o cargo em que atuava nessa empresa"/>' +
					'</div>' +
					'</div>' +

					'<div class="form-group">' +
					'<label class="col-lg-2 control-label">Salário <font color="red">*</font></label>' +
					'<div class="col-lg-2">' +
					'<div class="input-group">' +
					'<span class="input-group-addon">R$</span>' +
					'<input type="text" class="form-control" name="experiencia_salario'+ counterExp +'" maxlength="12" onKeyUp="maskIt(this,event,\'###.###.###,##\',true); return inputNumber(event)" dir="rtl" placeholder="0,00" style="padding-right: 25px;" />' +
					'</div>' +
					'</div>' +
					'</div>' +

					'<div class="form-group">' +
						'<label class="col-lg-2 control-label">Admissão <font color="red">*</font></label>' +
						'<div class="col-lg-2">' +
							'<div class="input-group date">' +
								'<input type="text" class="form-control" name="experiencia_data_admissao'+ counterExp +'" placeholder="Mês/Ano" onkeypress="formatar(\'##/####\', this); return inputNumber(event)" data-bv-notempty data-bv-notempty-message="Informe a data em que iniciou o curso"/>' +
								'<span class="input-group-addon bg-default2"><span class="fa fa-calendar"></span></span>' +
							'</div>' +
						'</div>' +

						'<div class="col-lg-2">' +
							'<div class="checkbox">' +
								'<label>' +
									'<input type="checkbox" name="experiencia_atual' + counterExp + '" value="0" onclick="showArea(\'#desligado'+ counterExp + '\'); checkThisBox(this)" /> <b>Atual</b>' +
								'</label>' +
							'</div>' +
						'</div>' +
					'</DIV>' +

					'<div id="desligado'+ counterExp + '" style="display: true;">' +
						'<div class="form-group">' +
						'<label class="col-lg-2 control-label" >Desligamento </label>' +
							'<div class="col-lg-2">' +
								'<div class="input-group date">' +
									'<input type="text" class="form-control" name="experiencia_data_demissao'+ counterExp +'" placeholder="Mês/Ano" onkeypress="formatar(\'##/####\', this); return inputNumber(event)" />' +
									'<span class="input-group-addon"><span class="fa fa-calendar"></span></span>' +
								'</div>' +
							'</div>' +
						'</div>' +

						'<div class="form-group">' +						
							'<label class="col-lg-2 control-label">Motivo do Desligamento</label>' +
							'<div class="col-lg-6">' +
								'<textarea class="form-control" name="experiencia_motivo_demissao'+ counterExp +'" rows="2" maxlength="150" data-bv-notempty data-bv-notempty-message="Campo objetivo não pode estar vazio"></textarea>' +
							'</div>' +
						'</div>' +
					'</DIV>' +

					'<div class="form-group">' +
					'<label class="col-lg-2 control-label">Principais Atividades <font color="red">*</font></label>' +
					'<div class="col-lg-6">' +
					'<textarea class="form-control" name="experiencia_atividades'+ counterExp +'" rows="2" maxlength="150" data-bv-notempty data-bv-notempty-message="Campo resumo profissional não pode estar vazio"></textarea>' +
					'</div>' +
					'</div></div></div>');

			$('#hiddenExperienciaS').val(counterExp);
			counterExp++;
			
		}

		
     });

	 $(wrapperExp).on("click",".remove_ctg_panel_exp", function(e){ 
		 e.preventDefault(); 
		 var accesskeyExp = $(this).attr('accesskey');
        $('#panel-exp'+accesskeyExp).remove();
        $('#hiddenExperienciaS').val($('#hiddenExperienciaS').val() - 1);
		counterExp--;
		xExp--;
 });
 
 	var y = 1; 

 	$(wrapperExp).on("click","#saveButtonExp", function(e){
		e.preventDefault();
		
		var accesskeyExp = $(this).attr('accesskey');
        $('#collapse'+accesskeyExp).removeClass("in");
        $('#panel-lebel-exp'+accesskeyExp).addClass("collapsed");
				
	});

 	$(wrapperExp).on("click",".edit_ctg_label_exp", function(e){ 
		var panelIdExp = $(this).attr('accesskey');
		var catgNameExp = prompt("Informe o nome da Empresa");
		if(catgNameExp == ''){
			return false;
		}

		if(catgNameExp != null){
			$('#panel-exp'+panelIdExp).find("#panel-lebel-exp"+panelIdExp).html('').html(catgNameExp);
			$('#experiencia_empresa'+panelIdExp).val(catgNameExp);
		}

	});
});



// cursos
$(document).ready(function(){
    var counter = 1;
    var wrapper = $("#accordion");

	 $("#addButton").on("click", function(e){ 
    	e.preventDefault();
    	var catgName = prompt("Informe o nome do curso");
		if(catgName == ''){
			catgName = 'Curso #'+counter;
		}
		if(catgName != null){
			var ariaExpanded = false;
			var expandedClass = '';
			var collapsedClass = 'collapsed';
			if(counter==1){
				  ariaExpanded = true;
				  expandedClass = 'in';
				  collapsedClass = '';
			}
			$(wrapper).append('<div class="col-sm-12" id="painel-cursos" style="margin-bottom: 0;"><div class="panel panel-default" id="panel'+ counter +'">' + 
				     '<div class="panel-heading" role="tab" id="heading'+ counter +'"><h4 class="panel-title">' +
					 '<a class="'+collapsedClass+'" id="panel-lebel'+ counter +'" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ counter +'" ' +
					 'aria-expanded="'+ariaExpanded+'" aria-controls="collapse'+ counter +'"> '+catgName+' </a><div class="actions_div" style="position: relative; top: -26px;">' +
					 '<a href="#" accesskey="'+ counter +'" class="remove_ctg_panel exit-btn pull-right"><span class="fa fa-trash-o"></span></a>' +
					 '<a href="#" accesskey="'+ counter +'" class="edit_ctg_label pull-right"><span class="fa fa-pencil-square-o "></span></a>' +
					 '<a href="#" accesskey="'+ counter +'" class="pull-right" id="addButton2"></a></div></h4></div>' +
					 '<div id="collapse'+ counter +'" class="panel-collapse collapse '+expandedClass+'"role="tabpanel" aria-labelledby="heading'+ counter +'">'+
					 '<div class="panel-body"><div id="TextBoxDiv'+ counter +'"> ' +

					 '<div class="form-group"><label class="col-lg-2 control-label">Nome do Curso <font color="red">*</font></label>' +
					 '<div class="col-lg-4"><input type="text" class="form-control" id="curso_nome'+ counter +'" name="curso_nome'+ counter +'" placeholder="Nome do curso" value="'+catgName+'"/></div></div></div>' + 
					 '<div class="form-group"><label class="col-lg-2 control-label">Tipo de Curso <font color="red">*</font></label>' +
                     '<div class="col-lg-5"><select class="form-control" name="curso_id_tipo'+ counter +'" data-template="select-setor" data-bv-notempty data-bv-notempty-message="É obrigatório informar um tipo de curso">' +
					 '<option value=""></option><?php for ($value = 1; $value < count($tipoCursoS); $value++):?><option value="<?php echo $value; ?>" class="option-selected"><?php echo $tipoCursoS[$value];?></option><?php endfor; ?></select></div></div>' +
					 '<div class="form-group"><label class="col-lg-2 control-label">Instituição <font color="red">*</font></label><div class="col-lg-4">' +
					 '<input type="text" class="form-control" id="curso_instituicao" name="curso_instituicao'+ counter +'" placeholder="Instituição" data-bv-notempty data-bv-notempty-message="Informe a instituição onde cursou"/></div></div>' +
					 '<div class="form-group"><label class="col-lg-2 control-label">Pais <font color="red">*</font></label><div class="col-lg-3">' +
					 '<select class="form-control" name="curso_pais'+ counter +'" data-bv-notempty data-bv-notempty-message="Informe o país onde cursou">' +
					 '<option value=""></option><?php for ($value = 1; $value < count($nacionalidadeS); $value++):if ( $nacionalidadeS[$value] == "Brasil" ) { ?><option value="<?php echo $value; ?>" class="option-selected" selected><?php echo $nacionalidadeS[$value];?></option>' +
					 '<?php } else { ?><option value="<?php echo $value; ?>" class="option-selected"><?php echo $nacionalidadeS[$value];?></option><?php  } endfor; ?></select></div>' +
					 '<label class="col-lg-2 control-label">Estado <font color="red">*</font></label><div class="col-lg-3">' +
					 '<input type="text" class="form-control" id="curso_estado" name="curso_estado'+ counter +'" placeholder="Estado onde cursou" data-bv-notempty data-bv-notempty-message="Informe o estado onde cursou"/></div></div>' +

					 '<div class="form-group"><label class="col-lg-2 control-label">Inicio <font color="red">*</font></label><div class="col-lg-2"><div class="input-group date" ><input type="text" id="curso_data_inicio" class="form-control" name="curso_data_inicio'+ counter +'" placeholder="Mês/Ano" onkeypress="formatar(\'##/####\', this); return inputNumber(event)" data-bv-notempty data-bv-notempty-message="Informe a data em que iniciou o curso"/>' +
					 '<span class="input-group-addon" ><span class="fa fa-calendar" ></span></span></div></div>' +
					 '<label class="col-lg-2 control-label" >Conclusão</label><div class="col-lg-2">' +
					 '<div class="input-group date"><input type="text" class="form-control" name="curso_data_final'+ counter +'" placeholder="Mês/Ano" onkeypress="formatar(\'##/####\', this); return inputNumber(event)" />' +
					 '<span class="input-group-addon" ><span class="fa fa-calendar"></span></span></div></div></div>' +
					 '<div class="form-group"><label class="col-lg-2 control-label">Situação <font color="red">*</font></label><div class="col-lg-4"><div class="radio"><label><input type="radio" name="curso_situacao'+ counter +'" value="1" /> Concluído</label></div>' +
					 '<div class="radio"><label><input type="radio" name="curso_situacao'+ counter +'" value="2" /> Cursando</label></div>' +
					 '<div class="radio"><label><input type="radio" name="curso_situacao'+ counter +'" value="3" /> Interrompido</label></div></div></div>' +

					 '<a class="btn btn-sm btn-primary" accesskey="'+ counter +'" id="saveButton">Salvar</a></div></div></div></div>');

			$('#hiddenCursoS').val(counter);
			counter++;
			
		}

		
     });

	 $(wrapper).on("click",".remove_ctg_panel", function(e){ 
		 e.preventDefault(); 
		 var accesskey = $(this).attr('accesskey');
        $('#panel'+accesskey).remove();
        $('#hiddenCursoS').val($('#hiddenCursoS').val() - 1);
		counter--;
		x--;
 });
 
 	var y = 1; 

 	$(wrapper).on("click","#saveButton", function(e){
		e.preventDefault();
		
		var accesskey = $(this).attr('accesskey');
        $('#collapse'+accesskey).removeClass("in");
        $('#panel-lebel'+accesskey).addClass("collapsed");
				
	});

 	$(wrapper).on("click",".edit_ctg_label", function(e){ 
		var panelId = $(this).attr('accesskey');
		var catgName = prompt("Informe o nome do curso");
		if(catgName == ''){
			return false;
		}

		if(catgName != null){
			$('#panel'+panelId).find("#panel-lebel"+panelId).html('').html(catgName);
			$('#curso_nome'+panelId).val(catgName);
		}
	});
});

var room = 1;
function addIdiomaS() {
    room++;

    $('#hiddenIdiomaS').val(room);

    var objTo = document.getElementById('tbody-idiomas')
    var divtest = document.createElement("tr");
	divtest.setAttribute("class", "removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<td>'+
    	'<select class="form-control" name="idioma_nome'+room+'"style="color: #fff; background-color: #428bca; border-color: #357ebd;">'+
			'<option value=""></option>'+
			'<?php for ($value = 1; $value < count($listaIdiomaS); $value++) echo "<option value=" . $value . ">" . $listaIdiomaS[$value] . "</option>"; ?>'+
    	'</select>'+
    '</td>'+
    '<td>'+
    	'<select class="form-control" name="idioma_nivel_leitura'+room+'">'+
 	   		'<option value=""></option>'+
	    	'<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=" . $value . ">" . $nivelIdiomaS[$value] . "</option>"; ?>'+
	    '</select>'+
    '</td>'+
    '<td>'+
    	'<select class="form-control" name="idioma_nivel_escrita'+room+'">'+
	    	'<option value=""></option>'+
		    '<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=" . $value . ">" . $nivelIdiomaS[$value] . "</option>"; ?>'+
    	'</select>'+
    '</td>'+
    '<td>'+
    	'<select class="form-control" name="idioma_nivel_conversacao'+room+'">'+
	    	'<option value=""></option>'+
	    	'<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=" . $value . ">" . $nivelIdiomaS[$value] . "</option>"; ?>'+
    	'</select>'+
    '</td>'+
    '<td>'+
	'<div class="btn btn-danger btn-xs" type="button"  onclick="removeIdiomaS('+ room +');" style="margin-top:15%;"><i class="fa fa-minus"></i></div>'+
    '</td>'+
    '</tr>';
    
    objTo.appendChild(divtest);
}

function removeIdiomaS(rid) {
	$('.removeclass'+rid).remove();
	var valIdiomaS = $('#hiddenIdiomaS').val();
	$('#hiddenIdiomaS').val(valIdiomaS - 1);
	
}
</script>

<?php } else { ?>

<div class="alert alert-danger" role="alert">
	<p>
		<strong>ERRO:</strong> Não será possível prosseguir com sua solicitação! Entre em contato com o Departamento de Informática.
	</p>
</div>


<?php } ?>		

<?php include(FOOTER_TEMPLATE); ?>