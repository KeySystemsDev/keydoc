<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citas extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		if($this->session->userdata('usuario')){
			$this->opcion 	     = 140;
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
		$this->layout->setTitle('.: Citas :.');	
		$menu 		    = $this->menu;
		$sub_menu     = $this->sub_menu;	
		$this->layout->view('index', compact('menu', 'sub_menu', 'arreglo'));
	}

	public function agendar($url_1 = null, $url_2 = null, $url_3 = null, $url_4 = null, $url_5 = null, $url_6 = null){
		/**
		* Modulo citas/agendar
		**/
		$this->layout->setTitle('.: Agendar Citas :.');		
		$menu 	  = $this->menu;
		$sub_menu = $this->sub_menu;

		$arreglo = array(
			'id_aplicacion' => $this->id_aplicacion,
			'id_usuario'	=> $this->id_usuario					
		);

		if ($url_5 != null) {
			/**
			* Proceso donde se le envía un mensaje al usuario de que la cita fue
			* enviada al doctor exitosamente.
			**/	
			$url     = $url_1.'/'.$url_2.'/'.$url_3.'/'.$url_4.'/'.$url_5;
			$arreglo = array(
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
				if (isset($key->doctor)) {
					$this->layout->view('menu', 'sub_menu', 'agendar/agendar_mensaje_envio', compact('arreglo'));
				} else {
					$this->layout->view('menu', 'sub_menu', 'agendar/agendar_mensaje_cita_error', compact('arreglo'));
				}
			}
		} elseif ($url_4 != null){ 
			/**
			*	Proceso donde se muestra el perfil del doctor seleccionado
			**/					
			$id_usuario = (isset($this->id_usuario)) ? $this->id_usuario : '';				
			$url        = $url_1.'/'.$url_2.'/'.$url_3.'/'.$url_4;
			$id_doctor  = decodificar($url_4);
			$arreglo    = array(
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
			$this->layout->view('agendar/agendar_horario', compact('menu', 'sub_menu', 'arreglo', 'url', 'doctor', 'horarios', 'amistad', 'id_doctor', 'especialidad', 'estado', 'municipio', 'url_1', 'url_2', 'url_3'));
		} elseif ($url_3 != null){ 				
			/**
			*	Proceso donde se muestra los doctores asociado al municipio seleccionado
			**/			
			$url     = $url_1.'/'.$url_2.'/'.$url_3;
			$arreglo = array(
				'especialidad'         => decodificar($url_1),
				'url'                  => $url,
				'id_usuario_doctor'    => $this->id_usuario,
				'id_tipo_estado'       => decodificar($url_2),
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => decodificar($url_3),
				'id_usuario'           => $this->id_usuario, 				
			);		
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estado       = $this->t_tipo_model->consulta_estado($arreglo);	
			$municipio    = $this->t_tipo_model->consulta_municipio($arreglo);	
			$doctores     = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);	
			$this->layout->view('agendar/agendar_doctor', compact('menu', 'sub_menu', 'arreglo', 'url', 'doctores', 'especialidad', 'estado', 'municipio', 'url_1', 'url_2'));
		} elseif ($url_2 != null){
			/**
			*	Proceso donde se muestra los municipios asociados al estado seleccionado
			**/			
			$url     = $url_1.'/'.$url_2;
			$arreglo = array(
				'especialidad'         => decodificar($url_1),
				'url'                  => $url,
				'id_usuario_doctor'    => $this->id_usuario,
				'id_tipo_estado'       => decodificar($url_2),
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => '', 
				'id_usuario'           => $this->id_usuario,				
			);	
			
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estado       = $this->t_tipo_model->consulta_estado($arreglo);
			$municipios   = $this->t_cita_model->consulta_municipio_por_estado($arreglo);
			$doctores     = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);
			$this->layout->view('agendar/agendar_municipio', compact('menu', 'sub_menu', 'arreglo', 'url', 'municipios', 'especialidad', 'estado', 'url_1', 'doctores'));
		} elseif ($url_1 != null){ 
			/**
			*	Proceso donde se muestra los estados asociados a la especialidad seleccionada
			**/
			$url     = $url_1;
			$arreglo = array(
				'url'                  => $url,
				'id_maestro'           => 3,
				'id_usuario_doctor'    => $this->id_usuario,
				'id_tipo_estado'       => '',
				'id_tipo_especialidad' => decodificar($url_1),
				'id_tipo_municipio'    => '', 
				'id_usuario'           => $this->id_usuario,
			);			
			$especialidad = $this->t_tipo_model->consulta_especialidad($arreglo);
			$estados      = $this->t_cita_model->consulta_estado_especialidad($arreglo);
			$doctores     = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);	
			$this->layout->view('agendar/agendar_estado', compact('menu', 'sub_menu', 'arreglo', 'estados', 'url', 'especialidad', 'doctores'));
		} else {
			/**
			*	Inicio del proceso, donde el usuario seleccionara la especialidad
			**/
			$arreglo = array(
				'id_usuario_doctor'    => $this->id_usuario,
				'id_tipo_estado'       => '',
				'id_tipo_especialidad' => '',
				'id_tipo_municipio'    => '', 
				'id_usuario'           => $this->id_usuario,
			);
			$especialidades = $this->t_cita_model->consulta_especialidades_existentes($arreglo);
			$doctores       = $this->t_horario_model->consulta_doctores_por_filtros($arreglo);
			$this->layout->view('agendar/agendar_especialidad', compact('menu', 'sub_menu', 'especialidades', 'doctores'));
		}
	}

    public function agendar_horario($id_doctor, $id_horario){
        /**
        *   Se consulta el perfil del doctor con todos sus horarios
        **/ 
        $menu     = $this->menu;
        $sub_menu = $this->sub_menu;
        $arreglo  = array(
            'id_usuario_doctor'   => decodificar($id_doctor),
            'id_horario'          => decodificar($id_horario),          
            'id_usuario_paciente' => $this->id_usuario,
        );
        $cita_actual = $this->t_cita_model->agregar_cita($arreglo);
        foreach ($cita_actual as $key) {
            /**
            *   Se verifica que el usuario no haya agendado anteriormente
            **/             
            if (isset($key->doctor)) {
                $this->layout->view('agendar/agendar_mensaje_envio', compact('menu', 'sub_menu', 'arreglo'));
            } else {
                $this->layout->view('agendar/agendar_mensaje_cita_error', compact('menu', 'sub_menu', 'arreglo'));
            }
        }       
    } 

	public function perfil($id_doctor){
		/**
		*	Se consulta el perfil del doctor con todos sus horarios
		**/	
		$menu     = $this->menu;
		$sub_menu = $this->sub_menu;					
		$arreglo  = array(
			'id_usuario'           => decodificar($id_doctor),
			'id_usuario_paciente'  => $this->id_usuario,
			'id_usuario_doctor'    => decodificar($id_doctor),
		);			
		$amistad  = $this->t_amigos_model->consulta_status_amistad($arreglo);
		$doctor   = $this->t_perfil_model->consultar_perfil($arreglo);
		$horarios = $this->t_horario_model->consultar_horario_por_usuario($arreglo);			
		$this->layout->view('perfil_doctor_horario', compact('menu', 'sub_menu', 'arreglo', 'doctor', 'horarios', 'amistad', 'id_doctor'));
	}	


	public function agendar_actualizar_perfil(){			
		if ($this->input->post()){
			$arreglo = array(
				'id_usuario' 			  => $this->input->post("id_usuario"),
				'nombre_perfil' 		  => $this->input->post("i_nombre"),
				'apellido_perfil' 		  => $this->input->post("i_apellido"),
				'cedula_perfil' 		  => $this->input->post("i_cedula"),
				'fecha_nacimiento_perfil' => $this->input->post("i_fecha_nacimiento"),
				'telefono_perfil' 		  => $this->input->post("i_telefono"),
				'direccion_perfil' 		  => $this->input->post("i_direccion"),						
			);
			$this->t_perfil_model->actualizar_perfil($arreglo);			
		}
		redirect(base_url().'citas/agendar', 'refresh');	
	}

	public function citas_eliminar_todas(){
		/**
		* Se eliminan todas las citas
		* ------ se debe terminar el envio de correo a todos
		* ------ los pacientes
		*/
		$arreglo = array(
			'id_horario' 						=> $this->input->post("id_horario"),
			'id_usuario_doctor'   			    => $this->id_usuario,
			'descripcion_detalle_rechazo_cita'  => $this->input->post("i_mensaje"),						
		);
		$this->t_cita_model->rechazar_citas_todas($arreglo);	
	}

	public function citados($url_1 = null, $url_2 = null){
		$this->layout->setTitle('.: Citados del Día :.');			
		$menu     = $this->menu;
		$sub_menu = $this->sub_menu;

		if ($url_2 != null){ 
			/**
			* Pacientes filtrados por la fecha seleccionada
			**/			
			$url     = $url_1.'/'.$url_2;
			$arreglo = array(
				'id_consultorio'    => decodificar($url_1),
				'id_horario' 	    => decodificar($url_2),
				'url' 			    => $url,
				'id_usuario_doctor' => $this->id_usuario						
			);
			$consultorio  = $this->t_consultorio_model->consulta_nombre_consultorio($arreglo);			
			$fecha        = $this->t_horario_model->consultar_horario($arreglo);		
			$pacientes    = $this->t_cita_model->consulta_pacientes_citados_dia_consultorio($arreglo);
			$this->layout->view('citados/citados_consultorio_dia', compact('menu', 'sub_menu', 'arreglo', 'url', 'pacientes', 'consultorio', 'fecha'));	
		}elseif ($url_1 != null){
			/**
			* Pacientes filtrados por el consultorio seleccionado
			**/
			$url  = $url_1;
			$arreglo = array(
				'id_consultorio'    => decodificar($url_1),
				'url' 				=> $url,
				'id_usuario_doctor' => $this->id_usuario						
			);
			$consultorio  = $this->t_consultorio_model->consulta_nombre_consultorio($arreglo);			
			$fechas       = $this->t_cita_model->consulta_fechas_citados_por_consultorio($arreglo);
			$citados      = $this->t_cita_model->consulta_todos_los_citados_doctor($arreglo);
			$this->layout->view('citados/citados_consultorio_fechas', compact('menu', 'sub_menu', 'arreglo', 'url', 'fechas', 'citados', 'consultorio'));
		}else{
			/**
			* Se envian los citados de todos los consultorios
			**/
			$arreglo = array(
				'id_usuario_doctor' => $this->id_usuario,
				'id_consultorio'    => ''
			);
			$consultorios = $this->t_cita_model->consulta_direccion_doctores($arreglo);
			$citados      = $this->t_cita_model->consulta_todos_los_citados_doctor($arreglo);
			$this->layout->view('citados/citados_consultorios_doctor', compact('menu', 'sub_menu', 'consultorios', 'citados'));	
		}
	}

	public function citados_agregar_observacion(){			
		/**
		* Se agrega la observacion del citado
		**/
		if ($this->input->post()){
			$arreglo = array(
				'observacion_publica' 	   => $this->input->post("i_observacion_publica"),
				'observacion_privada' 	   => $this->input->post("i_observacion_privada"),
				'costo_consulta_adicional' => $this->input->post("i_costo_adicional"),
				'costo_consulta_total' 	   => $this->input->post("i_costo_total"),
				'costo_minimo' 			   => $this->input->post("i_costo_minimo"),
				'id_cita' 				   => $this->input->post("id_cita"),
				'id_consultorio' 		   => $this->input->post("id_consultorio"),
				'id_paciente' 			   => $this->input->post("id_paciente")						
			);
			$this->t_detalle_observacion_model->insertar_observacion($arreglo);	
			redirect(base_url().'citas/citados/consultorio-'.$arreglo['id_consultorio'].'/paciente-'.$arreglo['id_paciente'], 'refresh');		
		}	
	}

    public function historia($url_1 = null, $url_2 = null){
        $this->layout->setTitle('.: Atender Paciente :.');           
        $menu     = $this->menu;
        $sub_menu = $this->sub_menu;        
        /**
        * Proceso para atender al paciente citado del dia
        **/ 

        if ($url_2 != null){
            /**
            * Pacientes filtrados por el consultorio seleccionado
            **/
            $cedula  = decodificar($url_1);
            $cita    = decodificar($url_2);

            $this->layout->view('historia/historia_formulario', compact('menu', 'sub_menu'));
        }elseif ($url_1 != null){
            /**
            * Pacientes filtrados por el consultorio seleccionado
            **/
           	$url = $url_1;
            $arreglo = array(               
                'id_usuario_doctor' => $this->id_usuario,
                'cedula_perfil'     => decodificar($url_1)                       
            );
            $historial = $this->t_cita_model->consulta_paciente_por_cedula($arreglo);
            $paciente  = $this->t_cita_model->consulta_paciente_por_cedula($arreglo);
            $this->layout->view('historia/historia_paciente', compact('menu', 'sub_menu', 'historial', 'paciente', 'url')); 
        }else{
            /**
            * Aparecen todos los pacientes del doctor
            **/
            $arreglo = array(
                'id_usuario_doctor' => $this->id_usuario                        
            );
            $pacientes    = $this->t_cita_model->consulta_todos_los_citados($arreglo);                        
            $this->layout->view('historia/historia', compact('menu', 'sub_menu', 'pacientes')); 
        }        
        
    }
}