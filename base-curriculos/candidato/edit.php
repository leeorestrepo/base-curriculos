<?php

require_once('functions.php');
require_once('_optionS.php');
include(HEADER_TEMPLATE);

require_once('manterCandidato.php');

@session_start();

if ( !isset ( $_SESSION['empresa'] ) ) {
	
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
	
}

if ( $_SESSION['nivel_acesso'] == 1 ){

	edit( $_SESSION['id'] );

}else if( $_SESSION['nivel_acesso'] == 2 ){
	
	edit( $_GET['id'] );
	
}
	
if( ($_GET['id'] == $_SESSION['id'] or $_SESSION['nivel_acesso'] == 2) == false ) {

	include(NOTFOUND);
	
		exit();
	
}

$logado = $_SESSION["login"];
		
?>

<script>
function toggleBox(div){
	var doc = document.getElementById(div);

	if ( doc.checked ) {
		doc.value = '1';
	} else {
		doc.value = '0';
	}
}
</script>

<style>
	
	.divAddCurso{
		border: 1px solid #ccc; margin:3px; border-bottom:0px;  padding: 5px; text-align: left;
	}
	.aAddCurso{
		float: right; margin:5px;
	}
	
</style>

<div class="container">
<h2>Atualizar Cadastro</h2>
<hr>
<div class="row">
<form id="defaultform" class="form-horizontal" action="edit.php?id=<?php echo $candidato['id']; ?>" method="post">
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
					<input type="text" class="form-control" name="candidato_nome" placeholder="Nome completo" autocomplete="off"  value="<?php echo $candidato['nome']; ?> "/> 
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">CPF <font color="red">*</font></label>
				<div class="col-lg-3">
					<input type="hidden" name="candidato_cpf" value="<?php echo mask( $candidato['cpf'], '###.###.###-##' ); ?>" />
					<input type="text" class="form-control" value="<?php echo mask( $candidato['cpf'], '###.###.###-##' ); ?>" disabled />
				</div>	

					<label class="col-lg-2 control-label">Nascimento <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="text" class="form-control" name="candidato_data_nasc" maxlength="10" placeholder="<?php echo date("d/m/Y"); ?>" onkeypress="formatar('##/##/####', this); return inputNumber(event)" autocomplete="off" style="padding-right:10px;"  value="<?php echo date('d/m/Y',strtotime($candidato['data_nasc'])); ?>" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">Sexo <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_sexo" >
						<option value=""></option>
						<option value='m' <?php if ( strtolower( $candidato['sexo'] ) == 'm' ) echo 'selected' ?> >Masculino</option>
						<option value='f' <?php if ( strtolower( $candidato['sexo'] ) == 'f')  echo 'selected' ?> >Feminino</option>
					</select>
				</div>
				
					<label class="col-lg-2 control-label">Estado Civil <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_estado_civil" >
						<option value=""></option>
						<option value="1" <?php if ($candidato['estado_civil'] == 1) echo 'selected'?> >Solteiro(a)</option>
						<option value="2" <?php if ($candidato['estado_civil'] == 2) echo 'selected'?> >Casado(a)</option>
						<option value="3" <?php if ($candidato['estado_civil'] == 3) echo 'selected'?> >Separado(a)</option>
						<option value="4" <?php if ($candidato['estado_civil'] == 4) echo 'selected'?> >Divorciado(a)</option>
						<option value="5" <?php if ($candidato['estado_civil'] == 5) echo 'selected'?> >Viúvo(a)</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-lg-2 control-label">Possui filho(s)? <font color="red">*</font></label>
				<div class="col-lg-2">
					<select class="form-control" name="candidato_filhos">
						<option value=""></option>
						<option value="0" <?php if ($candidato['filhos'] == 0) echo 'selected'?> >Não</option>
						<option value="1" <?php if ($candidato['filhos'] == 1) echo 'selected'?> >1</option>
						<option value="2" <?php if ($candidato['filhos'] == 2) echo 'selected'?> >2</option>
						<option value="3" <?php if ($candidato['filhos'] == 3) echo 'selected'?> >3</option>
						<option value="4" <?php if ($candidato['filhos'] == 4) echo 'selected'?> >4</option>
						<option value="5" <?php if ($candidato['filhos'] == 5) echo 'selected'?> >5 ou mais</option>
					</select>
				</div>
			
				<label class="col-lg-3 control-label">Nacionalidade <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_nacionalidade">
						<option value=""></option>
						<?php for ($value = 1; $value < count($nacionalidadeS); $value++){
							if ($value == $candidato['cod_nacionalidade']){
								
									echo "<option value='" . $value . "' class='option-selected' selected>" . $nacionalidadeS[$value] . "</option>";
							
								}else{
							
									echo "<option value='" . $value . "' class='option-selected'>" . $nacionalidadeS[$value] . "</option>";
							
								}
						} ?>
					</select>
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
					<input type="text" class="form-control" id="cep" name="candidato_cep" placeholder="00000-000" maxlength="9" onkeypress="formatar('#####-###', this); return inputNumber(event)" onblur="getEndereco(this.id);" autocomplete="off" value="<?php echo mask( $candidato['cep'], '#####-###' );?>" />
				</div>
					<span class="col-lg-2 control-label"><a href="http://www.buscacep.correios.com.br/" target="_blank">
    				  Esqueci meu CEP
    				</a></span>
			</div>
			
			<div class="form-group">
					<label class="col-lg-1 control-label">Endereço<font color="red">*</font></label>
				<div class="col-lg-6">
					<input type="text" class="form-control" id="endereco" name="candidato_endereco" placeholder="Endereço" value="<?php echo $candidato['endereco']; ?>" />
				</div>
			</div>
			<div class="form-group">
					<label class="col-lg-1 control-label">Núm. <font color="red">*</font></label>
				<div class="col-lg-2">
					<input type="text" class="form-control" id="endereco_numero" name="candidato_endereco_numero" placeholder="Número" onkeypress="return inputNumber(event)"  value="<?php echo $candidato['endereco_numero']; ?>" />
				</div>
					<label class="col-lg-2 control-label">Complemento</label>
				<div class="col-lg-2">
					<input type="text" class="form-control" id="complemento" name="candidato_endereco_complemento" placeholder="Complemento"  value="<?php if(!empty($candidato['endereco_complemento'])) echo $candidato['endereco_complemento']; ?>" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-1 control-label" style="padding-left: 0px;">Bairro <font color="red" >*</font></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" id="bairro" name="candidato_bairro" value="<?php echo $candidato['bairro']; ?>" />
				</div>

					<label class="col-lg-1 control-label" style="padding-left: 0px;">Cidade <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" id="cidade" name="candidato_cidade">
						<option value=""></option>
						<?php for ($value = 1; $value < count($cidadeS); $value++){
							if ($value == $candidato['cod_cidade']){
								 echo "<option value='" . $value . "' class='option-selected' selected>" . $cidadeS[$value] . "</option>";
							} else {
								 echo "<option value='" . $value . "' class='option-selected'>" . $cidadeS[$value] . "</option>";
							}
						} ?>
					</select>					
				</div>
				
				
					<label class="col-lg-1 control-label" style="padding-left: 0px;">UF <font color="red">*</font></label>
				<div class="col-lg-2">
					<select class="form-control" id="estado" name="candidato_estado">
						<option value=""></option>
						<?php for ($value = 1; $value < count($ufEstadoS); $value++){
							if ( $value == $candidato['cod_estado']){
								 echo "<option value='" . $value . "' class='option-selected' selected>" . $ufEstadoS[$value] . "</option>";
							}else{
								 echo "<option value='" . $value . "' class='option-selected'>" . $ufEstadoS[$value] . "</option>";
							 }
						} ?>
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
					<input type="text" class="form-control" name="candidato_email" placeholder="E-mail" value="<?php echo $candidato['email']; ?>" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">Celular <font color="red">*</font></label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="candidato_celular" maxlength="13" placeholder="00 00000-0000" onkeypress="formatar('## #####-####', this); return inputNumber(event)" autocomplete="off" value="<?php echo mask($candidato['celular'], '## #####-####'); ?>" />
				</div>

					<label class="col-lg-2 control-label" style="padding-left: 0px;">Residencial</label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="candidato_tel_residencial" maxlength="13" name="candidato_celular" maxlength="13" placeholder="00 0000-0000" onkeypress="formatar('## ####-####', this); return inputNumber(event)" autocomplete="off" value="<?php if(!empty($candidato['tel_residencial'])) echo mask($candidato['tel_residencial'], '## #####-####'); ?>" />
				</div>
			</div>

			<div class="form-group">
					<label class="col-lg-2 control-label">Preferência <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_preferencia_contato">
						<option value=""></option>
						<option value="0" <?php if ($candidato['cod_preferencia_contato'] == 0) echo 'selected'?> >Não</option>
						<option value="1" <?php if ($candidato['cod_preferencia_contato'] == 1) echo 'selected'?> >E-mail</option>
						<option value="2" <?php if ($candidato['cod_preferencia_contato'] == 2) echo 'selected'?> >Celular</option>
						<option value="3" <?php if ($candidato['cod_preferencia_contato'] == 3) echo 'selected'?> >Tel. Residencial</option>
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
						<input name="candidato_linkedin" class="form-control" type="text" placeholder="linkedin.com/in/" value="<?php if ( !empty( $candidato['linkedin'] ) ) echo $candidato['linkedin']?>" >
					</div>
				</div>
			</div>

			<div class="form-group">
						<label class="col-lg-2 control-label">Facebook</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-primary2"><span class="fa fa-facebook"></span></span>
						<input name="candidato_facebook" class="form-control" id="searchfacebook" type="text" placeholder="facebook.com/" value="<?php if ( !empty( $candidato['facebook'] ) ) echo $candidato['facebook']?>" >
					</div>
				</div>
			</div>
			
			<div class="form-group">
						<label class="col-lg-2 control-label">Twitter</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-info2"><span class="fa fa-twitter"></span></span>
						<input name="candidato_twitter" class="form-control" type="text" placeholder="twitter.com/" value="<?php if ( !empty( $candidato['twitter'] ) ) echo $candidato['twitter'] ?>" >
					</div>
				</div>
			</div>
			<div class="form-group">
						<label class="col-lg-2 control-label">Blog</label>
				<div class="col-lg-4">
					<div class="input-group date">
						<span class="input-group-addon bg-danger2"><span class="fa fa-rss"></span></span>
						<input name="candidato_blog" class="form-control" type="text" placeholder="Informe o endereço de seu site"  value="<?php if ( !empty( $candidato['blog'] ) ) echo $candidato['blog']?>" >
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
				
					<select class="form-control" id="deficiente" name="candidato_deficiente" onchange="verEscoderDeficiencia(this)">
					
						<option value="" id=""></option>
						<option value="0" id="def_no" <?php if ( $candidato['deficiente'] == 0 ) echo 'selected'?> >Não</option>
						<option value="1" id="def_yes" <?php if ( $candidato['deficiente'] == 1 ) echo 'selected'?> >Sim</option>
						
					</select>
					
				</div>
				
			</div>

				<div id="deficiencia" style="display: <?php if ( $candidato['deficiente'] == 1 ) echo "bock"; else echo "none"; ?>" >
					
					<div class="form-group">
                        
                        <label class="col-lg-4 control-label">A que tipo(s) se enquadra: <font color="red">*</font></label>
                        
                        <div class="col-lg-5">
                        
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="<?php echo $candidato['deficiencia_auditiva']; ?>" id="auditiva" onclick="checkThisBox(this, '#deficiencia_auditiva');" <?php if ( $candidato['deficiencia_auditiva'] == 1 ) echo "checked" ?> /> Auditiva 
                                    <input type="hidden" name="deficiencia_auditiva" id="deficiencia_auditiva" value="<?php echo $candidato['deficiencia_auditiva']; ?>"/>
                                </label>
                            </div>
                            
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="<?php echo $candidato['deficiencia_fala']; ?>" id="fala" onclick="checkThisBox(this, '#deficiencia_fala')" <?php if ( $candidato['deficiencia_fala'] == 1 ) echo "checked" ?> /> Fala
                                    <input type="hidden" name="deficiencia_fala" id="deficiencia_fala" value="<?php echo $candidato['deficiencia_fala']; ?>" />
                                </label>
                            </div>
                            
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="<?php echo $candidato['deficiencia_fisica']; ?>" id="fisica" onclick="checkThisBox(this, '#deficiencia_fisica')" <?php if ( $candidato['deficiencia_fisica'] == 1 ) echo "checked" ?> /> Fisica
                                    <input type="hidden" name="deficiencia_fisica" id="deficiencia_fisica" value="<?php echo $candidato['deficiencia_fisica']; ?>" />
                                </label>
                            </div>
                            
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="<?php echo $candidato['deficiencia_mental']; ?>" id="mental" onclick="checkThisBox(this, '#deficiencia_mental')" <?php if ( $candidato['deficiencia_mental'] == 1 ) echo "checked" ?> /> Intelectual/Mental
                                    <input type="hidden" name="deficiencia_mental" id="deficiencia_mental" value="<?php echo $candidato['deficiencia_mental']; ?>" />
                                </label>
                            </div>
                            
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="deficiencia" value="<?php echo $candidato['deficiencia_visual']; ?>" id="visual" onclick="checkThisBox(this, '#deficiencia_visual')"  <?php if ( $candidato['deficiencia_visual'] == 1 ) echo "checked" ?> /> Visual
                                    <input type="hidden" name="deficiencia_visual" id="deficiencia_visual" value="<?php echo $candidato['deficiencia_visual']; ?>" /> 
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
                            <textarea class="form-control" name="candidato_objetivo" maxlength="250" style="height: 100px;"><?php echo $candidato['objetivo']; ?></textarea>
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
						<?php foreach ( $setoreS as $setor ) : 
							if ($candidato['id_setor1'] == $setor['id']) echo "<option value='" . $setor['id'] . "' class='option-selected' selected>" . $setor['nome'] . "</option>";
							else echo "<option value='" . $setor['id'] . "' class='option-selected'>" . $setor['nome'] . "</option>";	
						endforeach; ?>
					</select>
				</div>

					<label class="col-lg-2 control-label">Cargo <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_cargo1">
						<option value=""></option>
						<?php foreach ( $cargoS as $cargo ) : 
						if ($candidato['id_cargo1'] == $cargo['id']) echo "<option value='" . $cargo['id'] . "' class='option-selected' selected>" . $cargo['nome'] . "</option>";
							else echo "<option value='" . $cargo['id'] . "' class='option-selected'>" . $cargo['nome'] . "</option>";	
						endforeach; ?>
					</select>
				</div>			
				
				<div class="col-lg-2">
					<button type="button" class="btn btn-default btn-sm" id="btn1" onclick="showArea('#area2', this );" > <b>+</b></button>
				</div>
			</div>
			
			
		<div id="area2" style="display: <?php if ( $candidato['id_setor2'] != null ) echo "true";
													else echo "none"; ?>">
			<div class="form-group" >
					<label class="col-lg-2 control-label">Setor</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_setor2">
						<option value=""></option>
						<?php foreach ( $setoreS as $setor ) : 
							if ($candidato['id_setor2'] == $setor['id']) echo "<option value='" . $setor['id'] . "' class='option-selected' selected>" . $setor['nome'] . "</option>";
							else echo "<option value='" . $setor['id'] . "' class='option-selected'>" . $setor['nome'] . "</option>";	
						endforeach; ?>
					</select>
				</div>
	
					<label class="col-lg-2 control-label">Cargo</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_cargo2">
						<option value=""></option>
						<?php foreach ( $cargoS as $cargo ) : 
						if ( $candidato['id_cargo2'] == $cargo['id']) echo "<option value='" . $cargo['id'] . "' class='option-selected' selected>" . $cargo['nome'] . "</option>";
							else echo "<option value='" . $cargo['id'] . "' class='option-selected'>" . $cargo['nome'] . "</option>";	
						endforeach; ?>
					</select>
				</div>
				
				<div class="col-lg-2">
					<button type="button" class="btn btn-default btn-sm" id="btn-area2"onclick="showArea('#area3', this);"> <b>+</b></button>
				</div>
			</div>
		</div>
		
		<div id="area3" style="display: <?php if ( $candidato['id_setor3'] != null ) echo "true";
													else echo "none"; ?>">
			<div class="form-group" >
					<label class="col-lg-2 control-label">Setor</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_setor3">
						<option value=""></option>
						<?php foreach ( $setoreS as $setor ) : 
							if ($candidato['id_setor3'] == $setor['id']) echo "<option value='" . $setor['id'] . "' class='option-selected' selected>" . $setor['nome'] . "</option>";
							else echo "<option value='" . $setor['id'] . "' class='option-selected'>" . $setor['nome'] . "</option>";	
						endforeach; ?>
					</select>
				</div>
	
					<label class="col-lg-2 control-label">Cargo</label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_cargo3">
						<option value=""></option>
						<?php foreach ( $cargoS as $cargo ) : 
						if ( $candidato['id_cargo3'] == $cargo['id']) echo "<option value='" . $cargo['id'] . "' class='option-selected' selected>" . $cargo['nome'] . "</option>";
							else echo "<option value='" . $cargo['id'] . "' class='option-selected'>" . $cargo['nome'] . "</option>";	
						endforeach; ?>
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
						
						<?php for ($value = 1; $value < count($nivelInteresseS); $value++){ ?>
						
							<?php if( trim($value."") == trim($candidato['nivel_interesse']."") ){ ?>
							
								<option value="<?php echo $value;?>" selected> 
								
									<?php echo $nivelInteresseS[$value]; ?>
								
								</option>
								
							<?php }else{ ?>
								
								<option value="<?php echo $value; ?>"> 
							
									<?php echo $nivelInteresseS[$value]; ?>
								
								</option>
							
						<?php  } 
						
						}
						
						?>
					</select>
				</div>
				
				<label class="col-lg-2 control-label">Pret. Salarial <font color="red">*</font></label>
				<div class="col-lg-3">
					<select class="form-control" name="candidato_pretensao_salarial">
						<option value=""></option>
						<?php 
						
							for ($value = 1; $value < count($salarioS); $value++){
								
								if ( $value == $candidato['cod_pretensao_salarial'] ){
	
									 echo "<option value='" . $value . "' selected>" . $salarioS[$value] . "</option>";
									 
								} else {
	
									echo "<option value='" . $value . "'>" . $salarioS[$value] . "</option>";
									
								}
								
							} 
							
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
					<label class="col-lg-2 control-label">Região de Interesse <font color="red">*</font></label>
				<div class="col-lg-3">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="candidato_regiao_interesse" value="<?php echo $candidato['regiao_sp']; ?>" id="regiao_sp" onclick="checkThisBox(this, '#candidato_regiao_sp')" <?php if ( $candidato['regiao_sp'] == 1 ) echo "checked" ?> /> São Paulo - SP
							<input type="hidden" name="candidato_regiao_sp" value="0" id="candidato_regiao_sp" />
						</label> 
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="candidato_regiao_interesse" value="<?php echo $candidato['regiao_abc']; ?>" id="regiao_abc" onclick="checkThisBox(this, '#candidato_regiao_abc')" <?php if ( $candidato['regiao_abc'] == 1 ) echo "checked" ?> /> Região ABC - SP
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
					
					<?php for ($value = 1; $value < count($escolaridadeS); $value++){
						
							if ($value == $candidato['cod_nivel_escolaridade']){

 								echo "<option value='" . $value . "' selected>" . $escolaridadeS[$value] . "</option>";
 						
							}else{

								echo "<option value='" . $value . "'>" . $escolaridadeS[$value] . "</option>";
							
							} 
							
						}
					?>
					
					</select>
					
				</div>
				
			</div>
			
			<div class="form-group">
		
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			
				<div class="col-md-12 text-center" style="margin-top:15px;">
				
    				<div class="form-group">
					
						<label class="col-lg-2 control-label">Nome do Curso <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							 <input class="form-control" type="text" id="curso_nome" placeholder="Nome do curso" value="">
							 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">Tipo de Curso <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							<select class="form-control" id="curso_cod_tipo" >
							
								<option value="">Selecione uma opção!</option>
								
								<?php for ( $value = 1; $value < count($tipoCursoS); $value++ ){ ?>
								
										<option value="<?php echo $value; ?>" class="option-selected">
											
											<?php echo $tipoCursoS[$value];?>
											
										</option>
								
								<?php } ?>
								
							</select>
							 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">Instituição <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							<input class="form-control" type="text" id="curso_instituicao"  placeholder="Instituição"/>
							 
						</div>
					
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">País <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							<select class="form-control" id="curso_pais" >
					
								<option value="">Selecione uma opção!</option>
							
								<?php for ($value = 1; $value < count($nacionalidadeS); $value++){ 
									
									if ( $nacionalidadeS[$value] == "Brasil" ) {

										?>
											<option value="<?php echo $value; ?>" selected><?php echo $nacionalidadeS[$value];?></option>
										<?php 
										
									}else{

										?>
											<option value="<?php echo $value; ?>"><?php echo $nacionalidadeS[$value];?></option>
										<?php	
											
									}
									
								} ?>
								
							</select>
							 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">Estado <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							<input class="form-control" type="text" id="curso_estado" placeholder="Estado onde cursou">
							 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">Inicio <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							<input class="form-control" type="text" id="curso_data_inicio" placeholder="Mês/Ano" onkeypress="formatar('##/####', this); return inputNumber(event)"/>
							 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">Conclusão <font color="red">*</font></label>
						
						<div class="col-lg-5" style="text-align: left;">
						
							<input class="form-control" type="text" id="curso_data_final" placeholder="Mês/Ano" onkeypress="formatar('##/####', this); return inputNumber(event)"/>
							 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-lg-2 control-label">Situação <font color="red">*</font></label>
						
						<div style="float: left; position: relative; width: 250px; text-align: left; margin-left: 18px;">
						
							<input type="radio" name="curso_situacao" value="1" checked="checked"> Concluído <br>
							<input type="radio" name="curso_situacao" value="2"> Cursando <br>
							<input type="radio" name="curso_situacao" value="3"> Interrompido <br>
						
						</div>
						
					</div>
						
					<div class="form-group">
					
						<a onclick="addCurso()" style="cursor: pointer;">ADICIONAR CURSO</a>
						
 					</div>
					
					<div id="divCursoS">
					
						<?php 
						
							$cursoS = findCursoS( $candidato["id"] );
							
							if( $cursoS != null && count( $cursoS ) > 0 ){
						
								foreach ( $cursoS as $curso ){	
		
									$mesAnoInicio = dateFormatToMesAno( $curso["data_inicio"] );
									$mesAnoFinal = dateFormatToMesAno( $curso["data_final"] );
														
								?>  
								
								<div class="divAddCurso">
								
									<input type="hidden" name="curso_nome[]" value="<?php echo $curso["nome"] ?>" />
									<input type="hidden" name="curso_instituicao[]" value="<?php echo $curso["instituicao"] ?>" />
									<input type="hidden" name="curso_cod_tipo[]" value="<?php echo $curso["cod_tipo"] ?>" />
									<input type="hidden" name="curso_pais[]" value="<?php echo $curso["pais"] ?>" />
									<input type="hidden" name="curso_estado[]" value="<?php echo $curso["estado"] ?>" />
									<input type="hidden" name="curso_data_inicio[]" value="<?php echo $mesAnoInicio ?>" />
									<input type="hidden" name="curso_data_final[]" value="<?php echo $mesAnoFinal ?>" />
									<input type="hidden" name="curso_situacao[]" value="<?php echo $curso["situacao"] ?>" />
									
									<?php 
										
										echo "Curso: " . $curso["nome"] . ". " . 
											 "Instituição: " . $curso["instituicao"] . ". " .
											 "Tipo de Curso: " . $tipoCursoS[ $curso["cod_tipo"] ] . ". " . 
											 "Local: " . $nacionalidadeS[ "'"+$curso["pais"]+"'" ] . "/ " . $curso["estado"] .  ". " .
											 "De: " . $mesAnoInicio . ", " .
											 "Até: " . $mesAnoFinal . ". " .
											 "Situação: " . getStrCursoSituacao( $curso["situacao"] ) . ".";
									?>
									
									 <a onclick="removeParentDiv(this)" class="aAddCurso"> Excluir </a>
									
								</div>
								
							<?php }

							}
							
							?>					
		
					</div>
				
				</div>
				
			</div>
			
		</div>
			
		</div>
		
		<div class="panel-footer">
		
			<div class="col-sm-offset-3 col-sm-6 text-center">

			</div>
			
		</div>
		
	</div>
	
