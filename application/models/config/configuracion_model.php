<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->id_aplicacion = '';
		$this->id_menu       = '';
		$this->id_grupo      = '';
	}
	
	public function menu_asignados($arreglo = array()){
		$this->accion        = 'grupo_menu';
		$this->id_aplicacion = $arreglo['id_aplicacion'];
		$this->id_grupo      = $arreglo['id_grupo'];
		$this->id_menu       = $arreglo['id_menu'];
		$query               = $this->_enviar_parametros();
		return $query;
	}

	public function grupos_asignados($arreglo = array()){
		$this->accion        = 'aplicacion_usuario';
		$this->id_aplicacion = $arreglo['id_aplicacion'];
		$this->id_grupo      = $arreglo['id_grupo'];
		$query               = $this->_enviar_parametros();
		return $query;
	}

	public function seccion_asignada($arreglo = array()){
		$this->accion        = 'raiz_asignado';
		$this->id_grupo      = $arreglo['id_grupo'];
		$query               = $this->_enviar_parametros();
		return $query;
	}	

	function _enviar_parametros(){  

		$procedure = $this->db
		->query(
			"CALL p_configuracion (
				'".$this->accion."', #accion
				'".$this->id_aplicacion."', #id_aplicacion
				'".$this->id_menu."', #id_menu
				'".$this->id_grupo."' #id_grupo
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