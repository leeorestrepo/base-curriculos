<?php 
require_once('functions.php');
include(HEADER_TEMPLATE);
@session_start();
$db = open_database();

$id = $_GET["id"];
$candidato = find('candidato', $id);
$empregoS = findTableS('experiencia', $id, 'id_candidato', 'ORDER BY data_admissao DESC');

if( isset( $_POST ) && isset($_POST ['nome_empresa']) && strlen($_POST ['nome_empresa']) > 0){
	
	$values = Array();
	$columns = Array('nome_empresa','nome_contato','motivo_desligamento', 'funcao', 'qtd_mes', 'ponto_fraco', 'ponto_forte', 'responsabilidade', 
			'pontualidade', 'contrataria_novamente', 'id_cadastro');
	
	$values[] = $_POST ['nome_empresa']  ;
	$values[] = $_POST ['nome_contato']  ;
	$values[] = $_POST ['motivo_desligamento']  ;
	$values[] = $_POST ['funcao']  ;
	$values[] = $_POST ['qtd_mes']  ;
	$values[] = $_POST ['ponto_fraco']  ;
	$values[] = $_POST ['ponto_forte']  ;
	$values[] = $_POST ['responsabilidade']  ;
	$values[] = $_POST ['pontualidade']  ;
	$values[] = $_POST ['contrataria_novamente']  ;
	$values[] = $id  ;
	
	run( "DELETE FROM ref_profissional WHERE id_cadastro = " . $id );
	
	if( save("ref_profissional", $columns, $values) ){
		
		echo "<script>window.location.replace('".BASEURL.'/candidato/curriculo.php?id='.$id."');</script>";
		
		exit();
		
	}

	/*
	$refProfissional = findTableS('ref_profissional', $id, 'id_cadastro');*/
	//printR( $refProfissional );
}

?>

<script type="text/javascript">

/* $( document ).ready(function() {

}); */

function enviar(){

	if( min('nome_empresa', 2) == false ){

		alert('Por favor informe o campo nome_empresa com, no mínimo, 2 caracteres. ' );

		evidenciar("#nome_empresa");

		return;
		
	}
	
	if( min('nome_contato', 3) == false ){

		alert('Por favor informe o campo nome_contato com, no mínimo, 3 caracteres. ' );

		evidenciar("#nome_contato");

		return;
		
	}
	
	if( min('motivo_desligamento', 5) == false ){

		alert('Por favor informe o campo motivo_desligamento com, no mínimo, 5 caracteres. ' );

		evidenciar("#motivo_desligamento");

		return;
		
	}


	if( min('funcao', 3) == false ){

		alert('Por favor informe o campo funcao com, no mínimo, 3 caracteres. ' );

		evidenciar("#funcao");

		return;
		
	}

	if( min('qtd_mes', 1) == false ){

		alert('Por favor informe o campo qtd_mes com, no mínimo, 1 caracter. ' );

		evidenciar("#qtd_mes");

		return;
		
	}

	if( min('ponto_fraco', 5) == false ){

		alert('Por favor informe o campo ponto_fraco com, no mínimo, 5 caracteres. ' );

		evidenciar("#ponto_fraco");

		return;
		
	}

	if( min('ponto_forte', 5) == false ){

		alert('Por favor informe o campo ponto_forte com, no mínimo, 5 caracteres. ' );

		evidenciar("#ponto_forte");

		return;
		
	}

	if( min('responsabilidade', 5) == false ){

		alert('Por favor informe o campo responsabilidade com, no mínimo, 5 caracteres. ' );

		evidenciar("#responsabilidade");

		return;
		
	}

	if( min('pontualidade', 5) == false ){

		alert('Por favor informe o campo pontualidade com, no mínimo, 5 caracteres. ' );

		evidenciar("#pontualidade");

		return;
		
	}

	if( min('contrataria_novamente', 1) == false ){

		alert('Por favor informe o campo contrataria_novamente, selecionando a opção que se enquadra ao candidato. ' );

		evidenciar("#contrataria_novamente");

		return;
		
	}
	
	$("#formRefProfissional").submit();
	
	
}

</script>

<meta name="viewport" content="width=device-width, initial-scale=1"> 

<link rel="stylesheet" href="<?php echo BASEURL;?>vendor/w3/css/w3.css"> 

<div class="w3-row w3-border">
  	
	<div class="w3-quarter w3-container">
       
      <h4><b class="w3-text-teal"><?php echo $candidato["nome"]?></b></h4>
      CPF: <?php echo $candidato["cpf"]?>
      <br>

  
  </div>
  
  <div class="w3-threequarter s9 w3-container">
   	<div class="w3-left-align" word-wrap="break-word";>
   	
	<form method="POST" action="ref_prof.php?id=<?php echo $id;?>" method="post" id="formRefProfissional">
   		
   		<br><p>Nome da Empresa:</p>
   		<textarea rows="2" cols="50" name="nome_empresa" id="nome_empresa" ></textarea> <br>
   		
   		<p>Nome do Contato:</p>
   		<textarea rows="2" cols="50" name="nome_contato" id="nome_contato" ></textarea> <br><br>
   		
   		<h4><b>Questionário: </b></h4><br>
   		
   		<p>1) Qual foi o motivo do desligamento do colaborador?</p>
  	    <textarea rows="3" cols="50" name="motivo_desligamento" id="motivo_desligamento" ></textarea> <br>
  	    
  	    <br><p>2) Qual função o colaborador desempenhou?</p>
  	    <textarea rows="3" cols="50" name="funcao" id="funcao" ></textarea> <br>
  	    
  	    <br><p>3) Durante quanto tempo o colaborador desempenhou a função?</p>  	    
		<textarea rows="3" cols="50" name="qtd_mes" id="qtd_mes" ></textarea> <br>
  	    
  	    <br><p>4) Qual seria o ponto fraco do colaborador?</p>
  	    <textarea rows="3" cols="50" name="ponto_fraco" id="ponto_fraco" ></textarea> <br>
  	    
  	    <br><p>5) Qual seria o ponto forte do colaborador?</p>
  	    <textarea rows="3" cols="50" name="ponto_forte" id="ponto_forte" ></textarea> <br>
  	    
  	    <br><p>6) Como classifica o colaborador em termos de responsabilidade e pontualidade? 
  	    <br>(Abaixo, Média ou Acima da Média)</p>
  	    
  	    <br>Responsabilidade: <br>
  	    <textarea rows="3" cols="50" name="responsabilidade" id="responsabilidade" ></textarea> <br>
  	   
  	    <br>Pontualidade: <br> 
  	    <textarea rows="3" cols="50" name="pontualidade" id="pontualidade" ></textarea> <br>
  	    
  	    <br><p>7) Contrataria o colaborador novamente?</p>
  	    	
  	    	<input type="radio" name="contrataria_novamente" id="contrataria_novamente" value="1"> Sim<br>
  			<input type="radio" name="contrataria_novamente" id="contrataria_novamente" value="0"> Não<br> 
  	    	
  	    <br>
  	    
  	    <br>
  	    
  	    <div class="modal-footer">
					<button type="button" class="btn btn-info" onclick="enviar()">Salvar</button>
					<a href="<?php echo BASEURL.'candidato/curriculo.php?id='.$id  ?>" class="btn btn-default">Cancelar</a>
				</div>
  	    </form>
  </div>
  </div>
</div>
	
<?php 


include(FOOTER_TEMPLATE); ?>
