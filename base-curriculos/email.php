<?php

require_once 'EmailList.php';
require_once 'smtp/smtp.php';

function sendMail( $destino, $corpo, $assunto, $tentativa = 0 ){

	$smtp		= EmailList::$smtpServerMail;

	$usuario	= EmailList::$rh;

	$senha		= EmailList::$rhSenha;

	$mail		= new SMTP;

	$mail->Delivery('relay');

	$mail->Relay( $smtp, $usuario, $senha, EmailList::$smtpPort, 'login', false );

	$mail->TimeOut( 20 );

	$mail->Priority( 'high' );

	$mail->From( $usuario, 'Empresa | Recursos Humanos');

	$mail->addto( $destino );

	$mail->Html( $corpo );
	
	if( $mail->Send( $assunto )){

		return true;

	} else if( $tentativa < 3 ) {

		sendMail( $destino, $corpo, $assunto, ( $tentativa + 1 ) ); // TRES TENTATIVAS 

	} else if( $tentativa == 3 ) {

		sendMail( EmailList::$desenvolvimento, $corpo . " [LOG ERROR - MENSAGEM NAO ENVIADA EM 3 TENTATIVAS PARA " . $destino . "]", $assunto, 4 ); 

	}

	return false;
}