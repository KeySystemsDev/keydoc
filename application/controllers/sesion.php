<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		/**
		* Se verifica que la url no sea desconectar para
		*  que haga su proceso normal
		**/
		$this->url = $_SERVER['REQUEST_URI'];
		$this->str = explode('/', $this->url);

		//$this->num = 4;  // localhost
		$this->num = 2;  // server
		
		$this->str = (isset($this->str[$this->num])) ? $this->str[$this->num] : '';
		if ($this->str != 'desconectar') {
			/**
			* De no ser desconectar inicia sesion normalmente
			**/
			if($this->session->userdata('usuario')){
				$this->id_grupo = $this->session->userdata('id_grupo');
				if ($this->id_grupo == 2) {
					redirect(base_url().'agendar', 'refresh');
				}else {
					redirect(base_url().'panel', 'refresh');
				}
			}
		}
		$this->layout->setLayout('sesion');		
	}

	function index(){
		$this->layout->setTitle('.: Entrar :.');	
		$this->layout->view('sesion');
	}

	function comprobar_usuario(){
		/**
		* Con el usuario y password se comprueba si el usuario existe
		**/
		$usuario  = $this->input->post('i_usuario');
		$password = $this->input->post('i_password');
		$arreglo  = $this->permisologia_model->getUsuario($usuario, $password);
		echo $resultado = ($arreglo)? 1: 0;
	}

	function conectar(){
		/**
		* Se verifica el usuario para crear la sesion
		**/
		$usuario = $this->input->post('i_usuario');
		$pass    = $this->input->post('i_password');
		$arreglo = $this->permisologia_model->getUsuario($usuario, $pass);	

		foreach ($arreglo as $key) {
			$sesiones = array(
		        'usuario'       => $key->correo_usuario,
		        'id_usuario'    => $key->id_usuario,
		        'id_aplicacion' => $key->id_aplicacion,
		        'id_grupo'      => $key->id_grupo,
		    );

			$this->session->set_userdata('usuario', $key->correo_usuario);
			$this->session->set_userdata('id_usuario', $key->id_usuario);
			$this->session->set_userdata('id_aplicacion', $key->id_aplicacion);
			$this->session->set_userdata('id_grupo', $key->id_grupo);			
		}

		$this->session->userdata('usuario');
		$this->session->userdata('id_usuario');
		$this->session->userdata('id_aplicacion');
		$this->session->userdata('id_grupo');	

		$grupo  = $this->session->userdata('id_grupo');
		$sesion = $this->session->userdata('usuario');
		
		if ($grupo == '2'){
			redirect(base_url().'agendar', 'refresh');
		}else{
			redirect(base_url().'panel', 'refresh');
		}
	}


	function desconectar(){	
		/**
		* Se borran los datos de la sesion
		**/	
		if ($this->session->userdata('usuario')){
			$this->session->unset_userdata('usuario');
			$this->session->unset_userdata('id_usuario');
			$this->session->unset_userdata('id_aplicacion');
			$this->session->unset_userdata('id_grupo');				
			redirect(base_url().'agendar');	
		}else{
			redirect(base_url(), 301);	
		}
	}

	function registrate(){
		$this->layout->setTitle('Regístrate');	
		$this->layout->view('registrate');
	}

	function existencia(){
		/**
		* Se comprueba la existencia del usuario
		**/
		$arreglo = array(
  			'correo_usuario' => $this->input->post('i_usuario')
  		);
		$existe = $this->t_usuario_model->consultar_validar_correo($arreglo);		
		echo $resultado = ($existe)? 1: 0;
	}

	function registrar(){
		/**
		* Se registran los datos del usuario para crear una nueva cuenta
		**/       
	  	$arreglo = array(
	  		'correo_usuario' => $this->input->post('i_usuario'),
	  		'clave_usuario'  => $this->input->post('i_password')
	  	);

	  	$usuarios = $this->t_usuario_model->insertar_usuario($arreglo);	

		foreach ($usuarios as $key) {
			$this->session->set_userdata('usuario', $key->correo_usuario);
			$this->session->set_userdata('id_usuario', $key->id_usuario);			
		}

		/**
		* Enviando Correo electronico para la validacion de la 
		* cuenta
		**/
		$this->email->clear();
		$this->email->set_mailtype("html");
		$this->email->from('contacto@keysystems.com.ve', 'Soporte Key Doc');
		$this->email->to($this->input->post('i_usuario')); 
		$this->email->bcc('diego.carciente@gmail.com'); 
		$this->email->subject('Activación en K-DOC');
		$cuerpo = registro(
					$this->input->post('i_usuario'), 
					$this->session->userdata('id_usuario')
				);
		$this->email->message($cuerpo);	
		$this->email->send();

		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('id_usuario');
  		
  		redirect(base_url().'sesion', 'refresh');
 	}

	function restaurar_contrasena(){
		/**
		* Se le solicitan los datos al usuario para restaurar la contraseña
		**/
		$this->layout->setTitle('Restaurar Contraseña');	
		$this->layout->view('restaurar_contrasena');
	}

	function enviar_password(){
		/**
		* Se envia por email por la restauracion de la contraseña
		* y se utiliza la funcion para editar la contraseña
		**/
		$password = substr(md5(microtime()), 1, 8);
		$arreglo = array(
	  		'correo_usuario' => $this->input->post('i_usuario'),
	  		'clave_usuario'  => $password
	  	);	  	
	  	$this->t_usuario_model->editar_clave_usuario($arreglo);

		/**
		* Enviando Correo electronico para la validacion de la 
		* cuenta
		**/
		$this->email->clear();
		$this->email->set_mailtype("html");
		$this->email->from('contacto@keysystems.com.ve', 'Soporte Key Doc');
		$this->email->to($this->input->post('i_usuario')); 
		$this->email->bcc('diego.carciente@gmail.com'); 
		$this->email->subject('Nueva Contraseña K-DOC');
		$cuerpo = restaurar_password(
					$this->input->post('i_usuario'), 
					$password
				);
		$this->email->message($cuerpo);	
		$this->email->send();		  	

		redirect(base_url().'mail/restaurar', 'refresh');
	}

	function autentificando($id){
		/**
		* Se obtiene el id del usuario para autentificar el correo
		**/
		$arreglo = array(
	  		'id_usuario' => decodificar($id),
	  	);
		$this->t_usuario_model->validar_cuenta_usuario($arreglo);
		redirect(base_url().'mail/activacion', 'refresh');
	}
}
