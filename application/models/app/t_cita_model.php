<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_cita_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	                    = $this->load->database('aplicacion', true);	
		$this->id_consultorio                   = ''; 
		$this->id_horario                       = ''; 
		$this->id_usuario_doctor                = ''; 
		$this->id_cita                          = ''; 
		$this->id_tipo_especialidad             = ''; 
		$this->id_tipo_estado                   = '';
		$this->dep_ref_cita       	            = '';
		$this->id_usuario_paciente              = '';
		$this->fecha_agenda                     = '';
		$this->descripcion_detalle_rechazo_cita = ''; 
		$this->id_tipo_municipio 				= '';	
		$this->fecha_desde 					    = '';	
		$this->fecha_hasta 					    = '';	
		$this->letra_inicial 					= '';
		$this->cedula_perfil 					= '';	 	
	
	} 

	public function agregar_cita($arreglo = array()){
		$this->accion     	        = 'insertar';
		$this->id_horario 			= $arreglo['id_horario'];
		$this->id_usuario_doctor 	= $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente 	= $arreglo['id_usuario_paciente'];

		$query            	        = $this->_enviar_parametros();
		return $query;
	}

	public function agregar_deposito($arreglo = array()){
		$this->accion     	       = 'insert_ref_dep';
		$this->dep_ref_cita        = $arreglo['deposito_referencia'];
		$this->id_cita 			   = $arreglo['id_cita'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function editar_cita($arreglo = array()){
		$this->accion     	       = 'editar';
		$this->id_consultorio      = $arreglo['id_consultorio'];
		$this->id_horario          = $arreglo['id_horario'];
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];
		$this->id_cita             = $arreglo['id_cita'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function eliminar_cita($arreglo = array()){
		$this->accion  = 'eliminar';
		$this->id_cita = $arreglo['id_cita'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function consultar(){
		$this->accion = 'consulta_maestro';

		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_paciente(){
		$this->accion = 'consulta';

		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_citas_paciente($arreglo = array()){
		$this->accion 			   = 'consulta_citas';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query        						 = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_fecha_por_cita($arreglo = array()){
		$this->accion 	= 'fecha_por_cita';
		$this->id_cita  = $arreglo['id_cita'];

		$query        	= $this->_enviar_parametros();
		return $query;
	}
	
	public function consulta_estado_especialidad($arreglo = array()){
		$this->accion     	        = 'estado_por_especialidad';
		$this->id_tipo_especialidad = $arreglo['id_tipo_especialidad'];
		$this->id_usuario_doctor    = $arreglo['id_usuario_doctor'];

		$query            	        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_especialidad_doctor($arreglo = array()){
		$this->accion     	     = 'especialidad_por_doctores';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query            	     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_municipio_por_estado($arreglo = array()){
		$this->accion     	        = 'municipio_por_estado';
		$this->id_tipo_estado       = $arreglo['id_tipo_estado'];
		$this->id_tipo_especialidad = $arreglo['especialidad'];
		$this->id_usuario_doctor    = $arreglo['id_usuario_doctor'];

		$query            	        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_doctores_todos(){
		$this->accion = 'lista_doctores';

		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_doctores_estado($arreglo = array()){
		$this->accion     	  = 'doctores_por_estado';
		$this->id_tipo_estado = $arreglo['id_tipo_estado'];

		$query            	  = $this->_enviar_parametros();
		return $query;
	}	

	public function consulta_doctores_municipio($arreglo = array()){
		$this->accion     	  		= 'doctores_por_municipio';
		$this->id_tipo_municipio 	= $arreglo['id_tipo_municipio'];
		$this->id_tipo_especialidad = $arreglo['especialidad'];
		$this->id_tipo_estado       = $arreglo['id_tipo_estado'];
		$this->id_usuario_doctor    = $arreglo['id_usuario_doctor'];

		$query            	  		= $this->_enviar_parametros();
		return $query;
	}	

	public function consulta_direccion_doctores($arreglo = array()){
		$this->accion     	     = 'direccion_por_doctor';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query            	     = $this->_enviar_parametros();
		return $query;
	}	

	public function aprobar_cita($arreglo = array()){
		$this->accion              = 'aprob_fecha_cita';
		$this->id_cita             = $arreglo['id_cita'];
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query         			   = $this->_enviar_parametros();
		return $query;
	}

	public function rechazar_cita($arreglo = array()){
		$this->accion                           = 'rechazar_fecha_cita';
		$this->id_cita                          = $arreglo['id_cita'];
		$this->descripcion_detalle_rechazo_cita = $arreglo['descripcion_detalle_rechazo_cita'];

		$query                                  = $this->_enviar_parametros();
		return $query;
	}

	public function rechazar_citas_todas($arreglo = array()){
		$this->accion                           = 'rechazar_todas_citas';
		$this->id_horario                       = $arreglo['id_horario'];
		$this->id_usuario_doctor                = $arreglo['id_usuario_doctor'];
		$this->descripcion_detalle_rechazo_cita = $arreglo['descripcion_detalle_rechazo_cita'];

		$query                                  = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_amistad($arreglo = array()){
		$this->accion              = 'consulta_amistad';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query         			   = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_doctores_amigos($arreglo = array()){
		$this->accion              = 'consulta_doctores_amigos';
		$this->id_usuario_paciente = $arreglo['id_usuario'];

		$query         			   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_notificacion_doctor($arreglo = array()){
		$this->accion     	     = 'notificacion_doctor';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query            	     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_detalle_notificacion($arreglo = array()){
		$this->accion  = 'detalle_notificacion';
		$this->id_cita = $arreglo['id_cita'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_notificacion_paciente($arreglo = array()){
		$this->accion     	       = 'notificacion_paciente';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_estatus_citas_paciente($arreglo = array()){
		$this->accion     	       = 'status_citas_paciente';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_record_paciente_inasistencia($arreglo = array()){
		$this->accion     	       = 'record_paciente_inasistencia';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_record_paciente_asistencia($arreglo = array()){
		$this->accion     	       = 'record_paciente_asistencia';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_dias_por_doctor_consultorio($arreglo = array()){
		$this->accion     	     = 'dias_por_doctor_consultorio';
		$this->id_consultorio    = $arreglo['id_consultorio'];
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query            	     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_fechas_citados_por_consultorio($arreglo = array()){
		$this->accion     	     = 'fechas_citados_por_consultorio';
		$this->id_consultorio    = $arreglo['id_consultorio'];
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query            	  	 = $this->_enviar_parametros();
		return $query;

	}

	public function consulta_pacientes_citados_dia_consultorio($arreglo = array()){
		$this->accion     	     = 'pacientes_citados_dia_consultorio';
		$this->id_consultorio    = $arreglo['id_consultorio'];
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];
		$this->id_horario        = $arreglo['id_horario'];

		$query            	     = $this->_enviar_parametros();
		return $query;

	}

	public function consulta_pacientes_citados_dia_actual_consultorio($arreglo = array()){
		$this->accion     	     = 'pacientes_citados_dia_actual_consultorio';
		$this->id_consultorio    = $arreglo['id_consultorio'];
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];
		$this->id_horario        = $arreglo['id_horario'];

		$query            	     = $this->_enviar_parametros();
		return $query;

	}

	public function consulta_pacientes_nuevos($arreglo = array()){
		$this->accion     	     = 'pacientes_nuevos';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query            	     = $this->_enviar_parametros();
		return $query;

	}

	public function consulta_detalle_rechazo_cita($arreglo = array()){
		$this->accion  				= 'detalle_rechazo_cita';
		$this->id_cita 				= $arreglo['id_cita'];
		$this->id_usuario_paciente  = $arreglo['id_usuario_paciente'];

		$query         				= $this->_enviar_parametros();
		return $query;
	}

	public function consulta_especialidades_existentes($arreglo = array()){
		$this->accion             = 'lista_especialidades';
		$this->id_usuario_doctor  = $arreglo['id_usuario_doctor'];

		$query                    = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_citas_agendadas_paciente($arreglo = array()){
		$this->accion               = 'ver_citas_agendadas';
		$this->id_usuario_paciente  = $arreglo['id_usuario_paciente'];

		$query                      = $this->_enviar_parametros();
		return $query;
	}

	public function leida_notificacion_doctor($arreglo = array()){
		$this->accion   = 'leida_notificacion_doctor';
		$this->id_cita  = $arreglo['id_cita'];

		$query          = $this->_enviar_parametros();
		return $query;
	}

	public function leida_notificacion_paciente($arreglo = array()){
		$this->accion   = 'leida_notificacion_paciente';
		$this->id_cita  = $arreglo['id_cita'];

		$query          = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_historial_pacientes_doctor($arreglo = array()){
		$this->accion   			 = 'historial_pacientes_doctor';
		$this->id_tipo_especialidad  = $arreglo['id_tipo_especialidad'];
		$this->id_usuario_doctor     = $arreglo['id_usuario_doctor'];
		$this->fecha_desde           = $arreglo['fecha_desde'];
		$this->fecha_hasta           = $arreglo['fecha_hasta'];

		$query                       = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_historial_paciente_inicial_doctor($arreglo = array()){
		$this->accion   		 = 'historial_paciente_inicial_doctor';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];
		$this->letra_inicial     = $arreglo['letra_inicial'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_historial_pacientes_todos($arreglo = array()){
		$this->accion   		 = 'historial_pacientes_todos';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_todos_los_citados_doctor($arreglo = array()){
		$this->accion   		 = 'todos_los_citados_doctor';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];
		$this->id_consultorio    = $arreglo['id_consultorio'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_todos_los_citados($arreglo = array()){
		$this->accion   		 = 'todos_los_citados';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_paciente_por_cedula($arreglo = array()){
		$this->accion   		 = 'paciente_por_cedula';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];
		$this->cedula_perfil     = $arreglo['cedula_perfil'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function notificacion_leida_doctor($arreglo = array()){
		$this->accion  = 'notificacion_leida_doctor';
		$this->id_cita = $arreglo['id_cita'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function notificacion_leida_paciente($arreglo = array()){
		$this->accion  = 'notificacion_leida_paciente';
		$this->id_cita = $arreglo['id_cita'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_historia_paciente_doctor($arreglo = array()){
		$this->accion  = 'historia_paciente_doctor';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_monto_cita($arreglo = array()){
		$this->accion   = 'monto_cita';
		$this->id_cita  = $arreglo['id_cita'];
		$query          = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_cita (
				'".$this->accion."', #accion
				'".$this->id_consultorio."', #id_consultorio
				'".$this->id_horario."', #id_horario
				'".$this->id_usuario_doctor."', #id_usuario_doctor
				'".$this->id_cita."', #id_cita
				'".$this->id_tipo_especialidad."', #id_tipo_especialidad
				'".$this->id_tipo_estado."', #id_tipo_estado
				'".$this->dep_ref_cita."', #dep_ref_cita
				'".$this->id_usuario_paciente."', #id_usuario_paciente
				'".$this->fecha_agenda."', #fecha_agenda
				'".$this->descripcion_detalle_rechazo_cita."', #descripcion_detalle_rechazo_cita
				'".$this->id_tipo_municipio."', #id_tipo_municipio
				'".$this->fecha_desde."', #fecha_desde_global
				'".$this->fecha_hasta."', #fecha_hasta_global
				'".$this->letra_inicial."', #letra_inicial_global
				'".$this->cedula_perfil."' #cedula_perfil
			)"
		);

		$query = $procedure->result();
		$procedure->next_result();
		$procedure->free_result();
		return $query;
	}
}

/* End of file ayuda.php */
/* Location: ./application/models/ayuda.php */