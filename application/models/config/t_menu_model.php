<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_menu_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->id_aplicacion       = '';
		$this->id_submenu_menu     = '';
		$this->icono_menu          = '';
		$this->acceso_directo_menu = '';
		$this->nombre_menu         = '';
		$this->link_menu           = '';
		$this->id_menu             = '';
	}
	
	public function getMenuRaiz(){
		$this->accion = 'consulta_menu_raiz';
		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function menu_dependiente($arreglo = array()){
		$this->accion  = 'consulta_menu_dependiente';
		$this->id_menu = $arreglo['id_menu'];		
		$query         = $this->_enviar_parametros();
		return $query;
	}	

	function _enviar_parametros(){  
		$procedure = $this->db
		->query(
			"CALL p_t_menu (
				'".$this->accion."', #accion
				'".$this->id_aplicacion."', #id_aplicacion
				'".$this->id_submenu_menu."', #id_submenu_menu
				'".$this->icono_menu."', #icono_menu
				'".$this->acceso_directo_menu."', #acceso_directo_menu
				'".$this->nombre_menu."', #nombre_menu
				'".$this->link_menu."', #link_menu
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