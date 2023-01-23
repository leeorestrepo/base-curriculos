<?php

if( $_SERVER["HTTP_HOST"] == "localhost"){
	
// 	define ( 'DB_NAME', 'base-curriculos');
	
// 	define ( 'DB_USER', 'root' );
	
// 	define ( 'DB_PASSWORD', '' );
	
// 	define ( 'DB_HOST', 'localhost' );
	
	define ( 'DB_NAME', 'base-curriculos' );
	
	define ( 'DB_USER', 'root' );
	
	define ( 'DB_PASSWORD', '' );
	
	define ( 'DB_HOST', 'localhost' );
	
	if (! defined ( 'BASEURL' ))
		define( "BASEURL", "/base-curriculos/");
	
 }else{

 	define ( 'DB_NAME', '' );
	
	define ( 'DB_USER', '' );
	
	define ( 'DB_PASSWORD', '' );
	
	define ( 'DB_HOST', '' );
	
	define( "BASEURL", "" );
	
 }

if (! defined ( 'ABSPATH' ))
	define ( 'ABSPATH', dirname ( __FILE__ ) . '/' );
			
		if (! defined ( 'DBAPI' ))
			define ( 'DBAPI', ABSPATH . 'inc/database.php' );
			
			define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
			define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
			define('FUNCTIONS', ABSPATH . 'inc/functions.php');
			define('EMAILS', ABSPATH . 'email.php');
			define('NOTFOUND', ABSPATH . 'inc/notfound.php');
			
			define('VERSION', 'v.1.2');
			
?>