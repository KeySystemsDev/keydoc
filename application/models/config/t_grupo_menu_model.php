<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_grupo_menu_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->id_grupo_menu = '';
		$this->id_grupo      = '';
		$this->id_menu       = '';
	}
	
	public function insertar_grupo_menu($arreglo = array()){
		$this->accion   = 'insertar';
		$this->id_grupo = $arreglo['id_grupo'];
		$this->id_menu  = $arreglo['id_menu'];	
		$query          = $this->_enviar_parametros();
		return $query;
	}

	public function habilitar_grupo_menu($arreglo = array()){
		$this->accion        = 'eliminar';
		$this->id_grupo_menu = $arreglo['id_grupo_menu'];		
		$query               = $this->_enviar_parametros();
		return $query;
	}	

	function _enviar_parametros(){  
		$procedure = $this->db
		->query(
			"CALL p_t_grupo_menu (
				'".$this->accion."', #accion
				'".$this->id_grupo_menu."', #id_grupo_menu
				'".$this->id_grupo."', #id_grupo
				'".$this->id_menu."' #id_menu
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