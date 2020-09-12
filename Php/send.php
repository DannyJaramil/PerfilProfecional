	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			img[alt="www.000webhost.com"] {
				display: none;
			}
		</style>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
	</head>

	<body>
		<?php

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require $_SERVER['DOCUMENT_ROOT'] . '/Php/Exception.php';
		require $_SERVER['DOCUMENT_ROOT'] . '/Php/PHPMailer.php';
		require $_SERVER['DOCUMENT_ROOT'] . '/Php/SMTP.php';
		require $_SERVER['DOCUMENT_ROOT'] . '/Php/OAuth.php';

		$mail = new PHPMailer(true);
		$mail->CharSet = 'UTF-8';
			
		$name = $_POST['name'];
		$telefono = $_POST['tel'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		try {
			$mail->isSMTP();
			$mail->Host = 'smtp.mail.yahoo.com'; // Host de conexión SMTP
			$mail->SMTPAuth = true;
			$mail->Username = 'miportafoliomvg@yahoo.com'; // Usuario SMTP
			$mail->Password = 'keyxgtkjokvtfgsm'; // Password SMTP
			$mail->SMTPSecure = 'tls'; // Activar seguridad TLS
			$mail->Port = 587; // Puerto SMTP

			$mail->setFrom('miportafoliomvg@yahoo.com', 'Mi portafolio');
			$mail->IsHTML(true);
			$mail->addAddress($email);

			$mail->Subject = 'Alguien necesita tus servicios | Mi portafolio';
			$mail->Body = '<html>
<center>

	<body>
		<h3>Hola Mateo!</h3>
		<br>
		<span> Alguien ha enviado un mensaje desde tu portafolio, esta es la info: </span>
		<br><br>
		<h4>Nombre: </h4><span> '. $name .'</span>
		<br>
		<h4>Teléfono: </h4><span> '. $telefono .'</span>
		<br>
		<h4>Correo electrónico: </h4><span> '. $email .'</span>
		<br>
		<h4>Mensaje: </h4><span> '. $message .'</span>
	</body>

</html>';
			$mail->AltBody = "Usted esta viendo este mensaje simple debido a que su servidor de correo no admite formato HTML.";
			$mail->send()
		?>
			<script>
				Swal.fire({
					icon: "success",
					title: "Gracias por contactarme, pronto recibirás una respuesta!",					
					allowEscapeKey: false,
					allowOutsideClick: false,
					showConfirmButton: false,
					allowEnterKey: false,
				});
			</script>
		<?php
		} catch (Exception $e) {
		?>
			<script>
				Swal.fire({
					icon: "error",
					title: "Ocurrió un error al enviar el mensaje, por favor avisa que esto está pasando",
					allowEscapeKey: false,
					allowOutsideClick: false,
					showConfirmButton: false,
					allowEnterKey: false,
					html: "<br><a href='mailto:angelmateovanegasgiraldo@gmail.com' target='_blank'>Avisar</a>"
				});
			</script>
		<?php
		}
		?>
	</body>