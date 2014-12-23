<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_horario_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      		    = $this->load->database('aplicacion', true);		
		$this->costo_horario        = '';
		$this->desde_hora_horario   = '';
		$this->hasta_hora_horario   = '';
		$this->id_consultorio       = '';
		$this->fecha_horario        = '';
		$this->id_tipo_especialidad = '';
		$this->id_usuario           = '';
		$this->id_horario           = '';
		$this->cupos_horario        = '';
		$this->id_tipo_estado       = '';
		$this->id_tipo_municipio    = '';
	} 
	
	public function insertar_horario($arreglo = array()){
		$this->accion     			= 'insertar';
		$this->costo_horario 		= $arreglo['costo_horario'];
		$this->desde_hora_horario  	= $arreglo['desde_hora_horario'];
		$this->hasta_hora_horario 	= $arreglo['hasta_hora_horario'];
		$this->id_consultorio 		= $arreglo['id_consultorio'];
		$this->fecha_horario        = $arreglo['fecha_horario'];
		$this->id_tipo_especialidad = $arreglo['id_tipo_especialidad'];
		$this->id_usuario 		    = $arreglo['id_usuario'];
		$this->cupos_horario 		= $arreglo['cupos_horario'];

		$query            			= $this->_enviar_parametros();
		return $query;
	}

	public function editar_horario($arreglo = array()){
		$this->accion     		  = 'editar';
		$this->id_horario 		  = $arreglo['id_horario'];
		$this->id_usuario 		  = $arreglo['id_usuario'];
		$this->costo_horario 	  = $arreglo['costo_horario'];
		$this->desde_hora_horario = $arreglo['desde_hora_horario'];
		$this->hasta_hora_horario = $arreglo['hasta_hora_horario'];
		$this->fecha_horario 	  = $arreglo['fecha_horario'];
		$this->cupos_horario 	  = $arreglo['cupos_horario'];

		$query            		  = $this->_enviar_parametros();
		return $query;
	}

	public function consultar(){
		$this->accion = 'consulta_maestro';

		$query 		  = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_horario($arreglo = array()){
		$this->accion    	= 'consulta_horario';
		$this->id_horario = $arreglo['id_horario'];

		$query 						= $this->_enviar_parametros();
		return $query;
	}

	public function consultar_horario_por_usuario($arreglo = array()){
		$this->accion      = 'consulta_horario_usuario';
		$this->id_usuario  = $arreglo['id_usuario'];

		$query 			   = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_horario_por_usuario_especialidad($arreglo = array()){
		$this->accion    	        = 'consulta_horario_usuario_especialidad';
		$this->id_usuario           = $arreglo['id_usuario'];
		$this->id_tipo_especialidad = $arreglo['id_tipo_especialidad'];
		$this->id_tipo_estado       = $arreglo['id_tipo_estado'];
		$this->id_tipo_municipio    = $arreglo['id_tipo_municipio'];

		$query 						= $this->_enviar_parametros();
		return $query;
	}	

	public function consultar_consultorios_paciente($arreglo = array()){
		$this->accion    	 	   = 'consulta_consultorios';
		$this->nombre_especialidad = $arreglo['especialidad'];

		$query 					   = $this->_enviar_parametros();
		return $query;
	}	

	public function consultar_doctores_paciente($arreglo = array()){
		$this->accion    	 	   = 'consulta_nombres_usuarios';
		$this->nombre_especialidad = $arreglo['especialidad'];
		$this->nombre_consultorio  = $arreglo['consultorio'];

		$query 					   = $this->_enviar_parametros();
		return $query;
	}	

	public function consultar_cita_paciente($arreglo = array()){
		$this->accion    	 		= 'consulta_cita';
		$this->nombre_especialidad 	= $arreglo['especialidad'];
		$this->nombre_consultorio 	= $arreglo['consultorio'];
		$this->id_horario 			= $arreglo['horario'];

		$query 						= $this->_enviar_parametros();
		return $query;
	}

	public function eliminar_horario($arreglo = array()){
		$this->accion     = 'eliminar';
		$this->id_horario = $arreglo['id_horario'];

		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_doctores_por_filtros($arreglo = array()){
		$this->accion               = 'doctores_por_filtros';
		$this->id_usuario           = $arreglo['id_usuario'];
		$this->id_tipo_estado       = $arreglo['id_tipo_estado'];
		$this->id_tipo_especialidad = $arreglo['id_tipo_especialidad'];
		$this->id_tipo_municipio    = $arreglo['id_tipo_municipio'];

		$query                      = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_horario (
				'".$this->accion."', #accion
				'".$this->costo_horario."', #costo_horario
				'".$this->desde_hora_horario."', #desde_hora_horario
				'".$this->hasta_hora_horario."', #hasta_hora_horario
				'".$this->id_consultorio."', #id_consultorio
				'".fecha_php_to_mysql($this->fecha_horario)."', #fecha_horario
				'".$this->id_tipo_especialidad."', #id_tipo_especialidad
				'".$this->id_usuario."', #id_usuario
				'".$this->id_horario."', #id_horario
				'".$this->cupos_horario."', #cupos_horario
				'".$this->id_tipo_estado."', #cupos_horario
				'".$this->id_tipo_municipio."' #cupos_horario
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