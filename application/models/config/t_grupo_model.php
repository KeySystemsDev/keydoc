<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_grupo_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->nombre_grupo = '';
		$this->id_grupo     = '';
	}
	
	public function getGrupos(){
		$this->accion = 'consulta_maestro';
		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function insertar_grupo($arreglo = array()){
		$this->accion       = 'insertar';
		$this->nombre_grupo = $arreglo['nombre_grupo'];		
		$query              = $this->_enviar_parametros();
		return $query;
	}

	public function habilitar_grupo($arreglo = array()){
		$this->accion   = 'eliminar';
		$this->id_grupo = $arreglo['id_grupo'];		
		$query          = $this->_enviar_parametros();
		return $query;
	}

	public function modificar_grupo($arreglo = array()){
		$this->accion       = 'editar';
		$this->id_grupo     = $arreglo['id_grupo'];
		$this->nombre_grupo = $arreglo['nombre_grupo'];
		$query              = $this->_enviar_parametros();
		return $query;
	}	

	function _enviar_parametros(){  
		$procedure = $this->db
		->query(
		   	"CALL p_t_grupo (
				'".$this->accion."', #accion
				'".strtolower(utf8_encode($this->nombre_grupo))."', #nombre_grupo
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