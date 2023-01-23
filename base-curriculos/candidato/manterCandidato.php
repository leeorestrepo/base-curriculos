<?php

if( count( $_POST ) > 0 ){
	
	// printR( $_POST );
	
	$rsIdCandidato = findCPF( 'id', removeMask( $_POST['candidato_cpf'] ) );
	$id_candidato = $rsIdCandidato['id'];
	
	$values = Array();
	$valueCursoS = Array();
	$valueIdiomaS = Array();
	$valueEmprego = Array();

	if ( isPost('candidato_nome' ) ) {
		$values[] = "nome='" . getNomeTratado($_POST ['candidato_nome']) . "'";
	}
	if ( isPost('candidato_cpf' ) ) {
		$values[] = "cpf='" . removeMask($_POST['candidato_cpf']) . "'";
	}
	if ( isPost('candidato_data_nasc' ) ) {
		$values[] = "data_nasc='" . dateFormat('Y-m-d', $_POST['candidato_data_nasc'] ) . " 00:00:00'";
	}
	if ( isPost('candidato_sexo' ) ) {
		$values[] = "sexo='" . $_POST['candidato_sexo'] . "'";
	}
	if ( isPost( 'candidato_estado_civil' ) ) {
		$values[] = "estado_civil='" . $_POST['candidato_estado_civil'] . "'";
	}
	if ( $_POST['candidato_filhos'] >= 0 && $_POST['candidato_filhos'] <= 5) {
		$values[] = "filhos='" . $_POST['candidato_filhos'] . "'";
	}
	if ( isPost( 'candidato_nacionalidade' ) ) {
		$values[] = "cod_nacionalidade='" . $_POST['candidato_nacionalidade'] . "'";
	}
	if ( isPost( 'candidato_confirmar_senha' ) && $_POST['candidato_senha'] == $_POST['candidato_confirmar_senha'] ) {
		$values[] = "senha'" . $_POST['candidato_confirmar_senha'] . "'";
	}
	if ( isPost( 'candidato_cep' ) ) {
		$values[] = "cep='" . removeMask($_POST['candidato_cep']) . "'";
	}
	if ( isPost( 'candidato_endereco' ) ) {
		$values[] = "endereco='" . getNomeTratado($_POST['candidato_endereco']) . "'";
	}
	if ( isPost( 'candidato_endereco_numero' ) ) {
		$values[] = "endereco_numero='" . $_POST['candidato_endereco_numero'] . "'";
	}
	if ( isPost( 'candidato_endereco_complemento' ) ) {
		$values[] = "endereco_complemento='" . $_POST['candidato_endereco_complemento'] . "'";
	}
	if ( isPost( 'candidato_bairro' ) ) {
		$values[] = "bairro='" . getNomeTratado($_POST['candidato_bairro']) . "'";
	}
	if ( isPost( 'candidato_cidade' ) ) {
		$values[] = "cod_cidade='" . $_POST['candidato_cidade'] . "'";
	}
	if ( isPost( 'candidato_estado' ) ) {
		$values[] = "cod_estado='" . strtoupper($_POST['candidato_estado']) . "'";
	}
	if ( isPost( 'candidato_email' ) ) {
		$values[] = "email='" . strtolower($_POST['candidato_email']) . "'";
	}
	if ( isPost( 'candidato_celular' ) ) {
		$values[] = "celular='" . removeMask($_POST['candidato_celular']) . "'";
	}
	if ( isPost( 'candidato_tel_residencial' ) ) {
		$values[] = "tel_residencial='" . removeMask($_POST['candidato_tel_residencial']) . "'";
	}
	if ( isPost( 'candidato_preferencia_contato' ) ) {
		$values[] = "cod_preferencia_contato='" . $_POST['candidato_preferencia_contato'] . "'";
	}
	if ( isPost( 'candidato_linkedin' ) ) {
		$values[] = "linkedin='" . $_POST['candidato_linkedin'] . "'";
	}else{
		$values[] = "linkedin=NULL";
	}
	if ( isPost( 'candidato_facebook' ) ) {
		$values[] = "facebook='" . $_POST['candidato_facebook'] . "'";
	}else{
		$values[] = "facebook=NULL";
	}
	if ( isPost( 'candidato_twitter' ) ) {
		$values[] = "twitter='" . $_POST['candidato_twitter'] . "'";
	}else{
		$values[] = "twitter=NULL";
	}
	if ( isPost( 'candidato_blog' ) ) {
		$values[] = "blog='" . $_POST['candidato_blog'] . "'";
	}else{
		$values[] = "blog=NULL";
	}
	if ( isPost( 'candidato_deficiente' ) ) {
		$values[] = "deficiente=b'" . $_POST['candidato_deficiente'] . "'";
	}else{
		$values[] = "deficiente=b'0'";
	}
	if ( isPost( 'deficiencia_auditiva' ) ) {
		$values[] = "deficiencia_auditiva=b'" . $_POST['deficiencia_auditiva'] . "'";
	}else{
		$values[] = "deficiencia_auditiva=b'0'";
	}
	if ( isPost( 'deficiencia_fala' ) ) {
		$values[] = "deficiencia_fala=b'" . $_POST['deficiencia_fala'] . "'";
	}else{
		$values[] = "deficiencia_fala=b'0'";
	}
	if ( isPost( 'deficiencia_fisica' ) ) {
		$values[] = "deficiencia_fisica=b'" . $_POST['deficiencia_fisica'] . "'";
	}else{
		$values[] = "deficiencia_fisica=b'0'";
	}
	if ( isPost( 'deficiencia_mental' ) ) {
		$values[] = "deficiencia_mental=b'" . $_POST['deficiencia_mental'] . "'";
	}else{
		$values[] = "deficiencia_mental=b'0'";
	}
	if ( isPost( 'deficiencia_visual' ) ) {
		$values[] = "deficiencia_visual=b'" . $_POST['deficiencia_visual'] . "'";
	}else{
		$values[] = "deficiencia_visual=b'0'";
	}
	/* deficiencia_auditiva
	deficiencia_fala
	deficiencia_fisica
	deficiencia_mental
	deficiencia_visual */
	
	$usouCargo3 = $usouSetor3 = false;
	if ( isPost( 'candidato_objetivo' ) ) {
		$values[] = "objetivo='" . $_POST['candidato_objetivo'] . "'";
	}
	if ( isPost( 'candidato_setor1' ) ) {
		$values[] = "id_setor1='" . $_POST['candidato_setor1'] . "'";
	}
	if ( isPost( 'candidato_cargo1' ) ) {
		$values[] = "id_cargo1='" . $_POST['candidato_cargo1'] . "'";
	}
	if ( isPost( 'candidato_setor2' ) ) {
		$values[] = "id_setor2='" . $_POST['candidato_setor2'] . "'";
	} else if ( isPost( 'candidato_setor3' ) ) {
		$values[] = "id_setor2='" . $_POST['candidato_setor3'] . "'";
		$usouSetor3 = true;
	}
	if ( isPost( 'candidato_cargo2' ) ) {
		$values[] = "id_cargo2='" . $_POST['candidato_cargo2'] . "'";
	} else if ( isPost( 'candidato_cargo3' ) ) {
		$values[] = "id_cargo3='" . $_POST['candidato_cargo3'] . "'";
		$usouCargo3 = true;
	}
	if ( isPost( 'candidato_setor3' ) && !$usouSetor3) {
		$values[] = "id_setor3='" . $_POST['candidato_setor3'] . "'";
	}
	if ( isPost( 'candidato_cargo3' )  && !$usouCargo3) {
		$values[] = "id_cargo3='" . $_POST['candidato_cargo3'] . "'";
	}
	if ( isPost( 'candidato_nivel_interesse' ) ) {
		$values[] = "nivel_interesse='" . $_POST['candidato_nivel_interesse'] . "'";
	}
	if ( isPost( 'candidato_pretensao_salarial' ) ) {
		$values[] = "cod_pretensao_salarial='" . $_POST['candidato_pretensao_salarial'] . "'";
	}
	if ( isPost( 'candidato_regiao_sp' ) ) {
		$values[] = "regiao_sp= b'" . $_POST['candidato_regiao_sp'] . "'";
	}
	if ( isPost( 'candidato_regiao_abc' ) ) {
		$values[] = "regiao_abc= b'" . $_POST['candidato_regiao_abc'] . "'";
	}
	if ( isPost( 'candidato_nivel_escolaridade' ) ) {
		$values[] = "cod_nivel_escolaridade='" . $_POST['candidato_nivel_escolaridade'] . "'";
	}
	
	if ( $_POST['curso_nome'] && count( $_POST['curso_nome'] ) > 0 ) {
		
			$qtdCursoS				= count( $_POST['curso_nome'] ); 
			$arr_curso_nome			= $_POST['curso_nome'];
			$arr_curso_instituicao	= $_POST['curso_instituicao'];
			$arr_curso_cod_tipo		= $_POST['curso_cod_tipo'];
			$arr_curso_pais			= $_POST['curso_pais'];
			$arr_curso_estado		= $_POST['curso_estado'];
			$arr_curso_data_inicio	= $_POST['curso_data_inicio'];
			$arr_curso_data_final	= $_POST['curso_data_final'];
			$arr_curso_situacao		= $_POST['curso_situacao'];

			$columnCursoS[] =  "nome";
			$columnCursoS[] =  "cod_tipo";
			$columnCursoS[] =  "instituicao";
			$columnCursoS[] =  "pais";
			$columnCursoS[] =  "estado";
			$columnCursoS[] =  "data_inicio";
			$columnCursoS[] =  "data_final";
			$columnCursoS[] =  "situacao";
			$columnCursoS[] =  "id_candidato";
			
			for ( $i = 0; $i < $qtdCursoS; $i++ ) {
				
				$valueCursoS[$i][] =  "'" . $arr_curso_nome[$i] . "'";
				$valueCursoS[$i][] =  "'" . $arr_curso_cod_tipo[$i] . "'";
				$valueCursoS[$i][] =  "'" . $arr_curso_instituicao[$i] . "'";
				$valueCursoS[$i][] =  "'" . $arr_curso_pais[$i] . "'";
				$valueCursoS[$i][] =  "'" . $arr_curso_estado[$i] . "'";
				$valueCursoS[$i][] =  "'" . mesAnoToDateFormat( $arr_curso_data_inicio[$i] ) . "'";
				$valueCursoS[$i][] =  "'" . mesAnoToDateFormat( $arr_curso_data_final[$i] ) . "'";
				$valueCursoS[$i][] =  "'" . $arr_curso_situacao[$i] . "'";
				$valueCursoS[$i][] =  "'" . $id_candidato . "'";
				
			}
			
		}
		
		if ( $_POST['idioma_nome'] && count( $_POST['idioma_nome'] ) > 0 ) {
	
			$columnIdiomaS[] =  "id_candidato";
			$columnIdiomaS[] =  "cod_idioma";
			$columnIdiomaS[] =  "nivel_leitura";
			$columnIdiomaS[] =  "nivel_escrita";
			$columnIdiomaS[] =  "nivel_conversacao";
			
			$qtdIdiomaS	= count( $_POST['idioma_nome'] );
		
			for ($i = 0; $i < $qtdIdiomaS; $i++) {
				
				if( trim( $_POST['idioma_nome'][$i] ) == "" ||  
					trim( $_POST['idioma_nivel_leitura'][$i] ) == "" ||
					trim( $_POST['idioma_nivel_escrita'][$i] ) == "" ||
					trim( $_POST['idioma_nivel_conversacao'][$i] ) == "" 
				){
					
					continue;
					
				}
				
				$valueIdiomaS[$i][] = $id_candidato;
				
				$valueIdiomaS[$i][] = $_POST['idioma_nome'][$i];
				
				$valueIdiomaS[$i][] = $_POST['idioma_nivel_leitura'][$i];
				
				$valueIdiomaS[$i][] = $_POST['idioma_nivel_escrita'][$i];
				
				$valueIdiomaS[$i][] = $_POST['idioma_nivel_conversacao'][$i];
				
			}
			
		}
	
		if ( isPost( 'primeiro_emprego' ) && $_POST['primeiro_emprego'] == 2 ) {
				
			$qtdEmpregoS = $_POST['hiddenExperienciaS'];
				
			for ($i = 1; $i <= $qtdEmpregoS; $i++) {

				if ( isPost( 'experiencia_empresa'.$i ) ) {
					$valueEmprego[]="empresa='" . getNomeTratado($_POST['experiencia_empresa'.$i]) . "'";
				}
	
				if ( isPost( 'experiencia_cargo'.$i ) ) {
					$valueEmprego[]="cargo='" . getNomeTratado($_POST['experiencia_cargo'.$i]) . "'";
				}
	
				if ( isPost( 'experiencia_salario'.$i ) ) {
					$valueEmprego[]="salario='" . formatarMoeda( $_POST['experiencia_salario'.$i], 'php' ). "'";
				}
	
				if ( isPost( 'experiencia_atual'.$i ) && $_POST['experiencia_atual'.$i] == 1 ) {
					$valueEmprego[]="atual= b'1'";
	
				} else {
	
					if ( isPost( 'experiencia_data_admissao'.$i ) ) {
						$valueEmprego[]="data_admissao='" . dateFormat('Y-m-d', "00/" . $_POST['experiencia_data_admissao'.$i]) . " 00:00:00'";
					}
						
					if ( isPost( 'experiencia_data_demissao'.$i ) ) {
						$valueEmprego[]="data_demissao='" . dateFormat('Y-m-d', "00/" . $_POST['experiencia_data_demissao'.$i]) . " 00:00:00'";
					}
	
				}
	
				if ( isPost( 'experiencia_motivo_demissao'.$i ) ) {
					$valueEmprego[]="motivo_demissao='" . $_POST['experiencia_motivo_demissao'.$i]. "'";
				}
	
				if ( isPost( 'experiencia_atividades'.$i ) ) {
					$valueEmprego[]="atividades='" . $_POST['experiencia_atividades'.$i]. "'";
				}
	
				if ( isPost( 'experiencia_nome_gestor'.$i ) ) {
					$valueEmprego[]="nome_antigo_gestor='" . $_POST['experiencia_nome_gestor'.$i]. "'";
				}
	
				if ( isPost( 'experiencia_contato_gestor'.$i ) ) {
					$valueEmprego[]="contato_antigo_gestor='" . $_POST['experiencia_contato_gestor'.$i]. "'";
				}
				
			}
			
		}

		updateCollS("candidato", $values, $id_candidato);
		
		if( $qtdCursoS > 0 ){
			
			run( "DELETE FROM curso WHERE id_candidato = " . $id_candidato );
			
			foreach ($valueCursoS as $curso){
				
				save("curso", $columnCursoS, $curso);
				
			}
		
		}
		
		run( "DELETE FROM idioma WHERE id_candidato = " . $id_candidato );
		
		foreach ( $valueIdiomaS as $idioma ){
	
			save("idioma", $columnIdiomaS, $idioma);
	
		}
		
		updateCollS("experiencia", $valueEmprego, $id_candidato); 
		
	}
