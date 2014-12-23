<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		if($this->session->userdata('usuario')){
			$this->opcion 		 = 100;
			$this->id_aplicacion = $this->session->userdata('id_aplicacion');
			$this->id_grupo 	 = $this->session->userdata('id_grupo');
			$this->id_usuario	 = $this->session->userdata('id_usuario');
			$this->menu 	     = $this->permisologia_model->getMenu($this->id_aplicacion, $this->id_grupo, $this->id_usuario);
			$this->sub_menu      = $this->permisologia_model->getSubMenu($this->opcion, $this->id_usuario, $this->id_grupo);
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
		$this->layout->setTitle('.: Registro :.');	
		$menu 		    = $this->menu;
		$sub_menu     = $this->sub_menu;	
		$this->layout->view('index', compact('menu', 'sub_menu'));
	}

	public function consultorio(){
		/**
		* Se consultan los estados para registrar un consultorio
		**/
		$this->layout->setTitle('.: Registro de Consultorio :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$arreglo  = array(
			'id_maestro'  => 3,							
		);
		$estados = $this->t_tipo_model->consultar($arreglo);
		$this->layout->view('consultorio_estados', compact('menu', 'sub_menu', 'estados'));
	}	

	public function consultorio_estado($id){
		/**
		* Se recoge el id del estado para registrar el consultorio
		**/
		$this->layout->setTitle('.: Registro de Consultorio :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$usuario  = $this->id_usuario;
		$id       = decodificar($id);
		$estado   = array(
			'id_tipo_dependiente'  => $id, 							
		);
		$municipios 		= $this->t_tipo_model->consultar_municipio($estado);		
		$this->layout->view('consultorio', compact('menu', 'sub_menu', 'usuario', 'municipios', 'id'));
	}	

	public function consultorio_agregar(){
		/**
		* Se registra el consultorio mediante ajax
		**/
		if ($this->input->post()){
			$arreglo = array(
				'nombre_consultorio'    => $this->input->post("i_nombre_consultorio"),
				'direccion_consultorio' => $this->input->post("i_direccion_consultorio"),
				'id_usuario' 			=> $this->input->post("id_usuario"),
				'id_tipo_estado' 	    => $this->input->post("id_estado"),
				'id_tipo_municipio' 	=> $this->input->post("s_municipio"),							
			);
			$this->t_consultorio_model->insertar_consultorio($arreglo);			
		}
	}

	public function especialidad(){
		/**
		* Se consultan todas las especialidades
		**/
		$this->layout->setTitle('.: Registro de Especialidad :.');		
		$menu     = $this->menu;
		$sub_menu = $this->sub_menu;

		$arreglo = array(
			'id_usuario' => $this->id_usuario,
			'id_maestro' => 1		
		);
		$especialidades = $this->t_tipo_model->consultar($arreglo);
		$this->layout->view('especialidad', compact('menu', 'sub_menu', 'arreglo', 'especialidades'));
	}	

	public function especialidad_agregar(){
		/**
		* Se envia mediante ajax los id de la especialidad y el usuario
		**/
		if ($this->input->post()){
			$arreglo = array(
				'id_tipo_especialidad' => $this->input->post("s_especialidad"),
				'id_usuario' 		   => $this->input->post("usuario")				
			);

			$this->t_detalle_doctor_especialidad_model->insertar_especialidad_doctor($arreglo);
		}
	}

	public function horario(){
		/**
		* Se solicitan los datos del doctor para registrar un horario.
		**/
		$this->layout->setTitle('.: Registro de Horario :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;

		$arreglo = array(
			'id_usuario' => $this->id_usuario,
			'id_maestro' => 1,	
			'existente'  => 0			
		);

		$especialidades	= $this->t_detalle_doctor_especialidad_model->consulta_especialidad_usuario($arreglo);
		$consultorios   = $this->t_consultorio_model->consultar_consultorios_usuarios_gestion($arreglo);
		$this->layout->view('horario', compact('menu', 'sub_menu', 'consultorios', 'especialidades', 'arreglo'));
		
	}	

	public function horario_agregar(){
		if ($this->input->post()){
			$arreglo = array(	
				'id_consultorio' 	   => $this->input->post("s_consultorio"),
				'id_tipo_especialidad' => $this->input->post("s_especialidad"),
				'fecha_horario' 	   => $this->input->post("i_fecha_consulta"),
				'cupos_horario' 	   => $this->input->post("i_cupos"),
				'desde_hora_horario'   => $this->input->post("i_hora_desde"),	
				'hasta_hora_horario'   => $this->input->post("i_hora_hasta"),	
				'costo_horario' 	   => $this->input->post("i_costo_consulta"),
				'id_usuario' 		   => $this->input->post("id_usuario")
			);
			$this->t_horario_model->insertar_horario($arreglo);			
		}
	}
	

	public function recepcionista($url_1 = null, $url_2 = null, $url_3 = null, $url_4 = null){
		$this->layout->setTitle('.: Registro de Recepcionista :.');				
		$menu 		    = $this->menu;
		$sub_menu     = $this->sub_menu;

		if ($url_2 != null){
			/**
			* Proceso para registrar la recepcionista
			**/
			$url = $url_1.'/'.$url_2;
			$arreglo = array(
				'id_consultorio'      => decodificar($url_2),
				'id_usuario_doctor'	  => $this->id_usuario,
				'id_usuario_paciente' => decodificar($url_1)
			);
			$registrar_recepcionista = $this->t_detalle_recepcion_model->insertar_recepcionista($arreglo);
			foreach ($registrar_recepcionista as $key) { $id_detalle_recepcion = $key->id_detalle_recepcion; }
			if (isset($id_detalle_recepcion)) {
				$this->layout->view('recepcionista_registrada_anteriormente', compact('menu', 'sub_menu', 'arreglo'));
			}else{
				$this->layout->view('recepcionista_registrar', compact('menu', 'sub_menu', 'url', 'registrar_recepcionista'));
			}
		}elseif ($url_1 != null){
			/**
			* Proceso para asignar consultorio a la recepcionista
			**/		
			$url              = $url_1;
			$id_recepcionista = decodificar($url_1);
			$arreglo	= array(
				'id_usuario' => $this->id_usuario			
		  	);
			$consultorios = $this->t_consultorio_model->consultar_consultorios_usuarios_gestion($arreglo);
			$this->layout->view('recepcionista_consultar_consultorio', compact('menu', 'sub_menu', 'url', 'consultorios', 'id_recepcionista'));

		}else{
			/**
			* Se busca la recepcionista a asignar
			**/
			$this->layout->view('recepcionista_buscar', compact('menu', 'sub_menu'));
		}
	}

	public function recepcionista_buscar(){
		/**
		* Se busca la recepcionista por numero de cedula por ajax.
		**/
		if ($this->input->post()){
			$arreglo = array(	
				'cedula_perfil' => $this->input->post("i_cedula"),
			);

			$usuario = $this->t_perfil_model->consulta_existencia_por_cedula($arreglo);
			$this->layout->setLayout('ajax');
			$this->layout->view('ajax_recepcionista', compact('usuario'));	
		}
	}

}