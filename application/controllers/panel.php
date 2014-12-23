<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		if($this->session->userdata('id_usuario')){
			$this->id_aplicacion 	= $this->session->userdata('id_aplicacion');
			$this->id_grupo 		= $this->session->userdata('id_grupo');
			$this->id_usuario	    = $this->session->userdata('id_usuario');
			$this->menu 	        = $this->permisologia_model->getMenu($this->id_aplicacion, $this->id_grupo, $this->id_usuario);
			if($this->id_grupo == 2){
				$paciente = array('id_usuario_paciente' => $this->id_usuario );
				$this->notificacion_paciente = $this->t_cita_model->consulta_notificacion_paciente($paciente);				
			}else{
				$doctor = array( 'id_usuario_doctor' => $this->id_usuario );
				$this->notificacion_doctor   = $this->t_cita_model->consulta_notificacion_doctor($doctor);
				$paciente = array('id_usuario_paciente' => $this->id_usuario );
				$this->notificacion_paciente = $this->t_cita_model->consulta_notificacion_paciente($paciente);
			}
			
			/**
			*Consultamos el perfil del usuario
			**/	
			$perfil = array(
				'id_usuario' 		=> $this->id_usuario,
				'id_aplicacion' => $this->id_aplicacion 
			);
			$this->datos_perfil   = $this->t_perfil_model->consultar_perfil($perfil);			
			
			/**
			* Se comprueba que el usuario tenga datos en su perfil
			**/
			$this->validar_perfil = $this->t_perfil_model->consulta_validar_actualizar_perfil($perfil);
			foreach ($this->validar_perfil as $key) { $this->perfil = $key->nombre_apellido;}

			/**
			* Se comprueba las notificaciones de amistad del doctor
			**/
			$arreglo = array(
				'id_usuario_doctor' => $this->id_usuario,
			);
			$this->solicitud_amistad = $this->t_amigos_model->consulta_notificacion_doctor_amistad($arreglo);

			$this->layout->setLayout('backend');
		}else{
			redirect(base_url(), 301);	
		}
	}

	public function index(){
		$this->layout->setTitle('.: Keypanel :.');		
		$menu = $this->menu;
		$this->layout->view('index',compact('menu')); 
	}



	public function doctor($id_cita){	
		/**
		* Se envia el id_cita para conocer los detalles
		* de la cita seleccionada.
		**/	
		$menu 	 = $this->menu;
		$arreglo = array(
			'id_cita' => decodificar($id_cita),
		);			
		$leido        = $this->t_cita_model->notificacion_leida_doctor($arreglo);
		$detalle_cita = $this->t_cita_model->consulta_detalle_notificacion($arreglo);			
		$this->layout->view('notificacion_doctor', compact('menu', 'detalle_cita'));
			
	}

	public function notificaciones_aprobar(){
		/**
		* Se aprueba la cita
		**/			
		$arreglo = array(
			'id_cita' 		      => $this->input->post('id_cita'),
			'id_usuario_doctor'   => $this->id_usuario,
			'id_usuario_paciente' => $this->input->post('id_usuario_paciente'),
		);
		$this->t_cita_model->aprobar_cita($arreglo);
	}

	public function notificaciones_agregar_rechazo(){
		/**
		* Se registra el motivo del rechazo de la cita
		**/			
		$arreglo = array(
			'id_cita' 							=> $this->input->post("id_cita"),
			'descripcion_detalle_rechazo_cita' 	=> $this->input->post("i_detalle")				
		);
		$this->t_cita_model->rechazar_cita($arreglo);			
	}

}