</div>

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
						<script>
							var room = 1;
						</script>
						<?php 
						
							$idiomaS = findTableS('idioma', $candidato["id"], 'id_candidato');
							
							$idiomaS = count($idiomaS) > 0 ? $idiomaS : findTableS('idioma', 1, 'id_candidato');
							
							$room = 1;
							foreach ($idiomaS as $idioma){
								
							?>
						
						<tr <?php if ($room > 1) echo "class='removeclass".$room."'"; ?>>
						<td>
						<select class="form-control" name="idioma_nome[]" style="color: #fff; background-color: #428bca; border-color: #357ebd;">
							<option value=""></option>
							<?php for ($value = 1; $value < count($listaIdiomaS); $value++){ ?>
								<option value="<?php echo $value; ?>" class='option-selected' <?php echo $idioma['cod_idioma'] == $value ? 'selected' : ''; ?>><?php echo $listaIdiomaS[$value]; ?></option>
							<?php } ?> 
						</select>
						</td>
						<td>
							<select class="form-control" name="idioma_nivel_leitura[]">
								<option value=""></option>
								<?php for ($value = 1; $value < count($nivelIdiomaS); $value++){ ?>
									<option value="<?php echo $value; ?>" class='option-selected' <?php echo $idioma['nivel_leitura'] == $value ? 'selected' : ''; ?>><?php echo $nivelIdiomaS[$value]; ?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<select class="form-control" name="idioma_nivel_escrita[]">
								<option value=""></option>
								<?php for ($value = 1; $value < count($nivelIdiomaS); $value++){ ?>
									<option value="<?php echo $value; ?>" class='option-selected' <?php echo $idioma['nivel_escrita'] == $value ? 'selected' : ''; ?>><?php echo $nivelIdiomaS[$value]; ?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<select class="form-control" name="idioma_nivel_conversacao[]">
								<option value=""></option>
								<?php for ($value = 1; $value < count($nivelIdiomaS); $value++){ ?>
									<option value="<?php echo $value; ?>" class='option-selected' <?php echo $idioma['nivel_conversacao'] == $value ? 'selected' : ''; ?>><?php echo $nivelIdiomaS[$value]; ?></option>
								<?php } ?>
							</select>
						</td>
						
      					<?php if ($room == 1) {?>
						<td>
        					<div class="btn btn-primary btn-xs" onclick="addIdiomaS();" style="margin-top:15%;"><i class="fa fa-plus"></i></div>
      					</td>
      					<?php } else { ?>
      					<td>
        					<div class="btn btn-danger btn-xs" type="button"  onclick="removeIdiomaS('<?php echo $room; ?>');" style="margin-top:15%;"><i class="fa fa-minus"></i></div>
      					</td>
      					<?php } ?>
      					</tr>
					<?php $room++;
							}
						echo "<script>room++;</script>";
						
						?>
					</tbody>
				</table>
				</div>
		</div>
	</div>
</div>
<!-- /.idiomas -->

<br>
<div id="actions" class="row">
	<div class="col-md-12">
		<button type="submit" class="btn btn-primary" name="validate">Salvar</button>
		<button type="button" class="btn btn-default" onclick="history.back();">Cancelar</a>
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
					'<span class="input-group-addon bg-default2" style="cursor:pointer;" onclick="datePicker(this, \'mm/yyyy\');"><span class="fa fa-calendar"></span></span>' +
					'</div>' +
					'</div>' +

					'<label class="col-lg-2 control-label" >Desligamento </label>' +
					'<div class="col-lg-2">' +
					'<div class="input-group date">' +
					'<input type="text" class="form-control" name="experiencia_data_demissao'+ counterExp +'" placeholder="Mês/Ano" onkeypress="formatar(\'##/####\', this); return inputNumber(event)" />' +
					'<span class="input-group-addon bg-default2" style="cursor:pointer;" onclick="datePicker(this, \'mm/yyyy\');"><span class="fa fa-calendar"></span></span>' +
					'</div>' +
					'</div>' +
					'</div>' +

					'<div class="form-group">' +
					'<label class="col-lg-2 control-label">Motivo do Desligamento</label>' +
					'<div class="col-lg-6">' +
					'<textarea class="form-control" name="experiencia_motivo_demissao'+ counterExp +'" rows="2" maxlength="150" data-bv-notempty data-bv-notempty-message="Campo objetivo não pode estar vazio"></textarea>' +
					'</div>' +
					'</div>' +

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

function addIdiomaS() {
    room++;

    $('#hiddenIdiomaS').val(room);

    var objTo = document.getElementById('tbody-idiomas')
    var divtest = document.createElement("tr");
	divtest.setAttribute("class", "removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<td>'+
    	'<select class="form-control" name="idioma_nome[]"style="color: #fff; background-color: #428bca; border-color: #357ebd;">'+
			'<option value=""></option>'+
			'<?php 
				for ($value = 1; $value < count($listaIdiomaS); $value++){
					echo "<option value=\"" . $value . "\">" . $listaIdiomaS[$value] . "</option>"; 
				}
			?>'+
    	'</select>'+
    '</td>'+
    '<td>'+
    	'<select class="form-control" name="idioma_nivel_leitura[]">'+
 	   		'<option value=""></option>'+
	    	'<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=\"" . $value . "\">" . $nivelIdiomaS[$value] . "</option>"; ?>'+
	    '</select>'+
    '</td>'+
    '<td>'+
    	'<select class="form-control" name="idioma_nivel_escrita[]">'+
	    	'<option value=""></option>'+
		    '<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=\"" . $value . "\">" . $nivelIdiomaS[$value] . "</option>"; ?>'+
    	'</select>'+
    '</td>'+
    '<td>'+
    	'<select class="form-control" name="idioma_nivel_conversacao[]">'+
	    	'<option value=""></option>'+
	    	'<?php for ($value = 1; $value < count($nivelIdiomaS); $value++) echo "<option value=\"" . $value . "\">" . $nivelIdiomaS[$value] . "</option>"; ?>'+
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

function verEscoderDeficiencia( _this ){
	if( $( _this ).val() == '' ){
		alert('Por favor selecione se possui ou não uma deficiencia!');
	}else if( $( _this ).val() == '1' ){
		displayOn( 'deficiencia' );
	}else{
		displayOff( 'deficiencia' );
	}
}

function addCurso(){

	if( min('curso_nome', 3) == false ){ alert('Por favor informe o campo Nome'); evidenciar('#curso_nome'); return; } 
	if( min('curso_instituicao', 3) == false ){ alert('Por favor informe o campo Instituição'); evidenciar('#curso_instituicao'); return; } 
	if( min('curso_cod_tipo', 1) == false ){ alert('Por favor informe o campo Tipo'); evidenciar('#curso_cod_tipo'); return; } 
	if( min('curso_estado', 1) == false ){ alert('Por favor informe o campo Estado'); evidenciar('#curso_estado'); return; } 
	if( min('curso_pais', 1) == false ){ alert('Por favor informe o campo pais'); evidenciar('#curso_pais'); return; } 
	if( min('curso_data_inicio', 3) == false ){ alert('Por favor informe o campo Data de Inicio'); evidenciar('#curso_data_inicio'); return; } 
	if( min('curso_data_final', 3) == false ){ alert('Por favor informe o campo Data Final'); evidenciar('#curso_data_final'); return; } 
	
	var curso_nome = $('#curso_nome').val();
	var curso_instituicao = $('#curso_instituicao').val();
	var curso_cod_tipo = $('#curso_cod_tipo').val();
	var curso_pais = $('#curso_pais').val();
	var curso_estado = $('#curso_estado').val();
	var curso_data_inicio = $('#curso_data_inicio').val();
	var curso_data_final = $('#curso_data_final').val();
	var curso_situacao = $('input[name=curso_situacao]:checked').val();
	var strSituacao = "Concluído";
	if( curso_situacao == "2" ) strSituacao = "Cursando";
	if( curso_situacao == "3" ) strSituacao = "Interrompido";

	var strTipo = $( "#curso_cod_tipo option:selected" ).text();
	var strPais = $( "#curso_pais option:selected" ).text();
	
	var builCursoS = 
		"<div class=\"divAddCurso\">" +
		
			"<input type=\"hidden\" name=\"curso_nome[]\" value=\""+curso_nome+"\"/>" +  
			"<input type=\"hidden\" name=\"curso_instituicao[]\" value=\""+curso_instituicao+"\"/>" +  
			"<input type=\"hidden\" name=\"curso_cod_tipo[]\" value=\""+curso_cod_tipo+"\"/>" + 
			"<input type=\"hidden\" name=\"curso_pais[]\" value=\""+curso_pais+"\"/>" + 
			"<input type=\"hidden\" name=\"curso_estado[]\" value=\""+curso_estado+"\"/>" +
			"<input type=\"hidden\" name=\"curso_data_inicio[]\" value=\""+curso_data_inicio+"\"/>" + 
			"<input type=\"hidden\" name=\"curso_data_final[]\" value=\""+curso_data_final+"\"/> " + 
			"<input type=\"hidden\" name=\"curso_situacao[]\" value=\""+curso_situacao+"\"/> " + 

			"Curso: " + curso_nome + ". Instituição: " + curso_instituicao + ". Tipo de Curso: " + strTipo + ". " + 
			"Local: " + strPais + "/" + curso_estado + ". De: " + curso_data_inicio + " Até: " + 
			curso_data_final + ". Situação: " + strSituacao + " " + 

			"<a onclick=\"removeParentDiv( this )\" class=\"aAddCurso\">Excluir</a>";
			
		"</div>";
	
	$("#divCursoS").html( $("#divCursoS").html() + builCursoS ); 
	
}

</script>

<?php include(FOOTER_TEMPLATE); ?>