<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_bitacora_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	        = $this->load->database('aplicacion', true);		
		$this->id_usuario           = '';
		$this->id_grupo             = '';
		$this->descripcion_bitacora = '';
	} 
	
	public function insertar_bitacora($arreglo = array()){
		$this->accion     			= 'insertar';
		$this->id_usuario 			= $arreglo['id_usuario'];
		$this->id_grupo  	        = $arreglo['id_grupo'];
		$this->descripcion_bitacora = $arreglo['descripcion_bitacora'];

		$query            			= $this->_enviar_parametros();
		return $query;
	}

	public function consulta_bitacora(){
		$this->accion = 'consulta_bitacora';

		$query        = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_bitacora (
				'".$this->accion."', #accion
				'".$this->id_usuario."', #id_usuario
				'".$this->id_grupo."', #id_grupo
				'".$this->descripcion_bitacora."' #descripcion_bitacora
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