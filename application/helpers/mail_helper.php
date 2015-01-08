<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Cuerpo del Mensaje
**/
if (! function_exists('registro')) 
{
	function registro($correo, $id_usuario)
	{
		$cuerpo = 
			'<html> 
				<head> 
			   		<title>Activación</title> 
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				</head>			 
				<body style="font-family: Calibri; font-size: 16px;">
					<div class="col-md-12">
						<div class="col-md-12" style="border: 1px solid #A5EDF7; border-top-left-radius: 20px; border-top-right-radius: 20px; widht: 900px; height: 200px; background: #A5EDF7;" align="center">
							<img src="http://keypanelservices.com/html_mail/logo_kdoc.png" height="150" style="margin: 25px 20px;">
						</div>
						<div class="col-md-12" style="border: 1px solid #A5EDF7;">
							<div class="col-md-12" style="margin: 10px 10px;">
								<p>
									Hola Sr(a) <b>'.$correo.'</b>, hemos enviado una enlace para la activación de su cuenta y pueda disfrutar de esta aplicación. 
								</p>

								<p align="center">
								 	<a href="http://keydoc.com.ve/sesion/autentificando/usuario-'.base64_encode($id_usuario).'" class="btn btn-info">Activar Cuenta</a>
								</p>
									
								<p>	
								<br> si este link no funciona favor copie y peque el siguiente enlace en su navegador: <b>http://keydoc.com.ve/sesion/autentificando/usuario-'.base64_encode($id_usuario).'</b>
								</p>
								<p>
									Disfrutarás de grandes bondades tales como:
									<ul>
										<li>Agendar una cita con su médico favorito desde la comodidad de su hogar.</li>
										<li>Tener su historial de citas en todo momento.</li>
										<li>Conseguirás muchos doctores a tu disposición en un mismo lugar.</li>
									</ul>
								</p>
							</div>				
						</div>
						<div class="col-md-12"  style="border: 1px solid #A5EDF7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; widht: 900px; height: 80px; background: #A5EDF7;" align="center">
							<p>
								Desarrollado por <a href="http://www.keysystems.com.ve" style="text-decoration: none;">Key Systems, C.A</a> - Año '.date('d/m/Y').'
								<br>Correo: <a href="mailto:soporte@keydoc.com.ve?subject=Interesado" style="text-decoration: none;">soporte@keydoc.com.ve</a>
								<br>Teléfonos: +58 414-266.75.19 / +58 416-712.25.04 / 0212-640.4438 
							</p>
						</div>			
					</div>		
				</body> 
			</html>';

		return $cuerpo;
	}
}

if (! function_exists('restaurar_password')) 
{
	function restaurar_password($correo, $password)
	{
		$cuerpo = 
			'<html> 
				<head> 
			   		<title>Restauración de Contraseña</title> 
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">					
				</head>			 
				<body style="font-family: Calibri; font-size: 16px;">
					<div class="col-md-12">
						<div class="col-md-12" style="border: 1px solid #A5EDF7; border-top-left-radius: 20px; border-top-right-radius: 20px; widht: 900px; height: 200px; background: #A5EDF7;" align="center">
							<img src="http://keypanelservices.com/html_mail/logo_kdoc.png" height="150" style="margin: 25px 20px;">
						</div>
						<div class="col-md-12" style="border: 1px solid #A5EDF7;">
							<div class="col-md-12" style="margin: 10px 10px;">
								<p>
									Hola Sr(a) <b>'.$correo.'</b>, le hemos enviado su nueva contraseña temporal para que pueda ingresar al sistema, de igual forma le informamos que podra cambiarla en el momento que Ud. lo desee.
								</p>
								<p align="center">
									<b>Nueva Contraseña: '.$password.'</b>
									<br><br>
									<a href="http://keydoc.com.ve/sesion"  type="button"  class="btn btn-info">Iniciar Sesión</a>
								</p>					
								<br>
								<p>	
								En caso de no funcionar este mecanismo podrá comunicarse mediante correo electrónico para atender su solicitud, solo deberá enviarnos su correo electrónico.</b>
								</p>
							</div>				
						</div>
						<div class="col-md-12"  style="border: 1px solid #A5EDF7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; widht: 900px; height: 50px; background: #A5EDF7;" align="center">
							<p>
								Desarrollado por <a href="http://www.keysystems.com.ve" style="text-decoration: none;">Key Systems, C.A</a> - Año '.date('d/m/Y').'
								<br>Correo: <a href="mailto:soporte@keydoc.com.ve?subject=Interesado" style="text-decoration: none;">soporte@keydoc.com.ve</a>
							</p>
						</div>			
					</div>		
				</body> 
			</html>';
		return $cuerpo;
	}
}

if (! function_exists('notificacion')) 
{
	function notificacion($correo, $mensaje)
	{
		$cuerpo = 
			'<html> 
				<head> 
			   		<title>Notificaciones</title> 
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">					
				</head>			 
				<body style="font-family: Calibri; font-size: 16px;">
					<div class="col-md-12">
						<div class="col-md-12" style="border: 1px solid #A5EDF7; border-top-left-radius: 20px; border-top-right-radius: 20px; widht: 900px; height: 200px; background: #A5EDF7;" align="center">
							<img src="http://keypanelservices.com/html_mail/logo_kdoc.png" height="150" style="margin: 25px 20px;">
						</div>
						<div class="col-md-12" style="border: 1px solid #A5EDF7;">
							<div class="col-md-12" style="margin: 10px 10px;">
								<p>
									Hola Dr(a) <b>'.$correo.'</b>,
								</p>
								<p>
									'.$mensaje.'
								</p>					
							</div>				
						</div>
						<div class="col-md-12"  style="border: 1px solid #A5EDF7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; widht: 900px; height: 70px; background: #A5EDF7;" align="center">
							<p>
								Desarrollado por <a href="http://www.keysystems.com.ve" style="text-decoration: none;">Key Systems, C.A</a> - Año '.date('d/m/Y').'
								<br>Correo: <a href="mailto:soporte@keydoc.com.ve?subject=Interesado" style="text-decoration: none;">soporte@keydoc.com.ve</a>
							</p>
						</div>			
					</div>		
				</body> 
			</html>';
		return $cuerpo;
	}
}



/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */