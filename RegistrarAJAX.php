<?php
		
$nick=$_POST['username'];
$password=$_POST['pass1'];
$password2=$_POST['pass2'];
$correo=$_POST['email'];		

//VALIDACIONES!

function validarNick($nick){
    
 if(strlen($nick)<3){
        return false;
    }
    return true;
}
function passMIN1($password){
	if(strlen($password)<6){
       		return false; 
    }
	return true;
}

function passIgual($password,$password2){
	if($password != $password2){
       		return false; 
    }
	return true;
}
function correo($correo){
    //HAY QUE CAMBIAR ESTO !!!!!!!
    
	$expRegu = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
	return preg_match($expRegu, $correo);
}
//COMPROBACIONES
if(validarNick($nick) == false){
	echo "El nombre de usuario introducido no es valido, minimo necesita 3 caracteres.";
  exit;
}
if(passMIN1($password) == false){
	echo "La contraseña tiene que tener minimo 6 caracteres.";
  exit;
}

if(passIgual($password, $password2) == false){
	echo "Las contraseñas no coinciden, tiene que ser iguales.";
  exit;
}
if(correo($correo) == false){
	echo "El email introducido no es válido, tiene que ser similar a ejemplo@servidor.com.";
  exit;
}

//if (isset($_POST['Correo'])&& empty($_POST['Correo']))  {
//	echo "<script>window.location= 'Registrar.html'</script>";
//	echo "<script type='text/javascript'>alert('El email introducido no es válido, tiene que ser similar a ejemplo@servidor.com');</script>";
  //exit;
//} 

//Introducir datos al xml		
		
		
  $xml = simplexml_load_file('usuarios.xml');
  foreach($xml->children() as $user){
	  if($user->email == $_POST["email"]){
		echo "Ese email ya esta registrado.";
		die();
	  }
	  if($user->nick == $_POST["username"]){
		echo "Ese nombre de usuario ya esta registrado.";
		die();
	  }
  }
  $xml->attributes()->ult_id=$xml->attributes()->ult_id+1;
  $nuevo = $xml->addChild('user');
  $nuevo->addAttribute('id', $xml['ult_id']);;
  $nuevo->addChild('nick',$_POST["username"]);
  $nuevo->addChild('pass',$_POST["pass1"]);
  $nuevo->addChild('email',$_POST["email"]);
  
  $domxml = new DOMDocument('1.0');
  $domxml->preserveWhiteSpace = false;
  $domxml->formatOutput = true;
  $domxml->loadXML($xml->asXML());
  $domxml->save('usuarios.xml');
  
  $xml = simplexml_load_file('fotos.xml');
  $nuevo = $xml->addChild('user');
  $nuevo->addAttribute('email', $_POST["email"]);
  
  $domxml = new DOMDocument('1.0');
  $domxml->preserveWhiteSpace = false;
  $domxml->formatOutput = true;
  $domxml->loadXML($xml->asXML());
  $domxml->save('fotos.xml');
  
  echo "Usuario registrado correctamente";
				
				
?>