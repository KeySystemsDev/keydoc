<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('id_usuario')){
			$this->id_aplicacion = $this->session->userdata('id_aplicacion');
			$this->id_grupo 	 = $this->session->userdata('id_grupo');
			$this->id_usuario	 = $this->session->userdata('id_usuario');
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
			* Se comprueba que el usuario no haya solicitado el carnet previamente
			**/
			$this->validar_carnet = $this->t_documentos_doctor_model->consulta_existencia_carnet($perfil);			

			/**
			* Se comprueba las notificaciones de amistad del paciente
			**/
			$arreglo = array(
				'id_usuario_paciente' => $this->id_usuario,
			);
			$this->solicitud_amistad = $this->t_amigos_model->consulta_notificacion_paciente_amistad($arreglo);

			/**
			* Si el usuario es doctor y tiene la sesion abierta
			* lo redirecciona directamente al panel
			**/
			if ($this->id_grupo != 2) {
				redirect(base_url().'panel', 'refresh');
			}

			$this->layout->setLayout('frontend');	
		}		
		$this->layout->setLayout('frontend');		
	}

	public function activacion(){
		$this->layout->view('activacion');
	}

	public function restaurar(){
		$this->layout->view('restaurar_password');
	}

	public function carnet_enviado(){
		$this->layout->view('carnet_enviado');
	}			
}