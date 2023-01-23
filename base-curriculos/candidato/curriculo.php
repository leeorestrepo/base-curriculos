<?php
require_once('functions.php');
require_once('_optionS.php');

include(HEADER_TEMPLATE);

@session_start();

$db = open_database();

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

if (!empty($_SESSION['nivel_acesso']) == true and $_SESSION['nivel_acesso'] == 1) {

	view($_SESSION['id']);
	$cand = new Candidato( $_SESSION['id'] );

} else if (!empty($_SESSION['nivel_acesso']) == true and $_SESSION['nivel_acesso'] == 2) {

	view($_GET['id']);
	$cand = new Candidato( $_GET['id'] );

}

if (!empty($candidato['id']) == true and $candidato['id'] > 0) {
	
	if ($_GET['id'] == $_SESSION['id'] || $_SESSION['nivel_acesso'] == 2)	{
		// Após as verificações, começos com o conteúdo:
		
		
		$logado = $_SESSION["login"];

		
		if (@$_GET ['go'] == 'avaliar') {
			
			// print_r($_POST);
			
			if ( $candidato['id'] > 0 ) {
				
				$items = "data_avaliacao='".date("Y-m-d H:i:s")."' 
						, usuario_avaliou = ".$_SESSION['id'] . " 
						, avaliacao_rh = " . $_POST['hiddenAvaliacao'] . "
						, status_avaliacao = " . $_POST['status_avaliacao'];
				
				$novaObs = "(" . date_format(date_create($cand->getDataAvaliacao()), 'd/m/Y' ). ") " . $_POST['observacoes_rh'] . " - " . "Status atual: " . $statusAvaliacaoS[ $_POST['status_avaliacao'] ] . "<br>";
				
				if( $cand->getObservacoes() != null && strlen( $cand->getObservacoes() ) > 0 ){
					
					$novaObs .= $cand->getObservacoes() . " <br> ";
										
				}
				
				$items .= ", observacoes_rh = '" . $novaObs ."'";
				
				if ( update('candidato', $items, $cand->getId()) ) {
					$_SESSION ['message'] = 'Candidato avaliado com sucesso.';
					$_SESSION ['type'] = 'success';
				}
				
				echo "<script>window.location.replace('" . BASEURL . "candidato/curriculo.php?id=".$cand->getId()."');</script>";
				
			};

		}
			
		
?>

<style>
.estrelas<?php echo $cand->getId(); ?> input[type=radio] {
	display: none;
}
.estrelas<?php echo $cand->getId(); ?> label i.fa:before {
	content:'\f005';
	color: #FC0;
}
.estrelas<?php echo $cand->getId(); ?> input[type=radio]:checked  ~ label i.fa:before {
	color: #CCC;
}

.estrelasc input[type=radio] {
	display: none;
}
.estrelasc label i.fa:before {
	content:'\f005';
	color: #FC0;
}
.estrelasc input[type=radio]:checked  ~ label i.fa:before {
	color: #CCC;
}
</style>

<style media="print">
.noprint {
	display: none;
	}
</style>

<div class="container noprint" style="margin-top:20px;">
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="<?php echo $_SESSION['nivel_acesso'] == 2 ? BASEURL.'candidato/' : BASEURL; ?>" class="btn btn-default">Voltar</a>
			<?php if ( $_SESSION['nivel_acesso'] == 2 ) echo '<a class="btn btn-success"  href="#" data-toggle="modal" data-target="#observacao-modal">Avaliar</a>'; ?>
			<a href="<?php echo $_SESSION['nivel_acesso'] == 2 ? BASEURL.'candidato/ref_prof.php?id='.$_GET['id'] : BASEURL; ?>" class="btn btn-info">Referência Profissional</a>
		</div>
	</div>
</div>



<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="<?php echo BASEURL;?>vendor/w3/css/w3.css"> 
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'> 


<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-container">
            <h2><?php echo $candidato['nome']; ?></h2>
            <br>
            <p><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $escolaridadeS[ $candidato['cod_nivel_escolaridade'] ]; ?></p>
            <br>
            <p><i class="fa fa-user-circle-o fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo getIdade( $candidato['data_nasc'] ) . " anos, " . $estadoCivilS[ $candidato['estado_civil'] ]; ?></p>
          	
          <?php if ( $candidato['filhos'] > 0 ) echo "<p><i class='fa fa-child fa-fw w3-margin-right w3-large w3-text-teal'></i>Possui " . $candidato['filhos'] . " filhos(as)</p>"; ?>
          <?php if ( $candidato['deficiente'] == 1 ) {
          		$candidato_deficiencia = "Deficiencia: ";
         		$i = " ";
         		
          			if ( $candidato['deficiencia_fala'] == 1 ) { 
          				$candidato_deficiencia .= $i."Fala";
          				$i = ", ";
          			}
          			if ( $candidato['deficiencia_auditiva'] == 1 ) {
          				$candidato_deficiencia .= $i."Auditiva";
          				$i = ", ";
          			}
          			if ( $candidato['deficiencia_fisica'] == 1 ) {
          				$candidato_deficiencia .= $i."Fisica";
          				$i = ", ";
          			}
          			if ( $candidato['deficiencia_mental'] == 1 ) {
          				$candidato_deficiencia .= $i."Mental";
          				$i = ", ";
          			}
     				if ( $candidato['deficiencia_visual'] == 1 ) {
     					$candidato_deficiencia .= $i."Visual";
     					$i = ", ";
     				}
     				
     				$candidato_deficiencia .= ".";
     				echo "<p><i class='fa fa-wheelchair fa-fw w3-margin-right w3-large w3-text-teal'></i>" . $candidato_deficiencia . "</p>";
          		}
			?>
			
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php $endereco_completo = $candidato['endereco'] . ", " . $candidato['endereco_numero'];
				if (!empty($candidato['endereco_complemento']) ) $endereco_completo .= " - " . $candidato['endereco_complemento'];
				echo $endereco_completo;
			?>
          </p>
          
          <p><i class="fa fa-globe fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo mask( $candidato['cep'], '#####-###' ) . " - " . $candidato['bairro'] . " - " . $cidadeS[ $candidato['cod_cidade'] ] ?> - <?php echo $candidato['cod_estado'];?></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo strtolower( $candidato['email'] ); ?></p>
          <p><i class="fa fa-mobile fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo mask( $candidato['celular'], '## #####-####' ); ?></p>
         <?php if ( !empty( $candidato['tel_residencial'] ) ) { ?>
          	<p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo mask( $candidato['tel_residencial'], '## ####-####' ); ?></p>
         <?php } ?>
          <hr>

		<?php if ( !empty ( $idiomaS )) { ?>
          <p class="w3-large"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Idiomas</b></p>
          <?php foreach ( $idiomaS as $idioma ) { ?>
          <p><?php echo $listaIdiomaS[ $idioma['cod_idioma'] ]; ?></p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
            <font class="w3-text-teal">Leitura: </font>
            <?php echo $nivelIdiomaS[ $idioma['nivel_leitura'] ]; ?>
            <br>
            <font class="w3-text-teal">Escrita: </font>
            <?php echo $nivelIdiomaS[ $idioma['nivel_escrita'] ]; ?>
            <br>
            <font class="w3-text-teal">Conversação: </font>
            <?php echo $nivelIdiomaS[ $idioma['nivel_conversacao'] ]; ?>
          </div>
          <br>
          <?php 
			}}
			?>
	</div>
</div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
	<div class="w3-twothird">

		<div class="w3-container w3-card w3-white w3-margin-bottom">
			<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-line-chart fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Objetivo</h2>
			<div class="w3-container">
				<h5 class="w3-opacity"><b></b></h5>
				<h6 class="w3-text-teal"><span class="w3-tag w3-teal w3-round">Interesses</span></h6>
				<?php 
					$a = "Setor"; 
					$setores = getSetor( $candidato['id_setor1'] );
					
					if ( !empty ($candidato['id_setor2']) && $candidato['id_setor2'] != $candidato['id_setor1'] ) {
						$a = "Setores"; $setores .= ", ".getSetor( $candidato['id_setor2'] );
					}
					
					if ( !empty ($candidato['id_setor3']) && $candidato['id_setor3'] != $candidato['id_setor2'] && $candidato['id_setor3'] != $candidato['id_setor1']) {
						$a = "Setores"; $setores .= ", ".getSetor( $candidato['id_setor3'] );
					}
					
					echo "<p><font class='w3-text-teal'>" . $a . ": </font>" . $setores . "<p>";
				?>
				<?php 
					$a = "Cargo"; 
					$cargos = getCargo( $candidato['id_cargo1'] );
					
					if ( !empty ($candidato['id_cargo2']) && $candidato['id_cargo2'] != $candidato['id_cargo1'] ) {
						$a = "Cargos"; $cargos .= ", ".getCargo( $candidato['id_cargo2'] );
					}
					
					if ( !empty ($candidato['id_cargo3']) && $candidato['id_cargo3'] != $candidato['id_cargo2'] && $candidato['id_cargo3'] != $candidato['id_cargo1'] ) {
						$a = "Cargos"; $cargos .= ", ".getCargo( $candidato['id_cargo3'] );
					}
					
					echo "<p><font class='w3-text-teal'>" . $a . ": </font>" . $cargos . "<p>";
				?>
				<p><font class="w3-text-teal">Nivel: </font><?php echo $nivelInteresseS[ $candidato['nivel_interesse'] ]; ?></p>
				<p><font class='w3-text-teal'>Pretensão Salarial: </font><?php echo $salarioS[ $candidato['cod_pretensao_salarial'] ]; ?></p>
				<?php 
          		$a = "";
         		$i = " ";
         		
          			if ( $candidato['regiao_sp'] == 1 ) { 
          				$a .= $i."São Paulo";
          				$i = ", ";
          			}
          			if ( $candidato['regiao_abc'] == 1 ) {
          				$a .= $i."Região ABC";
          				$i = ", ";
          			}
          			if ( $candidato['regiao_barueri'] == 1 ) {
          				$a .= $i."Barueri";
          				$i = ", ";
          			}
     				
     				$a .= ".";
     				echo "<p><span class='w3-text-teal'>Regiões de Interesse: </span>" . $a . "</p>";
			?>
				<br>
				<p><font class="w3-text-teal">Objetivo: </font><?php echo $candidato['objetivo']; ?>.</p>
				<hr>
			</div>
		</div>

		<?php if ( !empty ( $empregoS )) { ?>
		<div class="w3-container w3-card w3-white w3-margin-bottom">
			<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Experiência Profissional</h2>
			<?php foreach ( $empregoS as $emprego ){?>
			<div class="w3-container">
				<h5 class="w3-opacity"><b><?php echo $emprego['empresa']; ?></b></h5>
				<h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>
					<?php echo date_format(date_create($emprego['data_admissao']), 'm/Y'); ?> - <?php echo $emprego['atual'] == 1 ? '<span class="w3-tag w3-teal w3-round">Hoje</span>' : date_format(date_create($emprego['data_demissao']), 'm/Y')?>
				</h6>
				<p><font class="w3-text-teal">Cargo: </font><?php echo $emprego['cargo']; ?></p>
				<?php if ( !empty ( $emprego['salario'] ) ) echo "<p><font class='w3-text-teal'>Salário: </font> R$" . formatarMoeda($emprego['salario'], 'sql'); ?></p>
				<p><font class="w3-text-teal">Atividades: </font><?php echo $emprego['atividades']; ?></p>
				<?php if ($emprego['atual'] == 0) echo "<p><font class='w3-text-teal'>Motivo da demissão: </font>" . $emprego['motivo_demissao'] . "</p>"; ?>
				<hr>
			</div>
			<?php } ?>
		</div>
		<?php }	?>
		
		<?php if ( !empty ( $refProfissionalS )) { ?>
		<div class="w3-container w3-card w3-white w3-margin-bottom">
			<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Referência Profissional</h2>
			<?php foreach ( $refProfissionalS as $ref_profissional ){?>
			
			<div class="w3-container">
			
			        <p><font class="w3-text-teal">Nome da Empresa: </font><?php echo $ref_profissional['nome_empresa'] ?></p>
			        
			        <p><font class="w3-text-teal">Nome do Contato: </font><?php echo $ref_profissional['nome_contato'] ?></p>
			
					<p><font class="w3-text-teal">Motivo do Desligamento: </font><?php echo $ref_profissional['motivo_desligamento'] ?></p>	
					
					<p><font class="w3-text-teal">Função exercida: </font><?php echo $ref_profissional['funcao']; ?></p>	
					
					<p><font class="w3-text-teal">Tempo exercendo a função: </font><?php echo $ref_profissional['qtd_mes']; ?></p>	
					
					<p><font class="w3-text-teal">Ponto fraco do candidato: </font><?php echo $ref_profissional['ponto_fraco']; ?></p>	
					
					<p><font class="w3-text-teal">Ponto forte do candidato: </font><?php echo $ref_profissional['ponto_forte']; ?></p>	
					
					<p><font class="w3-text-teal">Avaliação de Responsabilidade: </font><?php echo $ref_profissional['responsabilidade']; ?></p>	
					
					<p><font class="w3-text-teal">Avaliação de Pontualidade: </font><?php echo $ref_profissional['pontualidade']; ?></p>	
					
					<p><font class="w3-text-teal">Contrataria novamente: </font><?php
					
					if ($ref_profissional['contrataria_novamente'] == 0){
						echo 'Não' ;
					}
					else if ($ref_profissional['contrataria_novamente'] == 1){
						echo 'Sim' ;
					}
					
					?></p>									
			
			</div>
			<?php } ?>
		</div>
		<?php }	?>
		
		

		<?php if ( !empty ( $cursoS )) { ?>
		<div class="w3-container w3-card w3-white w3-margin-bottom">
			<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Cursos Complementares</h2>
			<?php foreach ( $cursoS as $curso ){?>
			<div class="w3-container">
				<h5 class="w3-opacity"><b><?php echo $curso['instituicao']; ?></b></h5>
				<h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo date_format(date_create($curso['data_inicio']), 'm/Y'); ?> - <?php echo $curso['situacao'] == 2 ? '<span class="w3-tag w3-teal w3-round">Hoje</span>' : date_format(date_create($curso['data_final']), 'm/Y')?></h6></h6>
				<p><?php echo $curso['nome']; ?></p>
				<hr>
			</div>
			<?php } ?>
		</div>
		<?php }	?>
		
		<?php if ( $_SESSION['nivel_acesso'] == 2 && !empty( $cand->getDataAvaliacao() )) { ?>
		<div class="w3-container w3-card w3-white w3-margin-bottom">
			<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-check fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Avaliação</h2>
			<div class="w3-container">
				<?php 
				
				switch ( $cand->getStatus() ) {
					case 1:
						echo '<p class="w3-tag w3-green w3-round">'.$statusAvaliacaoS[ $cand->getStatus() ].'</p>';
						break;
					case 2:
						echo '<p class="w3-tag w3-red w3-round">'.$statusAvaliacaoS[ $cand->getStatus() ].'</p>';
						break;
					case 3:
						echo '<p class="w3-tag w3-blue-grey w3-round">'.$statusAvaliacaoS[ $cand->getStatus() ].'</p>';
						break;
					case 4:
						echo '<p class="w3-tag w3-orange w3-text-white w3-round">'.$statusAvaliacaoS[ $cand->getStatus() ].'</p>';
						break;
					case 5:
						echo '<p class="w3-tag w3-teal w3-round">'.$statusAvaliacaoS[ $cand->getStatus() ].'</p>';
						break;
					
				} ?>
				<br>
			<div class="estrelasc">
				<input type="radio" id="cm_star-empty" name="avaliacaoc" value="" <?php echo $candidato['avaliacao_rh'] == 0 ? 'checked' : ''; ?> disabled/>
				<label for="cm_star-1_c"><i class="fa"></i></label>
				<input type="radio" id="cm_star-1_c" name="avaliacaoc" value="1" <?php echo $candidato['avaliacao_rh'] >= 1 ? 'checked' : ''; ?> disabled />
				<label for="cm_star-2_c"><i class="fa"></i></label>
				<input type="radio" id="cm_star-2_c" name="avaliacaoc" value="2" <?php echo $candidato['avaliacao_rh'] >= 2 ? 'checked' : ''; ?> disabled />
				<label for="cm_star-3_c"><i class="fa"></i></label>
				<input type="radio" id="cm_star-3_c" name="avaliacaoc" value="3" <?php echo $candidato['avaliacao_rh'] >= 3 ? 'checked' : ''; ?> disabled />
				<label for="cm_star-4_c"><i class="fa"></i></label>
				<input type="radio" id="cm_star-4_c" name="avaliacaoc" value="4" <?php echo $candidato['avaliacao_rh'] >= 4 ? 'checked' : ''; ?> disabled />
				<label for="cm_star-5_c"><i class="fa"></i></label>
				<input type="radio" id="cm_star-5_c" name="avaliacaoc" value="5" <?php echo $candidato['avaliacao_rh'] >= 5 ? 'checked' : ''; ?> disabled />
			</div>
				
				<br>
				<font class="w3-text-teal"><span class="w3-tag w3-teal w3-round"><?php echo date_format(date_create($cand->getDataAvaliacao()), 'd/m/Y'); ?></span> - <?php echo date_format(date_create($cand->getDataAvaliacao()), 'H:i') ?></font>
				<p><font class="w3-text-teal">Quem avaliou: </font>
					<?php $quem_avaliou = find('candidato', $cand->getQuemAvaliou() );
						echo $quem_avaliou['nome'];
					?></p>
				<p><font class="w3-text-teal">Observação: </font><?php echo $cand->getObservacoes(); ?></p>	
				<hr>
			</div>
		</div>
		<?php }	?>
		
		
	<!-- End Right Column -->
</div>
    
  <!-- End Grid -->
  </div>

<!-- Modal Avaliação-->
<div class="modal fade" id="observacao-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" style="color:#009688; padding:5px 5px 5px 15px;" id="modalLabel">Avaliar Candidato</h4>
		</div>

		<div class="modal-body">
			<form action="?id=<?php echo $_GET['id']; ?>&go=avaliar" method="POST">
				<div class="form-group">
					
					<dl class="dl-horizontal">
						<dt>Nome:</dt>
						<dd><?php 
									echo $cand->getNome();
						?></dd>
					</dl>
					
					<dl class="dl-horizontal">
						<dt>CPF:</dt>
						<dd><?php echo mask( $candidato['cpf'], '###.###.###-##' ); ?></dd>
					</dl>
					
					<dl class="dl-horizontal">
						<dt>Nascimento:</dt>
						<dd><?php echo date_format( date_create( $candidato['data_nasc'] ), 'd/m/Y' ); ?></dd>
					</dl>
					
					<dl class="dl-horizontal">
						<dt>Sexo:</dt>
						<dd><?php
						switch ($candidato['sexo']){
								case 'm':
									echo 'Masculino';
									break;
								case 'f':
									echo 'Feminino';
									break;
								}
							?>
						</dd>
					</dl>
				</div>
				<center><div style="width: 90%; height: 1px; background-color: #009688;"></div></center>
				<hr>
				<div class="form-group" style="padding: 0px 15px 0px 15px;">
				
				<div class="form-group">
				
					<input type="hidden" id="hiddenAvaliacao" name="hiddenAvaliacao" value="0"/>
					
					<label class="control-label">Avaliação </label>
					
					<div class="estrelas<?php echo $candidato['id']; ?>">
						<input type="radio" id="cm_star-empty" value="" />
						<label for="cm_star-1_<?php echo $candidato['id']; ?>" onclick="$('#hiddenAvaliacao').val(1)"><i class="fa"></i></label>
						<input type="radio" id="cm_star-1_<?php echo $candidato['id']; ?>" name="avaliacao" value="1" onclick="$('#hiddenAvaliacao').val(1)" />
						<label for="cm_star-2_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
						<input type="radio" id="cm_star-2_<?php echo $candidato['id']; ?>" name="avaliacao" value="2" onclick="$('#hiddenAvaliacao').val(2)" />
						<label for="cm_star-3_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
						<input type="radio" id="cm_star-3_<?php echo $candidato['id']; ?>" name="avaliacao" value="3" onclick="$('#hiddenAvaliacao').val(3)" />
						<label for="cm_star-4_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
						<input type="radio" id="cm_star-4_<?php echo $candidato['id']; ?>" name="avaliacao" value="4" onclick="$('#hiddenAvaliacao').val(4)" />
						<label for="cm_star-5_<?php echo $candidato['id']; ?>"><i class="fa"></i></label>
						<input type="radio" id="cm_star-5_<?php echo $candidato['id']; ?>" name="avaliacao" value="5" onclick="$('#hiddenAvaliacao').val(5)" />
					</div>
					
				</div>
				
				<div class="form-group">
				
					<label class="control-label">Observações</label>
					
					<textarea class="form-control" id="observacoes_rh" name="observacoes_rh" maxlength="1000" style="height: 80px;" required></textarea>
					
				</div>
				
				<div class="form-group">
					<label class="control-label">Status </label>
					<select class="form-control" id="status_avaliacao" name="status_avaliacao" required>
						<option value=""></option>
						<?php for ($value = 1; $value < count($statusAvaliacaoS); $value++) echo "<option value=" . $value . " class='option-selected'>" . $statusAvaliacaoS[$value] . "</option>"; ?>
					</select>
				</div>
				
				</div>
			
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Avaliar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
            </form>
			
		</div>
		
		
	</div>
</div>
</div>

  <!-- End Page Container -->
</div>

<?php } else {
		include(NOTFOUND);
		}
	} else {
	// Caso não passe pela verificação, exibe a pagina não encontrada (error 404):

include(NOTFOUND);

}

include(FOOTER_TEMPLATE); ?>