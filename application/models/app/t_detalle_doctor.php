<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_detalle_doctor_especialidad_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	                  = $this->load->database('aplicacion', true);	
	   	$this->id_tipo_especialidad           = ''; 
	  	$this->id_usuario                     = '';
	  	$this->id_detalle_doctor_especialidad = ''; 	
	} 

	public function insertar_especialidad_doctor($arreglo = array()){
		$this->accion     	        = 'insertar';
		$this->id_tipo_especialidad = $arreglo['id_tipo_especialidad'];
		$this->id_usuario 			= $arreglo['id_usuario'];

		$query            	        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_especialidad_usuario($arreglo = array()){
		$this->accion     = 'consulta_especialidad_usuario';
		$this->id_usuario = $arreglo['id_usuario'];

		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function editar_especialidad($arreglo = array()){
		$this->accion                         = 'editar';
		$this->id_detalle_doctor_especialidad = $arreglo['id_detalle_doctor_especialidad'];
		$this->id_tipo_especialidad           = $arreglo['id_tipo_especialidad'];

		$query                                = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_detalle_doctor_especialidad (
				'".$this->accion."', #accion
				'".$this->id_tipo_especialidad."', #id_tipo_especialidad
				'".$this->id_usuario."', #id_usuario
				'".$this->id_detalle_doctor_especialidad."' #id_detalle_doctor_especialidad
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