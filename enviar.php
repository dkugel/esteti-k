<?php    
    

	if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
	// Realizamos la petición de control: 
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
	$recaptcha_secret = '6LcuKMoUAAAAAP5eDDWb7XhgV9iK84VfRvHJ8Vdk'; 
	$recaptcha_response = $_POST['recaptcha_response']; 
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
	$recaptcha = json_decode($recaptcha); 
	// Miramos si se considera humano o robot: 
	if($recaptcha->score >= 0.6){		
		$name = isset($_POST['name2'])? $_POST['name2'] : NULL;
		$email = isset($_POST['email'])? $_POST['email'] : NULL;
		$phone = isset($_POST['tel'])? $_POST['tel'] : NULL;
		$asunto = isset($_POST['subject'])? $_POST['subject'] : NULL;
		$message = isset($_POST['comment'])? $_POST['comment'] : NULL;
		
		//$captcha = $_POST['codigo'];
		
		
		$para = 'director@esteti-kdigital.com';
		$titulo = 'Nuevo contacto Web';
		$header = 'From: ' .$email;    
		$cuerpo  = "Nombre: $name\n";
		$cuerpo .= "E-Mail: $email\n";
		$cuerpo .= "Telefono: $phone\n";
		$cuerpo .= "Asunto: $asunto\n";
		$cuerpo .= "Mensaje: $message\n";
		
			
			
		// Es un usuario real, proceder a enviar el formulario.
		if (mail($para, $titulo, $cuerpo, $header)) {
			echo "<script language='javascript'>
			alert('Mensaje enviado, muchas gracias.');
			window.location.href = 'http://www.esteti-kdigital.com/';
			</script>";
			}
		else {
			echo 'Falló el envio';
		}		
	}else{
		echo 'Error de validación.';
	}

	}

	
    	
						
	
	
	

	
	
	
	
	
	
	
	
       
        
       
?>