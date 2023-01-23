<?php
	require_once('functions.php');
	require_once('_optionS.php');
		
	include(HEADER_TEMPLATE);
	
	@session_start();
	
	$db = open_database();

	if( !isset ($_SESSION['empresa']) == true or $_SESSION['nivel_acesso'] == 1 ) {
		
		if (!isset($_SESSION['empresa'])) {
			
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
		
		include ( NOTFOUND );
		
	} else if ($_SESSION['nivel_acesso'] == 2)	{
	
		$orderby = "c.id";
		
		// GUARDA AS INFORMAÇÕES DOS FILTROS
		
		$busca_palavra_chave = atribuiPOST( "palavra-chave", true );
		
		$busca_sexo = atribuiPOST( "sexo", true );
		$busca_filhos = atribuiPOST( "filhos", true );
		$busca_nacionalidade = atribuiPOST( "nacionalidade", true );
		$busca_nivel_escolaridade = atribuiPOST( "nivel_escolaridade", true );
		$busca_candidato_nome = atribuiPOST("candidato_nome", true);
		$busca_candidato_cpf = atribuiPOST("candidato_cpf", true);
		
		$busca_regiao_sp = atribuiPOST( "regiao_sp", true );
		$busca_regiao_abc = atribuiPOST( "regiao_abc", true );
				
		$busca_deficiente = atribuiPOST( "deficiente", true );
		$busca_deficiencia_auditiva = atribuiPOST( "deficiencia_auditiva", true );
		$busca_deficiencia_fala = atribuiPOST( "deficiencia_fala", true );
		$busca_deficiencia_fisica = atribuiPOST( "deficiencia_fisica", true );
		$busca_deficiencia_visual = atribuiPOST( "deficiencia_visual", true );
		$busca_deficiencia_mental = atribuiPOST( "deficiencia_mental", true );
		
		$busca_bairro = atribuiPOST( "bairro", true );
		$busca_cidade = atribuiPOST( "cidade", true );
		$busca_ufEstado= atribuiPOST( "ufEstado", true );
		
		$busca_setor = atribuiPOST( "setor", true );
		$busca_cargo = atribuiPOST( "cargo", true );
		$busca_nivel_interesse = atribuiPOST( "nivel_interesse", true );
		
		$busca_status_avaliacao = atribuiPOST( "status_avaliacao", true );
	
	// Após a verificações, começos com o conteúdo:
	$logado = $_SESSION["login"];

	$selectCandidatoS = "SELECT c.id, c.nome, c.cpf, c.sexo, c.filhos, c.email, c.celular, c.tel_residencial, c.facebook, c.twitter, c.linkedin,
							c.deficiente, c.deficiencia_fala, c.deficiencia_auditiva, c.deficiencia_fisica, c.deficiencia_mental, c.deficiencia_visual,
							c.observacoes_rh, c.avaliacao_rh, c.status_avaliacao, c.data_avaliacao, c.usuario_avaliou
							FROM candidato c
							LEFT JOIN experiencia e ON e.id_candidato = c.id
							LEFT JOIN curso cu ON cu.id_candidato = c.id
							WHERE c.nivel_acesso = 1";
	
	if ( @$_GET ['go'] == 'buscar' ) {
		
		if (!empty ( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
		}
		
		if ( !empty( $busca_candidato_nome ) ) $selectCandidatoS .= " AND c.nome = '$busca_candidato_nome'";
		
		if ( !empty( $busca_candidato_cpf ) ) $selectCandidatoS .= " AND c.cpf = '$busca_candidato_cpf'";
		
		if ( !empty( $busca_sexo ) ) $selectCandidatoS .= " AND c.sexo = '$busca_sexo'";
		
		if ( !empty( $busca_filhos) || $busca_filhos == "0" ) $selectCandidatoS .= " AND c.filhos = $busca_filhos";
		
		if ( $busca_regiao_sp == 1 ) $selectCandidatoS .= " AND c.regiao_sp = b'$busca_regiao_sp'";
		
		if ( $busca_regiao_abc == 1 ) $selectCandidatoS .= " AND c.regiao_abc= b'$busca_regiao_abc'";
		
		
		# if ( !empty( $busca_nacionalidade) ) $selectCandidatoS .= " AND c.cod_nacionalidade = $busca_nacionalidade";
		
		if ( !empty( $busca_nivel_escolaridade) ) $selectCandidatoS .= " AND c.cod_nivel_escolaridade = $busca_nivel_escolaridade";
		
		if ( !empty( $busca_deficiente ) && $busca_deficiente == "0" ) $selectCandidatoS .= " AND c.deficiente = b'$busca_deficiente'";
		
		if ( $busca_deficiente == 1 ) {
			
			if ( $busca_deficiencia_auditiva == 1) $selectCandidatoS .= " AND c.deficiencia_auditiva = b'$busca_deficiencia_auditiva'";
		
			if ( $busca_deficiencia_fala == 1 ) $selectCandidatoS .= " AND c.deficiencia_fala= b'$busca_deficiencia_fala'";
		
			if ( $busca_deficiencia_fisica == 1 ) $selectCandidatoS .= " AND c.deficiencia_fisica = b'$busca_deficiencia_fisica'";
		
			if ( $busca_deficiencia_visual == 1 ) $selectCandidatoS .= " AND c.deficiencia_visual = b'$busca_deficiencia_visual'";
		
			if ( $busca_deficiencia_mental == 1 ) $selectCandidatoS .= " AND c.deficiencia_mental = b'$busca_deficiencia_mental'";
		
		}
		
		if ( !empty( $busca_bairro) ) $selectCandidatoS .= " AND c.bairro LIKE '%$busca_bairro%'";

		if ( !empty( $busca_cidade) ) $selectCandidatoS .= " AND c.cod_cidade= $busca_cidade";

		if ( !empty( $busca_ufEstado ) ) $selectCandidatoS .= " AND c.cod_estado= $busca_ufEstado";
	
		if ( !empty( $busca_setor ) ) $selectCandidatoS .= " AND ( c.id_setor1 = $busca_setor OR c.id_setor2 = $busca_setor OR c.id_setor3 = $busca_setor )";

		if ( !empty( $busca_cargo ) ) $selectCandidatoS .= " AND ( c.id_cargo1 = $busca_cargo OR c.id_cargo2 = $busca_cargo OR c.id_cargo3 = $busca_cargo )";

		if ( !empty( $busca_nivel_interesse ) ) $selectCandidatoS .= " AND c.nivel_interesse = $busca_nivel_interesse";
		
		if ( !empty( $busca_status_avaliacao ) ) $selectCandidatoS .= " AND c.status_avaliacao= $busca_status_avaliacao";
		
		if ( !empty( $busca_palavra_chave) ){
			
			$selectCandidatoS .= " AND ( e.cargo LIKE '%$busca_palavra_chave%'
									OR c.objetivo LIKE '%$busca_palavra_chave%'
									OR e.atividades LIKE '%$busca_palavra_chave%'
									OR cu.nome LIKE '%$busca_palavra_chave%'
									OR cu.instituicao LIKE '%$busca_palavra_chave%' ) "; 
		}
	
	}
	
	$selectCandidatoS .= " GROUP BY c.nome ORDER BY ". $orderby;
	
	// print_r($selectCandidatoS);
	
	$candidatoS = select('candidato', $selectCandidatoS);
	
?>

<div class="row" style="margin-top:20px;">
    <div class="col-md-12 ">
      <form class="form-horizontal" role="form" method="post" action="?go=buscar">
        <fieldset>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><a data-toggle="collapse" data-parent="#forms" href="#form-busca"><i class="fa fa-search"></i> Parâmetros de Busca</a></h4>
	</div>

	<div id="form-busca" class="panel-collapse collapse in">
<div class="panel-body">
			
			<!-- Text input-->		
		<div class="form-group">
			<form method="POST" action="buscar.php">
				<label class="col-sm-1 control-label" for="nome">Nome</label>
				<div class="col-sm-5">
					<input type="text" placeholder="Insira o nome" name="candidato_nome" class="form-control"> <?php echo !empty($busca_candidato_nome) ?> 
				</div>
			
				<label class="col-sm-1 control-label" for="cpf">Cpf</label>
				<div class="col-sm-3">
					<input type="text" placeholder="Insira o cpf" name="candidato_cpf" class="form-control"> <?php echo !empty($busca_candidato_cpf) ?>  
				</div>
			</form>
		</div>

		<div class="form-group">
			<label class="col-sm-1 control-label" for="setor">Setor</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="setor" id="setor">
					<option></option>
					<?php foreach ( $setoreS as $setor ) : ?>
					<option value="<?php echo $setor['id']; ?>" <?php echo $setor['id'] == $busca_setor ? 'selected' : ''?>> <?php echo $setor['nome']; ?></option>	
					<?php endforeach; ?>
				</select>
			</div>
			
			<label class="col-sm-1 control-label" for="cargo">Cargo</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="cargo" id="cargo">
					<option></option>
					<?php foreach ( $cargoS as $cargo ) : ?>
					<option value="<?php echo $cargo['id']; ?>" <?php echo $cargo['id'] == $busca_cargo ? 'selected' : ''?>> <?php echo $cargo['nome']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<label class="col-sm-1 control-label" for="nivel_interesse">Nivel</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="nivel_interesse" id="nivel_interesse">
					<option></option>
					<?php for ($value = 1; $value < count($nivelInteresseS); $value++){ ?>
						<option value="<?php echo $value; ?>" <?php echo $value == $busca_nivel_interesse ? 'selected' : '' ?> > <?php echo $nivelInteresseS[$value] ?></option>
					<?php } ?>
				</select>
			</div>
		</DIV>
		
		<div class="form-group">			
			<label class="col-sm-1 control-label" for="regiao">Região</label>
			<div class="col-sm-2">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="regiao_interesse" value="<?php echo $busca_regiao_sp == 1 ? '1' : '0' ?>" onclick="checkThisBox(this, '#regiao_sp')" <?php if ( $busca_regiao_sp == '1' ) echo 'checked'; ?> /> São Paulo - SP
						<input type="hidden" name="regiao_sp" id="regiao_sp" value="<?php echo $busca_regiao_sp == 1 ? '1' : '0' ?>" />
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="regiao_interesse" value="<?php echo $busca_regiao_abc == 1 ? '1' : '0' ?>" onclick="checkThisBox(this, '#regiao_abc')" <?php if ( $busca_regiao_abc == '1' ) echo 'checked'; ?> /> Região ABC - SP
						<input type="hidden" name="regiao_abc" id="regiao_abc" value="<?php echo $busca_regiao_abc == 1 ? '1' : '0' ?>" />
					</label>
				</div>
			</div>
		</DIV>

		<div class="form-group">
			<label class="col-sm-1 control-label" for="sexo">Sexo</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="sexo" id="sexo">
					<option></option>
					<option value="m" <?php if ( $busca_sexo == 'm' ) echo 'selected'; ?>>Masculino</option>
					<option value="f" <?php if ( $busca_sexo == 'f' ) echo 'selected'; ?>>Feminino</option>
				</select>
			</div>
			
			<label class="col-sm-1 control-label" for="filhos">Filhos?</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="filhos" id="filhos">
					<option></option>
					<option value="0" <?php if ( $busca_filhos == "0" ) echo 'selected'; ?>>Não</option>
					<option value="1" <?php if ( $busca_filhos == "1" ) echo 'selected'; ?>>1</option>
					<option value="2" <?php if ( $busca_filhos == "2" ) echo 'selected'; ?>>2</option>
					<option value="3" <?php if ( $busca_filhos == "3" ) echo 'selected'; ?>>3</option>
					<option value="4" <?php if ( $busca_filhos == "4" ) echo 'selected'; ?>>4</option>
					<option value="5" <?php if ( $busca_filhos == "5" ) echo 'selected'; ?>>5 ou mais</option>
				</select>
			</div>
		
			<label class="col-sm-2 control-label" for="nivel_escolaridade">Escolaridade</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="nivel_escolaridade" id="nivel_escolaridade">
					<option></option>
					<?php for ($value = 1; $value < count($escolaridadeS); $value++){ ?>
						<option value="<?php echo $value; ?>" <?php echo $value == $busca_nivel_escolaridade ? 'selected' : '' ?> > <?php echo $escolaridadeS[$value] ?></option>
					<?php } ?>
				</select>
			</div>
		</DIV>
		
		<div class="form-group">
			<label class="col-sm-1 control-label" for="bairro">Bairro</label>
			<div class="col-sm-2">
				<input type="text" placeholder="Bairro do Candidato" name="bairro" class="form-control" <?php echo !empty($busca_bairro) ? 'value="'.$busca_bairro.'"' : '' ?> >
			</div>
			
			<label class="col-sm-1 control-label" for="cidade">Cidade</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="cidade" id="cidade">
					<option></option>
					<?php for ($value = 1; $value < count($cidadeS); $value++){ ?>
						<option value="<?php echo $value; ?>" <?php echo $value == $busca_cidade ? 'selected' : '' ?> > <?php echo $cidadeS[$value] ?></option>
					<?php } ?>
				</select>
			</div>
			
			<label class="col-sm-2 control-label" for="ufEstado">Estado (UF)</label>
			<div class="col-sm-1">
				<select class="form-control col-sm-2" name="ufEstado" id="ufEstado">
					<option></option>
					<?php for ($value = 1; $value < count($ufEstadoS); $value++){ ?>
						<option value="<?php echo $value; ?>" <?php echo $value == $ufEstadoS ? 'selected' : '' ?> > <?php echo $ufEstadoS[$value] ?></option>
					<?php } ?>
				</select>
			</div>
		</DIV>
		
		<div class="form-group">
		
			<label class="col-sm-1 control-label" for="deficiente">Deficiente?</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="deficiente" id="deficiente">
					<option></option>
					<option value="0" <?php if ( $busca_deficiente == "0" ) echo 'selected'; ?>>Não</option>
					<option value="1" <?php if ( $busca_deficiente == "1" ) echo 'selected'; ?>>Sim</option>
				</select>
			</div>
		</DIV>
		
		<div class="form-group">
			<div id="deficiencia" style="display: <?php echo $busca_deficiente == "1" ? 'true' : 'none' ?>;">
			<div class="form-group">
				<label class="col-lg-1 control-label">A que tipo(s) se enquadra:</label>
				<div class="col-lg-1">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="deficiencia" value="<?php echo $busca_deficiencia_auditiva == 1 ? '1' : '0' ?>" id="auditiva" onclick="checkThisBox(this, '#deficiencia_auditiva');" <?php if ( $busca_deficiencia_auditiva == "1" ) echo 'checked'; ?> /> Auditiva
							<input type="hidden" name="deficiencia_auditiva" id="deficiencia_auditiva" value="<?php echo $busca_deficiencia_auditiva == 1 ? '1' : '0' ?>" />
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="deficiencia" value="<?php echo $busca_deficiencia_fala == 1 ? '1' : '0' ?>" id="fala" onclick="checkThisBox(this, '#deficiencia_fala')" <?php if ( $busca_deficiencia_fala == "1" ) echo 'checked'; ?> /> Fala
							<input type="hidden" name="deficiencia_fala" id="deficiencia_fala" value="<?php echo $busca_deficiencia_fala == 1 ? '1' : '0' ?>" />
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="deficiencia" value="<?php echo $busca_deficiencia_fisica == 1 ? '1' : '0' ?>" id="fisica" onclick="checkThisBox(this, '#deficiencia_fisica')" <?php if ( $busca_deficiencia_fisica == "1" ) echo 'checked'; ?> /> Fisica
							<input type="hidden" name="deficiencia_fisica" id="deficiencia_fisica" value="<?php echo $busca_deficiencia_fisica == 1 ? '1' : '0' ?>" />
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="deficiencia" value="<?php echo $busca_deficiencia_mental== 1 ? '1' : '0' ?>" id="mental" onclick="checkThisBox(this, '#deficiencia_mental')" <?php if ( $busca_deficiencia_mental == "1" ) echo 'checked'; ?> /> Intelectual/Mental
							<input type="hidden" name="deficiencia_mental" id="deficiencia_mental" value="<?php echo $busca_deficiencia_mental== 1 ? '1' : '0' ?>" />
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="deficiencia" value="<?php echo $busca_deficiencia_visual == 1 ? '1' : '0' ?>" id="visual" onclick="checkThisBox(this, '#deficiencia_visual')" <?php if ( $busca_deficiencia_visual == "1" ) echo 'checked'; ?> /> Visual
							<input type="hidden" name="deficiencia_visual" id="deficiencia_visual" value="<?php echo $busca_deficiencia_visual == 1 ? '1' : '0' ?>" /> 
						</label>
					</div>
				</div>
			</div>
			</div>
		</DIV>
		
		<div class="form-group">
			<label class="col-sm-1 control-label" for="status_avaliacao">Status</label>
			<div class="col-sm-2">
				<select class="form-control col-sm-2" name="status_avaliacao" id="status_avaliacao">
					<option></option>
					<?php for ($value = 1; $value < count($statusAvaliacaoS); $value++){ ?>
						<option value="<?php echo $value; ?>" <?php echo $value == $busca_status_avaliacao ? 'selected' : '' ?> > <?php echo $statusAvaliacaoS[$value] ?></option>
					<?php } ?>
				</select>
			</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="palavra-chave">Palavra-Chave</label><i class="fa fa-info-circle" style="cursor:pointer; color:#357ebd" title="Busca em: objetivos, cursos e experiências profissionais."></i>
			<div class="col-sm-3">
				<input type="text" placeholder="Palavra-chave" name="palavra-chave" class="form-control" <?php echo !empty($busca_palavra_chave) ? 'value="'.$busca_palavra_chave.'"' : '' ?> >
			</div>
		</DIV>
		
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-4">
              <div class="pull-left">
                <button type="submit" class="btn btn-primary"><!-- <i class="fa fa-search"></i>  -->Pesquisar</button>
                <a href="./" class="btn btn-default"><i class="fa fa-refresh" style="padding-right: 5px;"></i>Limpar</a>
              </div>
            </div>
          </div>
		</div>
	</div>
</div>
		

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<?php if (!empty($_SESSION['message'])) { ?>

<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>

<?php echo $_SESSION['message']; ?>


</div>

<?php
	clear_messages(); 
	}
?>

<div id="list" class="row">
<div class="table-responsive col-md-12">
<legend class="text-center">Candidatos</legend>
<table class="table table-striped" cellspacing="0" cellpadding="0"> <!-- class="sorttable" -->
	<thead>
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Celular</th>
			<th>Residencial</th>
			<th>Avaliação</th>
			<th>Status</th>
			<th>Infos</th>			
			<th class="actions">Ações</th>
		</tr>
	</thead>
	
	
<tbody>

<?php

if ($candidatoS) {
	foreach ($candidatoS as $candidato) {
?>

<style>
.estrelas<?php echo $candidato['id']; ?> input[type=radio] {
	display: none;
}
.estrelas<?php echo $candidato['id']; ?> label i.fa:before {
	content:'\f005';
	color: #FC0;
}
.estrelas<?php echo $candidato['id']; ?> input[type=radio]:checked  ~ label i.fa:before {
	color: #CCC;
}
</style>

	<tr>
		<td><?php echo $candidato['nome']; ?></td>
		<td><a href="<?php echo "mailto:" . $candidato['email']; ?>"><?php echo $candidato['email']; ?></a></td>
		<td><?php echo mask($candidato['celular'], '## #####-####'); ?></td>
		<td><?php echo strlen($candidato['tel_residencial']) > 1 ? mask($candidato['tel_residencial'], '## ####-####') : 'Não possui'; ?></td>
		<td>
		<div class="estrelas<?php echo $candidato['id']; ?>">
			<?php if ( $candidato['avaliacao_rh'] == 0 ) {
					echo 'Sem avaliação';
				} else { ?>
			<input type="radio" id="cm_star-empty" name="avaliacao<?php echo $candidato['id']; ?>" value="" <?php echo $candidato['avaliacao_rh'] == 0 ? 'checked' : ''; ?> disabled/>
			<label for="cm_star-1_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
			<input type="radio" id="cm_star-1_<?php echo $candidato['id']; ?>" name="avaliacao<?php echo $candidato['id']; ?>" value="1" <?php echo $candidato['avaliacao_rh'] >= 1 ? 'checked' : ''; ?> disabled />
			<label for="cm_star-2_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
			<input type="radio" id="cm_star-2_<?php echo $candidato['id']; ?>" name="avaliacao<?php echo $candidato['id']; ?>" value="2" <?php echo $candidato['avaliacao_rh'] >= 2 ? 'checked' : ''; ?> disabled />
			<label for="cm_star-3_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
			<input type="radio" id="cm_star-3_<?php echo $candidato['id']; ?>" name="avaliacao<?php echo $candidato['id']; ?>" value="3" <?php echo $candidato['avaliacao_rh'] >= 3 ? 'checked' : ''; ?> disabled />
			<label for="cm_star-4_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
			<input type="radio" id="cm_star-4_<?php echo $candidato['id']; ?>" name="avaliacao<?php echo $candidato['id']; ?>" value="4" <?php echo $candidato['avaliacao_rh'] >= 4 ? 'checked' : ''; ?> disabled />
			<label for="cm_star-5_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
			<input type="radio" id="cm_star-5_<?php echo $candidato['id']; ?>" name="avaliacao<?php echo $candidato['id']; ?>" value="5" <?php echo $candidato['avaliacao_rh'] >= 5 ? 'checked' : ''; ?> disabled />
			<?php } ?>
		</div>
		</td>
		<td><?php echo $candidato['status_avaliacao'] ? $statusAvaliacaoS[$candidato['status_avaliacao']] : 'Sem avaliação'; ?>
		<td>
			<?php echo $candidato['sexo'] == 'm' ? '<i title="Masculino" class="fa fa-mars" style="color:#428bca"></i>' : '<i title="Feminino" class="fa fa-venus" style="color:#fe77b9"></i>'; ?>
			<?php if ( $candidato['deficiente'] == 1 ) echo '<i title="Deficiente" class="fa fa-wheelchair" style="color:#428bca"></i>'; ?>
			<?php if ( $candidato['filhos'] > 0 ) echo '<i title="Possui '. $candidato['filhos'] . ' filho(s)" class="fa fa-child" style="color:#428bca"></i>'; ?>
			<?php // if ( !empty($candidato['facebook']) ) echo '<a target="_blank" href="http://facebook.com/' . $candidato['facebook'] . '"><i title="Facebook" class="fa fa-facebook" style="color:#428bca"></i></a>'; ?>
			<?php // if ( !empty($candidato['twitter']) ) echo '<a target="_blank" href="http://twitter.com/' . $candidato['twitter'] . '"><i title="Twitter" class="fa fa-twitter" style="color:#428bca"></i></a>'; ?>
			<?php // if ( !empty($candidato['linkedin']) ) echo '<a target="_blank" href="http://linkedin.com/in/' . $candidato['facebook'] . '"><i title="LinkedIn" class="fa fa-linkedin" style="color:#428bca"></i></a>'; ?>
		</td>
		<td class="actions">
			<a class="btn btn-primary btn-xs" href="curriculo.php?id=<?php echo $candidato[ 'id' ]?>">
				<!-- <i class="fa fa-eye"></i> --> Curriculo</a>
			
<!-- 			<a class="btn btn-success btn-xs"  href="#" data-toggle="modal" data-target="#observacao-modal"> -->
<!-- 				<i class="fa fa-pencil-square-o"></i> Avaliar</a> -->
		</td>
	</tr>
	
<?php 
	}
	} else {
	
	?>

<tr>
	<td colspan="6">Nenhum registro encontrado.</td>
</tr>

<?php } ?>
	
</tbody>
</table>
</div>
	
</div> <!-- /#list -->
	
<div id="bottom" class="row">
<div class="col-md-12">
<ul class="pagination">
<li class="disabled"><a>&lt; Anterior</a></li>
<li class="btn"><a>1</a></li>
<!-- <li><a href="#">2</a></li> -->
<!-- <li><a href="#">3</a></li> -->
<li class="disabled"><a>Próximo &gt;</a></li>
</ul><!-- /.pagination -->
</div>
</div> <!-- /#bottom -->
</div> <!-- /#main -->

<script>
$('#deficiente').on('click', function(event) {
var value = $('#deficiente').val();
	if (value == 1){
		$('#deficiencia').show();
		return true;
	} else {
		$('#deficiencia').hide();
		return true;
	}
});
</script>

<?php 
} else {
		include(NOTFOUND);
		}


include(FOOTER_TEMPLATE); ?>