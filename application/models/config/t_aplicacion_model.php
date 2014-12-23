<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_aplicacion_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->nombre_aplicacion = '';
		$this->icono_aplicacion  = '';
		$this->url_aplicacion    = '';
		$this->id_aplicacion     = '';
	}
	
	public function getAplicacion(){
		$this->accion = 'consulta_maestro';
		$query        = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db
		->query(
			"CALL p_t_aplicacion (
				'".$this->accion."', #accion
				'".strtolower(utf8_encode($this->nombre_aplicacion))."', #nombre_aplicacion
				'".$this->icono_aplicacion."', #icono_aplicacion
				'".$this->url_aplicacion."', #url_aplicacion
				'".$this->id_aplicacion."' #id_aplicacion
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