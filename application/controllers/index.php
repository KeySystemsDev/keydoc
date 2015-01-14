<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller{
	
	function __construct(){
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
		}else{
			/**
			* Se verfica si el usuario esta colocando otra direccion que no sea
			* agendar de lo contrario lo redirecciona a agendar.
			**/
			$this->url = $_SERVER['REQUEST_URI'];
			$this->str = explode('/', $this->url);
			
			$this->num = 3;  // localhost
			//$this->num = 1;  // server
		
			if ($this->str[$this->num]) {
				if($this->str[$this->num] == 'agendar'
				|| $this->str[$this->num] == 'doctor') {
					/**
					* Si el metodo es agendar lo permite
					**/
					$this->layout->setLayout('frontend');				
				}elseif($this->str[$this->num] != 'agendar'){
					/**
					* Si el metodo es diferente a agendar lo redirecciona
					**/
					redirect(base_url().'agendar', 'refresh');
				}	
			}
		}			
	}

	public function index(){
		/**
		*	Modulo de invitacion al usuario
		* la pagina promocional
		**/
		$this->layout->setLayout('index');
		$this->layout->view('index');
	}


	public function agendar_horario($id_doctor, $id_horario){
		$arreglo           = array(
			'id_usuario_doctor'   => decodificar($id_doctor),
			'id_horario'          => decodificar($id_horario),			
			'id_usuario_paciente' => $this->id_usuario,
		);
		$cita_actual = $this->t_cita_model->agregar_cita($arreglo);
		foreach ($cita_actual as $key) {
			/**
			*	Se verifica que el usuario no haya agendado anteriormente
			**/				
			if (isset($key->doctor)) {
				$this->layout->view('agendar/agendar_mensaje_envio', compact('arreglo'));
			} else {
				$this->layout->view('agendar/agendar_mensaje_cita_error', compact('arreglo'));
			}
		}
	}

	public function doctor($id_doctor){
		/**
		*	Se consulta el perfil del doctor con todos sus horarios
		* donde puede agendar la cita mas facilmente
		**/			
		$id_usuario   = (isset($this->id_usuario)) ? $this->id_usuario : '';				
		$arreglo      = array(
			'id_usuario'           => decodificar($id_doctor),
			'id_usuario_paciente'  => $id_usuario,
			'id_usuario_doctor'    => decodificar($id_doctor),
		);			
		$amistad  = $this->t_amigos_model->consulta_status_amistad($arreglo);
		$doctor   = $this->t_perfil_model->consultar_perfil($arreglo);
		$horarios = $this->t_horario_model->consultar_horario_por_usuario($arreglo);			
		$this->layout->view('perfil/perfil_doctor_horario', compact('arreglo', 'doctor', 'horarios', 'amistad', 'id_doctor'));
	}


	public function agendar($url_1 = null, $url_2 = null, $url_3 = null, $url_4 = null, $url_5 = null) {
		/**
		*	Modulo completo de agendar una cita
		**/
		$this->layout->setTitle('.: Bienvenido :.');		

		if ($url_5 != null) {
			/**
			*	Proceso donde se le envía un mensaje al usuario de que la cita fue
			* enviada al doctor exitosamente.
			**/				
			$url               = $url_1.'/'.$url_2.'/'.$url_3.'/'.$url_4.'/'.$url_5;
			$arreglo           = array(
				'especialidad'        => decodificar($url_1),
				'id_estado'           => decodificar($url_2),
				'id_municipio'        => decodificar($url_3),
				'id_usuario_doctor'   => decodificar($url_4),
				'id_horario'          => decodificar($url_5),			
				'id_usuario_paciente' => $this->id_usuario,
				'url'                 => $url
			);			
			$cita_actual = $this->t_cita_model->agregar_cita($arreglo);
			foreach ($cita_actual as $key) {
				/**
				* Se verifica que el usuario no haya agendado anteriormente
				**/
				if (isset($key->doctor)) {
					$this->layout->view('agendar/agendar_mensaje_envio', compact('arreglo'));
				} else {
					$this->layout->view('agendar/agendar_mensaje_cita_error', compact('arreglo'));
				}
			}
		} elseif ($url_4 != null) {	
			/**
			* Proceso donde se muestra el perfil del doctor seleccionado
			**/					
			$id_usuario   = (isset($this->id_usuario)) ? $this->id_usuario : '';				
			$url          = $url_1.'/'.$url_2.'/'.$url_3.'/'.$url_4;
			$id_doctor    = decodificar($url_4);
			$arreglo      = array(
				'especialidad'         => decodificar($url_1),
				'id_usuario'           => decodificar($url_4),
				'url'                  => $url,
				'id_usuario_paciente'  => $id_usuario,
				'id_usuario_doctor'    => decodificar($url_4),
				'id_tipo_estado'       => decodificar($url_2),
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => decodificar($url_3),				
			);	
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estado       = $this->t_tipo_model->consulta_estado($arreglo);	
			$municipio    = $this->t_tipo_model->consulta_municipio($arreglo);					
			$amistad      = $this->t_amigos_model->consulta_status_amistad($arreglo);
			$doctor       = $this->t_perfil_model->consultar_perfil($arreglo);
			$horarios     = $this->t_horario_model->consultar_horario_por_usuario_especialidad($arreglo);			
			$this->layout->view('agendar/agendar_horario', compact('arreglo', 'url', 'doctor', 'horarios', 'amistad', 'id_doctor', 'especialidad', 'estado', 'municipio', 'url_1', 'url_2', 'url_3'));
		} elseif ($url_3 != null) {
			/**
			* Proceso donde se muestra los doctores asociado al municipio seleccionado
			**/			
			$url          = $url_1.'/'.$url_2.'/'.$url_3;
			$arreglo      = array(
				'especialidad'         => decodificar($url_1),
				'url'                  => $url,
				'id_usuario_doctor'    => '',
				'id_tipo_estado'       => decodificar($url_2),
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => decodificar($url_3), 	
				'id_usuario'           => '',			
			);		
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estado       = $this->t_tipo_model->consulta_estado($arreglo);	
			$municipio    = $this->t_tipo_model->consulta_municipio($arreglo);	
			$doctores     = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);	
			$this->layout->view('agendar/agendar_doctor', compact('arreglo', 'url', 'doctores', 'especialidad', 'estado', 'municipio', 'url_1', 'url_2'));
		} elseif ($url_2 != null) {
			/**
			* Proceso donde se muestra los municipios asociados al estado seleccionado
			**/			
			$url          = $url_1.'/'.$url_2;
			$arreglo      = array(
				'especialidad'         => decodificar($url_1),
				'url'                  => $url,
				'id_usuario_doctor'    => '',
				'id_tipo_estado'       => decodificar($url_2),
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => '', 
				'id_usuario'           => '',				
			);	
			
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estado       = $this->t_tipo_model->consulta_estado($arreglo);
			$municipios   = $this->t_cita_model->consulta_municipio_por_estado($arreglo);
			$doctores     = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);
			$this->layout->view('agendar/agendar_municipio', compact('arreglo', 'url', 'municipios', 'especialidad', 'estado', 'url_1', 'doctores'));
		} elseif ($url_1 != null) {
			/**
			* Proceso donde se muestra los estados asociados a la especialidad seleccionada
			**/
			$url          = $url_1;
			$arreglo      = array(
				'url'                  => $url,
				'id_maestro'           => 3,
				'id_usuario_doctor'    => '',
				'id_tipo_estado'       => '',
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => '',
				'id_usuario'           => '', 
			);			
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estados      = $this->t_cita_model->consulta_estado_especialidad($arreglo);
			$doctores     = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);	
			$this->layout->view('agendar/agendar_estado', compact('arreglo', 'estados', 'url', 'especialidad', 'doctores'));
		} else {
			/**
			* Inicio del proceso, donde el usuario seleccionara la especialidad
			**/
			$arreglo = array(
				'id_usuario_doctor'    => '',
				'id_tipo_estado'       => '',
				'id_tipo_especialidad' => '',
				'id_tipo_municipio'    => '',
				'id_usuario'           => '', 
			);
			$especialidades = $this->t_cita_model->consulta_especialidades_existentes($arreglo);
			$doctores       = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);
			$this->layout->view('agendar/agendar_especialidad', compact('especialidades', 'doctores'));
		}
	}

	public function enviar_solicitud($id_doctor, $id_paciente){
		/**
		* Envia la solicitud de un paciente a un doctor, tambien le envia un correo 
		* electronico al doctor de que tiene una invotacion
		**/			
		$arreglo = array(
			'id_usuario_doctor'   => decodificar($id_doctor),
			'id_usuario_paciente' => decodificar($id_paciente)
		);
		$amistad = $this->t_amigos_model->insertar_amigos($arreglo);
		$this->layout->view('solicitud_amistad_enviada');
	}

	public function ingresar_carnet(){
		/**
		* El usuario envia el carnet de colegiado para validar
		* la información y colocarlo como doctor de la aplicacion
		**/				
		$arreglo      = array(
			'id_usuario'  => $this->id_usuario,
			'carnet'      => $this->input->post("i_carnet"),
		);			
		$carnet  = $this->t_documentos_doctor_model->insertar_carnet($arreglo);		
		$this->layout->view('carnet_enviado');
	}

	public function perfil(){
		/**
		* Se muestra el perfil del usuario
		**/	
		$this->layout->setTitle('.: Nuevo Perfil :.');		
		$resumen_perfil   = $this->datos_perfil;
		$arreglo = array(
			'id_aplicacion' => $this->id_aplicacion,
			'id_usuario'    => $this->id_usuario						
		);
		
		foreach ($this->validar_perfil as $key) { $i = $key->nombre_apellido;}
		if($i != 0){
			$this->layout->view('perfil/perfil_resumen', compact('arreglo', 'resumen_perfil'));
		}else{
			$this->layout->view('perfil/perfil_usuario', compact('arreglo'));
		}	

	}

	function perfil_agregar(){
		/**
		* Insertando los datos del perfil
		**/
		if ($this->input->post()){
			$arreglo = array(
				'nombre' 			=> $this->input->post("i_nombre"),
				'apellido' 			=> $this->input->post("i_apellido"),
				'cedula' 			=> $this->input->post("i_cedula"),
				'telefono' 			=> $this->input->post("i_telefono"),	
				'fecha_nacimiento' 	=> $this->input->post("i_fecha_nacimiento"),
				'direccion' 		=> $this->input->post("i_direccion"),						
				'id_usuario' 		=> $this->input->post("id_usuario"),
				'sexo_perfil'    	=> $this->input->post("i_sexo"),
				'portal_web_perfil' => ($this->input->post("i_portal_web")) ? $this->input->post("i_portal_web") : '',
				'id_aplicacion'     => $this->id_aplicacion
			);
			$this->t_perfil_model->actualizar_perfil($arreglo);			
		}
	}

	public function perfil_contrasena(){
		/**
		* Modulo para cambiar la contraseña
		**/
		$this->layout->setTitle('.: Editar contrasena :.');		
		$arreglo = array(
			'id_usuario' => $this->id_usuario						
		);
		$datos_usuario = $this->t_usuario_model->consultar_usuario($arreglo);
		$this->layout->view('perfil/perfil_contrasena_password', compact('datos_usuario'));
	}

	public function perfil_editar_contrasena(){
		/**
		*	Datos para modificar la contraseña
		**/
		if ($this->input->post()){
			$arreglo = array(
				'correo_usuario' 		 => $this->input->post("i_correo"),
				'clave_usuario'  		 => $this->input->post("i_contrasena"),
				'repetir_clave_usuario'  => $this->input->post("i_repetir_contrasena"),
			);
			$this->t_usuario_model->editar_clave_usuario($arreglo);		
		}
	}

	public function perfil_editar(){
		/**
		*	Modulo para editar el perfil
		**/
		$this->layout->setTitle('.: Editar perfil :.');		
		$arreglo = array(
			'id_usuario' => $this->id_usuario						
		);
		$datos_perfil = $this->t_perfil_model->consultar_perfil($arreglo);
		$this->layout->view('perfil/perfil_editar', compact('datos_perfil', 'arreglo'));
	}

	public function perfil_actualizar(){
		/**
		*	Se envian los datos del perfil a actualizar
		**/
		$arreglo = array(
			'id_usuario' 		=> $this->input->post("id_usuario"),
			'nombre'  		    => $this->input->post("i_nombre"),
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

	public function foto(){
		/**
		* Proceso para subir la foto del paciente
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

		$this->layout->view('perfil/subir_foto', $data);	
	}

	public function paciente($id_cita){	
		/**
		*	Se envia el id_cita para conocer los detalles
		* de la cita seleccionada.
		**/		
		$arreglo      = array(
			'id_cita' => decodificar($id_cita),
		);			
		$leido        = $this->t_cita_model->notificacion_leida_paciente($arreglo);
		$detalle_cita = $this->t_cita_model->consulta_detalle_notificacion($arreglo);			
		$this->layout->view('notificacion_paciente', compact('detalle_cita'));
			
	}

	public function amistad($id_usuario){	
		/**
		*	Se envia el id del usuario para ver su perfil
		**/		
		$arreglo      = array(
			'id_usuario'          => decodificar($id_usuario),
			'id_usuario_doctor'   => decodificar($id_usuario),
			'id_usuario_paciente' => $this->session->userdata('id_usuario'),
		);
		$resumen_perfil = $this->t_perfil_model->consultar_perfil($arreglo);
		$amistad        = $this->t_amigos_model->consulta_status_amistad($arreglo);							
		$this->layout->view('solicitud_amistad', compact('resumen_perfil', 'amistad'));
			
	}

}
