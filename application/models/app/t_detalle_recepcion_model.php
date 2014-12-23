<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_detalle_recepcion_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	        = $this->load->database('aplicacion', true);		
		$this->id_consultorio  	    = '';
		$this->id_usuario_paciente  = '';
		$this->id_usuario_doctor    = '';
		$this->id_detalle_recepcion = '';
		$this->id_horario           = '';
	} 
	
	public function insertar_recepcionista($arreglo = array()){
		$this->accion     	        = 'insertar';
		$this->id_consultorio 	    = $arreglo['id_consultorio'];
		$this->id_usuario_paciente	= $arreglo['id_usuario_paciente'];
		$this->id_usuario_doctor 	= $arreglo['id_usuario_doctor'];

		$query            	        = $this->_enviar_parametros();
		return $query;
	}

	public function deshabilitar_recepcionista($arreglo = array()){
		$this->accion     	        = 'eliminar';
		$this->id_detalle_recepcion = $arreglo['id_detalle_recepcion'];

		$query            	        = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_doctor_por_consultorio_recepcionista($arreglo = array()){
		$this->accion     	       = 'doctor_por_consultorio';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_horarios_doctor_consultorio($arreglo = array()){
		$this->accion     	       = 'horarios_doctor_consultorio';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_consultorio_recepcionista_doctor($arreglo = array()){
		$this->accion     	       = 'consultorio_recepcionista_doctor';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_numero_citas_consultorio($arreglo = array()){ //Ready
		$this->accion     	  = 'numero_citas_consultorio';
		$this->id_consultorio = $arreglo['id_consultorio'];
		
		$query            	  = $this->_enviar_parametros();
		return $query;

		
	}

	
	public function consultar_horarios_del_dia_doctor($arreglo = array()){ //Ready
		$this->accion     	     = 'horarios_del_dia_doctor';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

	}

	public function consultar_citas_por_horario($arreglo = array()){ //Ready
		$this->accion     = 'citas_por_horario';
		$this->id_horario = $arreglo['id_horario'];

	}	

	
	public function consultar_horarios_disponible_info($arreglo = array()){ //Ready
		$this->accion     	  = 'horarios_disponible_info';
		$this->id_consultorio = $arreglo['id_consultorio'];

	}	


	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_detalle_recepcion(
				'".$this->accion."', #accion
				'".$this->id_consultorio."', #id_consultorio
				'".$this->id_usuario_paciente."', #id_usuario_paciente
				'".$this->id_usuario_doctor."', #id_usuario_doctor
				'".$this->id_detalle_recepcion."', #id_detalle_recepcion
				'".$this->id_horario."' #id_horario
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