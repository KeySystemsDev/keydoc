<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_documentos_doctor_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	                      = $this->load->database('aplicacion', true);		
		$this->id_usuario  	                      = '';
		$this->numero_colegiado_documentos_doctor = '';
	} 
	
	public function insertar_carnet($arreglo = array()){
		$this->accion     	                        = 'insertar';
		$this->id_usuario 	                        = $arreglo['id_usuario'];
		$this->numero_colegiado_documentos_doctor 	= $arreglo['carnet'];

		$query            	                        = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_carnet($arreglo = array()){
		$this->accion     = 'consulta_carnet';
		$this->id_usuario = $arreglo['id_usuario'];

		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_doctores_por_validar_carnet($arreglo = array()){
		$this->accion = 'doctores_por_validar_carnet';

		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function validar_carnet($arreglo = array()){
		$this->accion     = 'validar_carnet';
		$this->id_usuario = $arreglo['id_usuario'];

		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_existencia_carnet($arreglo = array()){
		$this->accion     = 'existencia_carnet';
		$this->id_usuario = $arreglo['id_usuario'];

		$query            = $this->_enviar_parametros();
		return $query;
		
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_documentos_doctor (
				'".$this->accion."', #accion
				'".$this->id_usuario."', #id_usuario
				'".$this->numero_colegiado_documentos_doctor."' #numero_colegiado_documentos_doctor
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