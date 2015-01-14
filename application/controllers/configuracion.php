<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		if($this->session->userdata('usuario')){
			$this->id_aplicacion = $this->session->userdata('id_aplicacion');
			$this->id_grupo 	 = $this->session->userdata('id_grupo');
			$this->id_usuario	 = $this->session->userdata('id_usuario');
			$this->menu 	     = $this->permisologia_model->getMenu($this->id_aplicacion, $this->id_grupo, $this->id_usuario);
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
		$menu = $this->menu;
		$this->layout->view('index', compact('menu'));
	}

	public function perfil(){
		/**
		* Se muestra el perfil listo o por llenar
		**/
		$this->layout->setTitle('.: Registro de Perfil :.');		
		$menu 		    = $this->menu;
		$resumen_perfil = $this->datos_perfil;
		$arreglo 		= array(
			'id_aplicacion' => $this->id_aplicacion,
			'id_usuario'	=> $this->id_usuario						
		);
		
		if($this->perfil != 0){
			$this->layout->view('perfil_resumen', compact('menu', 'arreglo', 'resumen_perfil'));
		}else{
			$this->layout->view('perfil_crear', compact('menu', 'arreglo'));
		}	

	}

	function perfil_agregar(){
		/**
		* Se envian todos los datos del perfil en ajax
		**/
		if ($this->input->post()){
			$arreglo = array(
				'nombre' 		    => $this->input->post("i_nombre"),
				'apellido' 		    => $this->input->post("i_apellido"),
				'cedula' 		    => $this->input->post("i_cedula"),
				'telefono' 		    => $this->input->post("i_telefono"),	
				'fecha_nacimiento'  => $this->input->post("i_fecha_nacimiento"),
				'direccion' 	    => $this->input->post("i_direccion"),						
				'id_usuario' 	    => $this->input->post("id_usuario"),
				'sexo_perfil'       => $this->input->post("i_sexo"),
				'portal_web_perfil' => ($this->input->post("i_portal_web")) ? $this->input->post("i_portal_web") : '',
				'id_aplicacion'     => $this->id_aplicacion
			);
			$this->t_perfil_model->actualizar_perfil($arreglo);			
		}
	}

	public function perfil_contrasena(){
		/**
		* Panel para editar la contraseña del perfil del doctor
		**/
		$this->layout->setTitle('.: Editar Contraseña :.');		
		$menu 	 = $this->menu;
		$arreglo = array(
			'id_usuario' => $this->id_usuario						
		);
		$datos_usuario = $this->t_usuario_model->consultar_usuario($arreglo);
		$this->layout->view('perfil_contrasena_password', compact('menu', 'datos_usuario'));
	}

	public function perfil_editar_contrasena(){
		/**
		* Se edita la contraseña de la cuenta del doctor
		**/
		if ($this->input->post()){
			$arreglo = array(
				'correo_usuario' 	     => $this->input->post("i_correo"),
				'clave_usuario'          => $this->input->post("i_contrasena"),
				'repetir_clave_usuario'  => $this->input->post("i_repetir_contrasena"),
			);
			$this->t_usuario_model->editar_clave_usuario($arreglo);		
		}
	}

	public function perfil_editar(){
		/**
		* Aqui se edita el perfil del doctor
		**/
		$this->layout->setTitle('.: Editar perfil :.');		
		$menu  	 = $this->menu;
		$arreglo = array(
			'id_usuario' => $this->id_usuario						
		);
		$datos_perfil = $this->t_perfil_model->consultar_perfil($arreglo);
		$this->layout->view('perfil_editar', compact('menu', 'datos_perfil', 'arreglo'));
	}

	public function perfil_actualizar(){
		/**
		* Se actualiza el perfil del doctor
		**/
		if ($this->input->post()){
			$arreglo = array(
				'id_usuario' 		=> $this->input->post("id_usuario"),
				'nombre'  			=> $this->input->post("i_nombre"),
				'apellido'  		=> $this->input->post("i_apellido"),
				'cedula'  			=> $this->input->post("i_cedula"),
				'telefono'  		=> $this->input->post("i_telefono"),
				'fecha_nacimiento'  => $this->input->post("i_fecha_nacimiento"),
				'direccion'  		=> $this->input->post("i_direccion"),
				'sexo_perfil'  		=> $this->input->post("i_sexo"),
				'portal_web_perfil' => ($this->input->post("i_portal_web")) ? $this->input->post("i_portal_web") : '',

			);
			$this->t_perfil_model->editar_datos_perfil($arreglo);		
		}
	}

	public function foto(){
		/**
		* Proceso para subir la foto del doctor
		**/
		$this->load->helper(array('form', 'url'));  
		$this->load->library('image_moo') ; 		
		$this->layout->js(
			array(
				base_url().'public/libs/bootstrap/js/plugins/fileinput/jquery-1.3.2.min.js',
				base_url().'public/libs/bootstrap/js/plugins/fileinput/bootstrap-fileinput.js',
				base_url().'public/libs/bootstrap/js/plugins/fileinput/jquery.imgareaselect.min.js',
			)
		);
		$this->layout->setTitle('.: Subir foto :.');		

		$data['upload_path']        = $upload_path          = "./public/upload/real/" ;
		$data['destination_thumbs'] = $destination_thumbs   = "./public/upload/thumbs/" ;
		$data['large_photo_exists'] = $data['thumb_photo_exists'] = $data['error'] = NULL ;
		$data['thumb_width']        = "270";
		$data['thumb_height']       = "270";
	
		if (!empty($_POST['upload'])) {
			$config['upload_path']  = $upload_path ;
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$config['max_size']     = '2000';
			$config['max_width']    = '700';
			$config['max_height']   = '700';

			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload("image")) {
				$data['img']   = $this->upload->data();
				$data['large_photo_exists']  = "<img src=\"".base_url() . $upload_path.$data['img']['file_name']."\" alt=\"Large Image\"/>";
			}
		}elseif (!empty($_POST['upload_thumbnail'])) {
			$x1 = $this->input->post('x1',TRUE) ;
			$y1 = $this->input->post('y1',TRUE) ;
			$x2 = $this->input->post('x2',TRUE) ;
			$y2 = $this->input->post('y2',TRUE) ;
			$w  = $this->input->post('w',TRUE) ;
			$h  = $this->input->post('h',TRUE) ;

			$file_name = $this->input->post('file_name',TRUE) ;
			if ($file_name) {
				$this->image_moo
					->load($upload_path . $file_name)
					->crop($x1,$y1,$x2,$y2)
					->save($destination_thumbs . $file_name) ;

				if ($this->image_moo->errors) {
					$data['error'] = $this->image_moo->display_errors() ;
				} else {
					$data['thumb_photo_exists'] = "<img src=\"".base_url().$destination_thumbs.$file_name."\" width=\"100%\" alt=\"Thumbnail Image\"/>";
					$data['large_photo_exists'] = "<img src=\"".base_url().$upload_path.$file_name."\" width=\"100%\" alt=\"Large Image\"/>";

					$arreglo = array(
						'id_usuario' 		=> $this->id_usuario,
						'url_imagen_perfil' => $destination_thumbs.$file_name,
					);
					$this->t_perfil_model->actualizar_imagen_perfil($arreglo);
				}
			}
		}
		$data['menu'] = $this->menu;
		$this->layout->view('subir_foto', $data);	
	}

	public function amistad($id_usuario){	
		/**
		*	Se envia el id del usuario para ver su perfil
		**/	
		$menu 	  = $this->menu;			
		$arreglo  = array(
			'id_usuario'          => decodificar($id_usuario),
			'id_usuario_doctor'   => $this->session->userdata('id_usuario'),
			'id_usuario_paciente' => decodificar($id_usuario),
		);
		$resumen_perfil = $this->t_perfil_model->consultar_perfil($arreglo);
		$amistad        = $this->t_amigos_model->consulta_status_amistad($arreglo);							
		$this->layout->view('solicitud_amistad', compact('menu', 'resumen_perfil', 'amistad'));
			
	}

	public function aprobar_solicitud(){	
		/**
		*	Se envia el id del usuario para aprobar su solicitud
		**/	
		$menu 	  = $this->menu;			
		$arreglo  = array(
			'id_usuario_doctor'   => $this->session->userdata('id_usuario'),
			'id_usuario_paciente' => $this->input->post("id_paciente"),
		);
		$amistad = $this->t_amigos_model->aprobar_solicitud_amistad($arreglo);										
	}
}
