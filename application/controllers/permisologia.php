<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisologia extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		if($this->session->userdata('usuario')){
			$this->opcion 			  = 10;
			$this->id_aplicacion 	= $this->session->userdata('id_aplicacion');
			$this->id_grupo 			= $this->session->userdata('id_grupo');
			$this->id_usuario			= $this->session->userdata('id_usuario');
			$this->menu 	        = $this->permisologia_model->getMenu($this->id_aplicacion, $this->id_grupo, $this->id_usuario);
			$this->sub_menu       = $this->permisologia_model->getSubMenu($this->opcion, $this->id_usuario, $this->id_grupo);
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

			$this->layout->setLayout('backend');
		}else{
			redirect(base_url(), 301);	
		}
	}

	public function index(){
		$this->layout->setTitle('.: Permisología :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;			
		$this->layout->view('index',compact('menu', 'sub_menu'));   
	}

	public function usuario(){
		$this->layout->setTitle('.: Usuario :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$usuarios = $this->t_usuario_model->getUsuarios();			
		$this->layout->view('usuario',compact('menu', 'sub_menu', 'usuarios')); 	   
	}	

	public function usuario_guardar(){
		if($this->input->post()){	
			$arreglo = array(			
				'correo_usuario' => $this->input->post('i_email'),
				'clave_usuario'  => $this->input->post('i_pass'),
			);
			$insertar_usuario = $this->t_usuario_model->insertar_usuario($arreglo);				
		}
	}		

	public function usuario_habilitar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_usuario' => $this->input->post('id'),
			);
			$habilitar_usuario = $this->t_usuario_model->habilitar_usuario($arreglo);				
		}
	}

	public function grupo(){
		$this->layout->setTitle('.: Grupo :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$grupos   = $this->t_grupo_model->getGrupos();	
		$this->layout->view('grupo',compact('menu', 'sub_menu', 'grupos')); 	   
	}
	
	public function grupo_guardar(){
		if($this->input->post()){	
			$arreglo = array(			
				'nombre_grupo' => $this->input->post('i_grupo'),
			);
			$insertar_grupo = $this->t_grupo_model->insertar_grupo($arreglo);				
		}	
	}

	public function grupo_modificar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_grupo'     => $this->input->post('id'),
				'nombre_grupo' => $this->input->post('i_nombre'),
			);
			$modificar_grupo = $this->t_grupo_model->modificar_grupo($arreglo);				
		}
	}	

	public function grupo_habilitar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_grupo' => $this->input->post('id'),
			);	
			$habilitar_grupo = $this->t_grupo_model->habilitar_grupo($arreglo);
		}	
	}

	public function aplicacion(){
		$this->layout->setTitle('.: Aplicacion & Usuario :.');		
		$menu 		= $this->menu;
		$sub_menu   = $this->sub_menu;
		$aplicacion = $this->t_aplicacion_model->getAplicacion();	
		$grupos 		= $this->t_grupo_model->getGrupos();

		$this->layout->view('aplicacion',compact('menu', 'sub_menu', 'aplicacion', 'grupos'));			   
	}	

	public function aplicacion_listado($id_aplicacion, $id_grupo){
		$this->layout->setTitle('.: Grupo & Menu :.');		
		$menu 		= $this->menu;
		$sub_menu   = $this->sub_menu;
		$aplicacion = $this->t_aplicacion_model->getAplicacion();
		$grupos     = $this->t_grupo_model->getGrupos();
		$usuarios 	= $this->t_usuario_model->getUsuarios();	
		$arreglo 	= array(
			'id_aplicacion' => $id_aplicacion,
			'id_grupo'      => $id_grupo,
		);

		$listado = $this->configuracion_model->grupos_asignados($arreglo);
		$this->layout->view('aplicacion',compact('menu', 'sub_menu', 'aplicacion', 'grupos', 'id_aplicacion', 'id_grupo', 'usuarios', 'listado'));  
	}	

	public function aplicacion_guardar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_aplicacion' => $this->input->post('s_aplicacion'),
				'id_grupo'      => $this->input->post('s_grupo'),
				'id_usuario'    => $this->input->post('s_usuario'),
			);

			$aplicacion_usuario = $this->t_aplicacion_usuario_model->insertar_aplicacion_usuario($arreglo);
		}	
	}	

	public function seccion(){
		$this->layout->setTitle('.: Seccion :.');		
		$menu 		= $this->menu;
		$sub_menu   = $this->sub_menu;
		$grupos 	= $this->t_grupo_model->getGrupos();
		$menu_raiz 	= $this->t_menu_model->getMenuRaiz();

		$this->layout->view('seccion',compact('menu', 'sub_menu', 'grupos', 'menu_raiz')); 	   
	}

	public function seccion_listado($id){
		$this->layout->setTitle('.: Seccion :.');		
		$menu 		= $this->menu;
		$sub_menu   = $this->sub_menu;
		$grupos     = $this->t_grupo_model->getGrupos();
		$menu_raiz 	= $this->t_menu_model->getMenuRaiz();
		$id_grupo 	= $id;

		$arreglo = array(
			'id_grupo' => $id,
		);

		$listado_seccion = $this->configuracion_model->seccion_asignada($arreglo);
		$this->layout->view('seccion',compact('menu', 'sub_menu', 'grupos', 'menu_raiz', 'id_grupo', 'listado_seccion')); 	   
	}	
	
	public function seccion_guardar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_grupo' => $this->input->post('s_grupo'),
				'id_menu'  => $this->input->post('s_menu'),
			);
			$grupo_menu = $this->t_grupo_menu_model->insertar_grupo_menu($arreglo);
		}	
	}

	public function menu(){
		$this->layout->setTitle('.: Grupo & Menu :.');		
		$menu 		= $this->menu;
		$sub_menu   = $this->sub_menu;
		$grupos 	= $this->t_grupo_model->getGrupos();
		$menu_raiz 	= $this->t_menu_model->getMenuRaiz();

		$this->layout->view('menu',compact('menu', 'sub_menu', 'grupos', 'menu_raiz')); 	   
	}

	public function menu_listado($id_grupo, $id_menu){
		$this->layout->setTitle('.: Grupo & Menu :.');		
		$menu 		= $this->menu;
		$sub_menu   = $this->sub_menu;
		$grupos 	= $this->t_grupo_model->getGrupos();
		$menu_raiz 	= $this->t_menu_model->getMenuRaiz();		
		$arreglo 		= array(
			'id_aplicacion' => $this->id_aplicacion,
			'id_grupo'      => $id_grupo,
			'id_menu'       => $id_menu,
		);

		$listado = $this->configuracion_model->menu_asignados($arreglo);

		$arreglo = array(
			'id_menu' => $id_menu,
		);
		$lista_menu = $this->t_menu_model->menu_dependiente($arreglo);		
		$this->layout->view('menu',compact('menu', 'sub_menu', 'grupos', 'menu_raiz', 'id_grupo', 'id_menu' ,'listado', 'lista_menu'));  
	}
	
	public function menu_guardar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_grupo' => $this->input->post('s_grupo'),
				'id_menu'  => $this->input->post('s_sub_menu'),
			);
			
			$menu = $this->t_grupo_menu_model->insertar_grupo_menu($arreglo);
		}	
	}
	
	public function menu_habilitar(){
		if($this->input->post()){	
			$arreglo = array(			
				'id_grupo_menu' => $this->input->post('id'),
			);	
			$listado = $this->t_grupo_menu_model->habilitar_grupo_menu($arreglo);		
			$this->layout->setLayout('ajax');
			$this->layout->view('respuestas',compact('listado'));
		}	
	}	

	public function bitacora(){
		$this->layout->setTitle('.: Bitácora :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;
		$bitacora = $this->t_bitacora_model->getBitacora();
		$this->layout->view('bitacora',compact('menu', 'sub_menu', 'bitacora')); 	   
	}


}
