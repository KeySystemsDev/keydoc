<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_aplicacion_usuario_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->id_aplicacion = '';
		$this->id_usuario    = '';
		$this->id_grupo      = '';
	}
	
	public function insertar_aplicacion_usuario($arreglo = array()){
		$this->accion        = 'insertar';
		$this->id_aplicacion = $arreglo['id_aplicacion'];
		$this->id_grupo      = $arreglo['id_grupo'];
		$this->id_usuario    = $arreglo['id_usuario'];		
		$query               = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){
		$procedure = $this->db
		->query(
			"CALL p_t_aplicacion_usuario (
				'".$this->accion."', #accion
				'".$this->id_aplicacion."', #id_aplicacion
				'".$this->id_grupo."', #id_grupo
				'".$this->id_usuario."' #id_usuario
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