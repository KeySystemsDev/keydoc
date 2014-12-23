<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gestion extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		if($this->session->userdata('usuario')){
			$this->opcion 		 = 120;
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
		$this->layout->setTitle('.: Gestion :.');		
		$menu 		    	= $this->menu;
		$sub_menu     	= $this->sub_menu;	
		$this->layout->view('index',compact('menu', 'sub_menu'));
	}

	public function consultorio(){
		/**
		* Proceso para gestionar los consultorios del doctor
		*/
		$this->layout->setTitle('.: Nuevo Consultorio :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$arreglo  = array(
			'id_usuario' 	=> $this->id_usuario,			
		);
		$listado = $this->t_consultorio_model->consultar_consultorios_usuarios_gestion($arreglo);
		$this->layout->view('consultorios', compact('menu', 'sub_menu', 'listado'));
	}		

	public function consultorio_editar($id){
		/**
		* Se recoge el id del consulorio para editarlo
		*/
		$this->layout->setTitle('.: Editar Consultorio :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;			
		$arreglo  = array(
			'id_consultorio' => decodificar($id),
		);
		$id_usuario  = $this->id_usuario;
		$consultorio = $this->t_consultorio_model->consultar_consultorio($arreglo);
		$this->layout->view('consultorio_editar',compact('menu', 'sub_menu', 'consultorio', 'id_usuario'));
	}

	public function consultorio_actualizar(){	
		/**
		* Enviamos los datos para actualizar el consultorio
		*/		
		if ($this->input->post()){
			$arreglo = array(
				'id_consultorio' 				=> $this->input->post("id_consultorio"),
				'id_usuario' 						=> $this->input->post("id_usuario"),
				'nombre_consultorio' 		=> $this->input->post("i_nombre_consultorio"),
				'direccion_consultorio' => $this->input->post("i_direccion_consultorio"),
			);
			$this->t_consultorio_model->editar_consultorio($arreglo);
		}
		redirect(base_url().'gestion/consultorio', 'refresh');
	}

	public function consultorio_eliminar($id){
		/**
		* Deshabilitamos el consultorio
		*/
		$arreglo = array(
			'id_consultorio' => decodificar($id),
		);
		$this->t_consultorio_model->eliminar_consultorio($arreglo);
		redirect(base_url().'gestion/consultorio', 'refresh');
	}

	public function especialidad(){
		/**
		* Se consultan las especialidades el doctor
		*/
		$this->layout->setTitle('.: Nueva Especialidad :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$arreglo = array(
			'id_maestro' => 1,
			'id_usuario' => $this->id_usuario,						
		);
		$especialidades 	= $this->t_detalle_doctor_especialidad_model->consulta_especialidad_usuario($arreglo);
		$this->layout->view('especialidad', compact('menu', 'sub_menu', 'arreglo', 'especialidades'));
	}	

	public function especialidad_editar($doctor, $especialidad){
		/**
		* Se consulta la especialidad determinada del doctor
		*/
		$this->layout->setTitle('.: Editar Especialidad :.');		
		$menu 			         = $this->menu;
		$sub_menu 	             = $this->sub_menu;
		$id_detalle_especialidad = decodificar($doctor);
		$id_especialidad         = decodificar($especialidad);			
		$arreglo = array( 
			'id_tipo'    => decodificar($especialidad),
			'id_maestro' => 1				
		);

		$especialidades = $this->t_tipo_model->consultar($arreglo);
		$especialidad   = $this->t_tipo_model->consultar_especialidad($arreglo);
		$this->layout->view('especialidad_editar',compact('menu', 'sub_menu', 'especialidad', 'especialidades', 'id_detalle_especialidad'));
	}

	public function especialidad_actualizar(){
		/**
		* Actualizamos la especialidad seleccionada por el doctor
		*/			
		if ($this->input->post()){
			$arreglo = array(
				'id_detalle_doctor_especialidad' => $this->input->post("id_detalle_especialidad"),
				'id_tipo_especialidad'           => $this->input->post("s_especialidad"),
			);
			$this->t_detalle_doctor_especialidad_model->editar_especialidad($arreglo);
		}
		redirect(base_url().'gestion/especialidad', 'refresh');
	}

	public function especialidad_eliminar($id){
		/**
		* Deshabilitamos las especialidades
		*/
		$arreglo 	= array(
			'id_tipo' => decodificar($id),
		);
		$this->t_tipo_model->eliminar_especialidad($arreglo);
		redirect(base_url().'gestion/especialidad', 'refresh');
	}
	
	public function horario(){
		/**
		* Se muestra el listado de los horarios
		*/
		$this->layout->setTitle('.: Nuevo Horario :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$arreglo  = array(
			'id_usuario' =>	$this->id_usuario
		);
		$horarios	= $this->t_horario_model->consultar_horario_por_usuario($arreglo);
		$this->layout->view('horario', compact('menu', 'sub_menu', 'horarios'));
	}	

	public function horario_editar($id){
		/**
		* Se edita los horarios del doctor
		*/
		$this->layout->setTitle('.: Editar Horario :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;			
		$arreglo  = array(
			'id_horario' =>	decodificar($id),						
		);
		$horarios	= $this->t_horario_model->consultar_horario($arreglo);
		$this->layout->view('horario_editar',compact('menu', 'sub_menu', 'horarios'));
	}

	public function horario_actualizar(){
		/**
		* Se envian los datos a actualizar el horario
		*/			
		if ($this->input->post()){
			$arreglo = array(
				'id_usuario' 		 => $this->input->post("id_usuario"),
				'id_horario' 		 => $this->input->post("id_horario"),
				'id_consultorio' 	 => $this->input->post("id_consultorio"),				
				'fecha_horario'      => $this->input->post("i_fecha_consulta"),
				'cupos_horario'      => $this->input->post("i_cupos"),
				'desde_hora_horario' => $this->input->post("i_hora_desde"),
				'hasta_hora_horario' => $this->input->post("i_hora_hasta"),
				'costo_horario'      => $this->input->post("i_costo_consulta"),
			);
			$this->t_horario_model->editar_horario($arreglo);
		}
		redirect(base_url().'gestion/horario', 'refresh');
	}

	public function horario_eliminar($id){
		/**
		* Deshabilitamos el horario del doctor
		*/
		$arreglo 	= array(
			'id_horario' => decodificar($id),
		);
		$this->t_horario_model->eliminar_horario($arreglo);
		redirect(base_url().'gestion/horario', 'refresh');
	}

	
}