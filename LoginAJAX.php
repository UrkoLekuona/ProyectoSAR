<?php 
	session_start();
	
	$xml = simplexml_load_file('usuarios.xml');
	foreach($xml->children() as $user){
		if($user->nick == $_POST["username"] && $user->pass == $_POST["pass"]){
			$_SESSION["user"]=(string)$user->nick;
			$_SESSION["pass"]=(string)$user->pass;
			$_SESSION["email"]=(string)$user->email;
			
			echo "Nick: ".$_SESSION['user'];
			die();
		}
	}
	echo "Parámetros de login incorrectos";
?>