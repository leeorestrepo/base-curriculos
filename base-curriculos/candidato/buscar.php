<?php
require_once('functions.php');
require_once('_optionS.php');

include(HEADER_TEMPLATE);

@session_start();

$db = open_database();

//busca por nome
$candidato_nome = $_POST['candidato_nome'];

echo $candidato_nome;

$result_candidato_nome = "SELECT * FROM candidato WHERE nome LIKE '%$candidato_nome%' LIMIT 10";

$nome = explode(" ", $candidato_nome);

$sobrenome = $nome[1];

$resultado_candidato_nome = mysql_query($db, $result_candidato_nome, $nome, $sobrenome);



//busca por cpf
$candidato_cpf = $_POST['candidato_cpf'];

echo $candidato_cpf;

$result_candidato_cpf = "SELECT * FROM candidato WHERE cpf LIKE '%$candidato_cpf%' = $cpf";

$resultado_candidato_cpf = mysql_query($db, $result_candidato_cpf);

?>