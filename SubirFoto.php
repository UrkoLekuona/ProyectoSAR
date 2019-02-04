<?php
	session_start();
	
	$xml = simplexml_load_file('fotos.xml');
	$xml->attributes()->ult_id=$xml->attributes()->ult_id-1;
	$id = $xml["ult_id"];
	
	if (isset($_FILES["imagen"]) && ( $_FILES["imagen"]["type"]=="image/jpeg" || $_FILES["imagen"]["type"]=="image/png" || $_FILES["imagen"]["type"]=="image/jpg")){
		$origen=$_FILES["imagen"]["tmp_name"]; 
		$imagen=$id."_".$_FILES["imagen"]["name"];
		move_uploaded_file($origen, "./images/galeria/".$imagen);
		
		$users = $xml->xpath('//user[@email="'. $_SESSION["email"].'"]');
			if (count($users)>=1) {
				$user=$users[0];
				$user->addChild('imagen', $imagen);
				
				$domxml = new DOMDocument('1.0');
				$domxml->preserveWhiteSpace = false;
				$domxml->formatOutput = true;
				$domxml->loadXML($xml->asXML());
				$domxml->save('fotos.xml');
			}
		echo "Imagen guardada correctamente";
		die();
	}
	echo "Error al subir la imagen";
?>