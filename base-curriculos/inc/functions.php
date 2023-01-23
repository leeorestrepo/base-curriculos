<?php
function getCriptografado( $tamanho, $texto = null ) {
	
	if (strlen( $texto ) > 0) return substr( md5( $texto ), 0, $tamanho );
	else return substr( md5( time() ), 0, $tamanho );
}

function getInfos( $id ) {
	return find('candidato', $id);
}

function getIdade( $data_nasc ) {
	$data = new DateTime( $data_nasc ); // data e hora de nascimento
	$intervalo = $data->diff( new DateTime( ) ); // data e hora atual
	return $intervalo->format('%Y');
}

function getCargo( $id ) {
	$cargo =  findTableS('cargo', $id);
	return $cargo['nome'];
}

function getSetor( $id ) {
	$setor = findTableS('setor', $id);
	return $setor['nome'];
}

function atribuiGET( $var, $session = false ){
	if( isset( $_POST[ $var ] ) && ( strlen( trim( $_POST[ $var ] ) ) > 0 ) ){
		if( $session == true ){
			$_SESSION[$var] = trim( $_POST[ $var ] );
		}
		return trim( $_POST[ $var ] );
	}
	return "";
}

function formatarMoeda($get_valor, $from) {
	
	if ($from == 'php') {
		$source = array('.', ',');
		$replace = array('', '.');
		$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
	} else if ($from == 'sql') {
		$valor = number_format($get_valor, 2, ',', '.');
	}
	
	return $valor; //retorna o valor formatado para gravar no banco
	
}

function getUrlContent($content) {
	if ( strpos($_SERVER ['REQUEST_URI'], $content ) ) return true;
	else return false;
}

function dateFormat($format, $data) {
	$timestamp = strtotime(str_replace('/', '.', $data));
	return date($format, $timestamp);
}

function getNome($nome_completo){
	$partes = explode(' ', $nome_completo);
	return array_shift($partes);
}

function getSobrenome($nome_completo){
	
	$partes = explode(' ', $nome_completo);
	return array_pop($partes);
}

function getNomeTratado($nome) {
	$nome = mb_strtolower($nome, 'utf-8'); // Converter o nome todo para minúsculo
	$nome = explode(" ", $nome); // Separa o nome por espaços
	$saida = "";
	for ($i=0; $i < count($nome); $i++) {
		
		// Tratar cada palavra do nome
		if ($nome[$i] == "de" or $nome[$i] == "da" or $nome[$i] == "e" or $nome[$i] == "dos" or $nome[$i] == "do" or $nome[$i] == "em") {
			$saida .= $nome[$i].' '; // Se a palavra estiver dentro das complementares mostrar toda em minúsculo
		}else {
			$saida .= ucfirst($nome[$i]).' '; // Se for um nome, mostrar a primeira letra maiúscula
		}
		
	}
	return trim($saida);
}

// Remove da variavel os caracteres informados na sintaxe.
function removeMask($valor) {
	$valor = trim ( $valor );
	$valor = str_replace ( ".", "", $valor ); // .
	$valor = str_replace ( ",", "", $valor ); // ,
	$valor = str_replace ( "-", "", $valor ); // -
	$valor = str_replace ( "/", "", $valor ); // /
	$valor = str_replace ( "(", "", $valor ); // (
	$valor = str_replace ( ")", "", $valor ); // )
	$valor = str_replace ( " ", "", $valor ); // Espaço
	return $valor;
}

function mask ( $val, $mask ){
	$maskared = '';
	$k = 0;
	
	for( $i = 0; $i <= strlen($mask)-1; $i++ ) {
		if( $mask[$i] == '#' ) {
			if(isset($val[$k])) $maskared .= $val[$k++];
		} else {
			if(isset($mask[$i])) $maskared .= $mask[$i];
		}
	}
	return $maskared;
}

// Verifica se e-mail é um possível e-mail válido...
function checkMail($email) {
	$sintaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
	if (preg_match ( $sintaxe, $email ))
		return true;
	else
		return false;
}


// // Cadastro
// if (@$_GET ['go'] == 'cad') {
// 	$username = $_POST ['username'];
// 	$password = $_POST ['password'];
// 	$email = $_POST ['email'];
// 	$_cpf = $_POST ['cpf'];
// 	$_tel = $_POST ['tel'];
// 	$cpf = removeMask ( $_cpf );
// 	$tel = removeMask ( $_tel );
	
// 	if (empty ( $username )) {
// 		echo "<script>document.getElementById('#username').borderColor = 'red';</script>";
// 	} else if (empty ( $email && checkMail ( $email ) )) {
// 		echo "<script>document.getElementById('#email').borderColor = 'red';</script>";
// 	} elseif (empty ( $password )) {
// 		echo "<script>document.getElementById('#password').borderColor = 'red';</script>";
// 	} elseif (empty ( $cpf )) {
// 		echo "<script>document.getElementById('#cpf').borderColor = 'red';</script>";
// 	} else if (empty ( $tel )) {
// 		echo "<script>document.getElementById('#tel').borderColor = 'red';</script>";
// 	} else {
		
// 		$query1 = mysql_num_rows ( mysql_query ( "SELECT * FROM candidato WHERE cpf = '$cpf'" ) );
// 		if ($query1 == 1) {
// 			echo "<script>alert('CPF já cadastrado.'); history.back();</script>";
// 		} else {
// 			$query_insert = mysql_query ( "INSERT INTO candidato (nome, email, senha, cpf, tel) VALUES ('$username','$email','$password', '$cpf', '$tel')" );
// 			echo "<script>alert('Cadastro efetuado com sucesso.'); history.back();</script>";
// 		}
// 	}
// }