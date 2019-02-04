<?php
	if(strlen($_POST['asunto'])<4){
		echo "El asunto debe tener al menos 4 caracteres.";
		die();
	}
	if(strlen($_POST['mensaje'])<4){
		echo "El mensaje debe tener al menos 4 caracteres.";
		die();
	}
	
	$xml = simplexml_load_file('mensajes.xml');
	$xml->attributes()->ult_id=$xml->attributes()->ult_id+1;
	$nuevo = $xml->addChild('mensaje');
	$nuevo->addAttribute('id', $xml['ult_id']);;
	$nuevo->addChild('nick',$_POST["username"]);
	$nuevo->addChild('email',$_POST["email"]);
	$nuevo->addChild('asunto',$_POST["asunto"]);
	$nuevo->addChild('mensaje',$_POST["mensaje"]);
	
	$domxml = new DOMDocument('1.0');
	$domxml->preserveWhiteSpace = false;
	$domxml->formatOutput = true;
	$domxml->loadXML($xml->asXML());
	$domxml->save('mensajes.xml');
  
	echo "Mensaje enviado correctamente";
?>