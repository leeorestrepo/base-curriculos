 <?php
// if( $_SERVER["HTTP_HOST"] == "localhost" || $_SERVER["HTTP_HOST"] == "172.16.122.234"){

	require_once('../config.php');
	
// }else{
	
// 	require_once('http://www.empresa.com.br/config.php');

// }

require_once (DBAPI);

class Candidato {
	
	private $id;
	private $nome;
	private $cpf;
	private $senha;
	private $data_nasc;
	private $sexo;
	private $estado_civil;
	private $filhos;
	private $observacoes_rh;
	private $avaliacao_rh;
	private $status_avaliacao;
	private $data_avaliacao;
	private $usuario_avaliou;
	
	function Candidato ( $id ) {
		$found = find('candidato', $id);
		
		$this->id = $found['id'];
		$this->nome = $found['nome'];
		$this->cpf = $found['cpf'];
		$this->senha = $found['senha'];
		$this->data_nasc= $found['data_nasc'];
		$this->sexo = $found['sexo'];
		$this->estado_civil = $found['estado_civil'];
		$this->filhos= $found['filhos'];
		$this->observacoes_rh = $found['observacoes_rh'];
		$this->avaliacao_rh = $found['avaliacao_rh'];
		$this->status_avaliacao = $found['status_avaliacao'];
		$this->data_avaliacao = $found['data_avaliacao'];
		$this->usuario_avaliou = $found['usuario_avaliou'];
	}
	
	function getAllInfos( $id ) {
		return find('candidato', $id);
	}
	
	function getId(){
		return $this->id;
	}
	
	function getNome(){
		return $this->nome;
	}
	
	function getCPF() {
		return $this->cpf;
	}
	
	function getSenha() {
		return $this->senha;
	}
	
	function getDataNasc() {
		return $this->data_nasc;
	}
	
	function getSexo() {
		return $this->sexo;
	}
	
	function getEstadoCivil() {
		return $this->estado_civil;
	}
	
	function getFilhos() {
		return $this->filhos;
	}
	
	function getObservacoes() {
		return $this->observacoes_rh;
	}
	
	function getAvaliacao() {
		return $this->avaliacao_rh;
	}
	
	function getStatus() {
		return $this->status_avaliacao;
	}
	
	function getDataAvaliacao() {
		return $this->data_avaliacao;
	}
	
	function getQuemAvaliou() {
		return $this->usuario_avaliou;
	}
	
	
	function setSenha( $senha ){
		$action = update('candidato', "senha = '$senha'", $this->id);
		
		if ( $action ) {
			$_SESSION ['message'] = 'Senha atualizada com sucesso.';
			$_SESSION ['type'] = 'success';
		}
	}
}


global $cargoS;
$cargoS = find_all ( 'cargo', 'nome ASC' );

global $setoreS;
$setoreS = find_all ( 'setor', 'nome ASC' );

function edit($id) {
	
	global $candidato;
	$candidato = find('candidato', $id);
	
	global $idiomaS;
	$idiomaS = findTableS('idioma', $id, 'id_candidato');
	
	global $empregoS;
	$empregoS = findTableS('experiencia', $id, 'id_candidato');
	
	global $refProfissionalS;
	$refProfissionalS = findTableS('ref_profissional', $id, 'id_cadastro');
	
	global $cursoS;
	$cursoS = findTableS('curso', $id, 'id_candidato');

}

function view($id = null) {

	global $candidato;
	$candidato = find('candidato', $id);
	
	global $idiomaS;
	$idiomaS = findTableS('idioma', $id, 'id_candidato');
	
	global $empregoS;
	$empregoS = findTableS('experiencia', $id, 'id_candidato');

	global $refProfissionalS;
	$refProfissionalS = findTableS('ref_profissional', $id, 'id_cadastro');
	
	global $cursoS;
	$cursoS = findTableS('curso', $id, 'id_candidato');
	
}

function atribuiPOST( $var, $session = false ){
	
	if( isset( $_POST[ $var ] ) && ( strlen( trim( $_POST[ $var ] ) ) > 0 ) ){
		
		if( $session == true ){
			
			$_SESSION[$var] = trim( $_POST[ $var ] );
			
		}
		
		return trim( $_POST[ $var ] );
		
	}
	
	return "";
	
}

function mesAnoToDateFormat( $mesAno ){
	
	$arrMesAno = explode("/", $mesAno);
	
	return "20".$arrMesAno[1]."-".$arrMesAno[0]."-01 00:01:00";
	
}

/**
 * TO DATE FORMAT FOR INCLUSE DATABASE IN FORMAT YYYY-MM-DD HH:MM:SS
 * @param unknown $mesAno
 * @return string
 */
function dateFormatToMesAno( $_dateFormat ){

	$_dateFormat = str_replace("201", "1", $_dateFormat);
	$_dateFormat = str_replace("202", "2", $_dateFormat);

	$arrDataHora = explode(" ", $_dateFormat);
	
	$arrAnoMesDia = explode("-",$arrDataHora[0]);
	
	return $arrAnoMesDia[1]."/".$arrAnoMesDia[0];

}

function getStrCursoSituacao($cursoSituacao){
	$strCursoSituacao = "Concluído";
	if( $strCursoSituacao == "2" ) $strCursoSituacao = "Cursando";
	if( $strCursoSituacao == "3" ) $strCursoSituacao = "Interrompido";
	return $strCursoSituacao;
} 

function printR($arr){
	echo "<pre>";
	print_r($arr);
	echo "<pre>";
	echo "<hr>";
}

function isPost($key){
	if( isset( $_POST[$key] ) ){
		if( empty( $_POST[$key] ) == false ){
			return true;
		}
	}
	return false;
}

?>