<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

mysqli_report ( MYSQLI_REPORT_STRICT );


function open_database() {
		
	try {
		
		/* echo DB_NAME. "<hr> ";
		
		echo DB_USER. "<hr> ";
		
		echo DB_PASSWORD. "<hr> ";
		
		echo DB_HOST. "<hr> ";
		
		echo BASEURL; */
		
		$conn = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
		mysqli_set_charset($conn,"utf8");
		
		return $conn;
	} catch ( Exception $e ) {
		
		print_r( $e );
		exit();
		
		return null;
	}
}

function run( $sql ) {
	
	$database = open_database ();
	
	try {

		$result = $database->query ( $sql );
			
		return true;

	} catch ( Exception $e ) {

		$_SESSION ['message'] = $e->GetMessage ();

		$_SESSION ['type'] = 'danger';
		
		return false;

	}

	close_database ( $database );
	
}



function close_database($conn) {
	try {
		mysqli_close ( $conn );
	} catch ( Exception $e ) {
		
		//echo $e->getMessage ();

	}
	
}


function select($table, $sql = null) {
	$database = open_database ();
	$found = null;
	
	try {
		
		if (!$sql) {
			
			$sql = "SELECT * FROM " . $table;
			
		}
			
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_all ( MYSQLI_ASSOC ); /* Metodo alternativo $found = array(); while ($row = $result->fetch_assoc()) { array_push($found, $row); } */
				//$found = $result->fetch_assoc ();
			}

	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = $e->GetMessage ();
		
		$_SESSION ['type'] = 'danger';
		
	}
	
	close_database ( $database );
	
	return $found;
}

function selectOne($table, $sql = null) {
	$database = open_database ();
	$found = null;
	
	try {
		
		if (!$sql) {
			
			$sql = "SELECT * FROM " . $table;
			
		}
		
		$result = $database->query ( $sql );
		
		if ($result->num_rows > 0) {
			//$found = $result->fetch_all ( MYSQLI_ASSOC ); /* Metodo alternativo $found = array(); while ($row = $result->fetch_assoc()) { array_push($found, $row); } */
			$found = $result->fetch_assoc ();
		}
		
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = $e->GetMessage ();
		
		$_SESSION ['type'] = 'danger';
		
	}
	
	close_database ( $database );
	
	return $found;
}


/** Pesquisa um Registro pelo ID em uma Tabela **/
function find($table = null, $id = null, $order = null ) {
	$database = open_database ();
	$found = null;
	
	try {
		
		if ($id) {
		
			$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
			
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				
				$found = $result->fetch_assoc ();
				
			}
			
		} else {
			
			$sql = "SELECT * FROM " . $table;
			
			$sql .= " ORDER BY " . ( $order != null ? $order : " id " ) ;
			
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_all ( MYSQLI_ASSOC ); /* Metodo alternativo $found = array(); while ($row = $result->fetch_assoc()) { array_push($found, $row); } */
			}
			
		}
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = $e->GetMessage ();
		
		$_SESSION ['type'] = 'danger';
		
	}
	
	close_database ( $database );
	
	return $found;
}

/** Pesquisa um Registro pelo ID em uma Tabela **/
function findCPF($select, $cpf) {
	$database = open_database ();
	$found = null;
	
	try {
		
		if ($cpf) {
			
			$sql = "SELECT " . $select . " FROM candidato WHERE cpf = " . $cpf;
			$result = $database->query ( $sql );
			
			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc ();
			}
			
		}
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = 'Não foi possivel realizar a operacao, tente novamente.';
		$_SESSION ['type'] = 'danger';
		
	}
	
	close_database ( $database );
	
	return $found;
}

function findCursoS($idCandidato) {
	$database = open_database ();
	$rs = null;
	try {

		$sql = "SELECT * FROM curso WHERE id_candidato = " . $idCandidato;
		
		$result = $database->query ( $sql );
			
		if ($result->num_rows > 0) {
			
			$rs = $result;
			
		}
		
	} catch ( Exception $e ) {

		$_SESSION ['message'] = 'Não foi possivel realizar a operacao, tente novamente.';
		$_SESSION ['type'] = 'danger';

	}

	close_database ( $database );

	return $rs;
	
}

function findTableS($tabela, $id, $where = 'id', $order = null ) {
	
	$database = open_database ();
	$found = null;
	
	try {
		
		if ($id) {
			
			$sql = "SELECT * FROM " . $tabela . " WHERE " . $where . " = " . $id . " " . ( $order != null ? $order : "" ) ;
			
			$result = $database->query ( $sql );

			if ($result->num_rows > 0) {
				
				if ($where == 'id') $found = $result->fetch_assoc ();
				else $found = $result->fetch_all ( MYSQLI_ASSOC ); /* Metodo alternativo $found = array(); while ($row = $result->fetch_assoc()) { array_push($found, $row); } */
			}
			
		}
	} catch ( Exception $e ) {
		
		$_SESSION ['message'] = $e->GetMessage ();
		
		$_SESSION ['type'] = 'danger';
		
	}
	
	close_database ( $database );
	
	return $found;
}


/**  Pesquisa Todos os Registros de uma Tabela **/
function find_all( $table, $order = null ) {
	return find($table, null, $order);
}

function save($table, $columns, $values) {
	$database = open_database ();
	$con = '1';
	$ok;
	
	if( is_array( $columns ) ){

		$_columns = "";
		
			for ( $i=0; $i < count( $columns ); $i++ ){
				
				$_columns .= $columns[$i] . ", ";
				
			}
			
		$_columns = substr($_columns, 0, ( strlen( $_columns ) - 2) );
		
		$columns = $_columns;
		
	}
	
	if( is_array( $values ) ){

		$_values = "";
		
			for ( $i=0; $i < count( $values ); $i++ ){
				
				$_values .= "'".$values[$i] . "', ";
				
			}
			
		$_values = substr($_values, 0, ( strlen( $_values ) - 2) );
		
		$values = $_values;
		
	}
	
	$sql = "INSERT INTO " . $table . " ($columns)" . " VALUES " . "($values);";
	
	/* print_r($sql);
	
	exit();  */
	
	try {
		if( $database->query ( $sql ) == false ){
			$error = "ERRO AO EXECUTAR SQL: " . $sql . "(" . $database->error . ")";
			$_SESSION ['message'] = $error;
			$_SESSION ['type'] = 'danger';
		}
		return true;
	} catch ( Exception $e ) {
		$_SESSION ['message'] = 'Não foi possivel realizar a operacao.';
		$_SESSION ['type'] = 'danger';
	}
	close_database ( $database );
	
	return false;
}

function update($table, $strItenS, $id) {
	$database = open_database ();
	$sql = "UPDATE " . $table;
	$sql .= " SET $strItenS";
	$sql .= " WHERE id = ". $id .";";
	
	ECHO $sql;
	
	try {
		if( $database->query ( $sql ) == false ){
			echo "ERRO AO EXECUTAR SQL: " . $sql;
		}
		return true;
	} catch ( Exception $e ) {
		$_SESSION ['message'] = 'Não foi possivel realizar a operacao.';
		$_SESSION ['type'] = 'danger';
	}
	close_database ( $database );
}

function updateCollS($table, $items, $id) {
	if( is_array($items) && count( $items ) > 0 ){
		$strItenS = "";
		foreach ($items as $item){
			$strItenS .= $item.", ";
		}
		$strItenS = substr($strItenS,0, strlen($strItenS)-2)." ";
		update($table, $strItenS, $id);
	}
	return false;
}

function clear_messages(){

	unset( $_SESSION ['message'] );
	unset( $_SESSION ['type'] );

}