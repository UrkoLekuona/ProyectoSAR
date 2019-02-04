<?php
	session_start();
?>
<html>
	<head>
	<script src="lib/jquery-3.2.1.min.js"></script>
	<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<style>html, body {
		  border: 0;
		  padding: 0;
		  margin: 0;
		  height: 100%;
		}

		body {
		  background: white;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		  font-size: 16px;
		}

		form {
		  background: white;
		  width: 40%;
		  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.7);
		  font-family: lato;
		  position: relative;
		  color: #333;
		  border-radius: 10px;
		}
		form header {	
		  background: #0040ff;
		  padding: 30px 20px;
		  color: white;
		  font-size: 1.7em;
		  font-weight: 600;
		  border-radius: 10px 10px 0 0;
		}
		form label {
		  margin-left: 20px;
		  display: inline-block;
		  margin-top: 30px;
		  margin-bottom: 5px;
		  position: relative;
		}
		form input {
		  display: block;
		  width: 85%;
		  margin-left: 20px;
		  padding: 5px 20px;
		  font-size: 1em;
		  border-radius: 3px;
		  outline: none;
		  border: 1px solid #ccc;
		}
		form button {
		  position: relative;
		  margin-top: 30px;
		  margin-bottom: 40px;
		  left: 55%;
		  #transform: translate(-50%, 0);
		  font-family: inherit;
		  color: white;
		  background: #0040ff;
		  outline: none;
		  border: none;
		  padding: 5px 15px;
		  font-size: 1.3em;
		  font-weight: 400;
		  border-radius: 3px;
		  box-shadow: 0px 0px 10px rgba(51, 51, 51, 0.4);
		  cursor: pointer;
		  transition: all 0.15s ease-in-out;
		}
		form button:hover {
		  background: #4d79ff;
		}
		form a{
		  position: relative;
		  margin-bottom: 5px;
		  float: center;
		  margin-right:2em;
		}"
		</style>
	</head>
	<body style="background-image:url('./images/lg_bg.jpg');background-size: 100% 100%"> 
		<body>
		<form action="Registrar.php" method="post">
		  <header>Registrar</header>
		  <label>Nombre Usuario</label>
		  <input id="username" name="username"/>
		  <label>Email</label>
		  <input id="email" name="email"/>
		  <label>Contraseña</label>
		  <input id="pass1" type= "password" name="pass1"/>
		  <label>Repetir contraseña</label>
		  <input  id="pass2" type= "password" name="pass2"/>
		  <button id="boton" type="button">Registrarse</button>
		
		 <a href="Login.php">¿Ya estas registrado?</a>
		</form>
		<script>
			$("#boton").click(function(){
				var username = $("#username").val();
				var email = $("#email").val();
				var pass1 = $("#pass1").val();
				var pass2 = $("#pass2").val();
				$.ajax({
					type: "POST",
					cache : false,
					url: 'RegistrarAJAX.php',
					data: { username: username, email: email, pass1: pass1, pass2: pass2},
					success: function(data) {
						alert(data);
						if(data.localeCompare("Usuario registrado correctamente") == 0){
							window.location= 'Login.php';
						}
					},
				});
			});
		</script>
	</body>
</html>