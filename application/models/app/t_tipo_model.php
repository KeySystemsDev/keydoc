<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_tipo_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	       = $this->load->database('aplicacion', true);		
		$this->id_maestro  	       = '';
		$this->nombre_tipo 	       = '';
		$this->id_tipo 			   = '';
		$this->id_tipo_dependiente = '';
	} 
	
	public function insertar_especialidad($arreglo = array()){
		$this->accion     	= 'insertar';
		$this->id_maestro 	= $arreglo['id_maestro'];
		$this->nombre_tipo 	= $arreglo['nombre_especialidad'];
		$this->id_tipo 	    = '';

		$query            	= $this->_enviar_parametros();
		return $query;
	}

	public function editar_especialidad($arreglo = array()){
		$this->accion     	= 'editar';
		$this->id_tipo 	    = $arreglo['id_tipo'];
		$this->nombre_tipo 	= $arreglo['nombre_especialidad'];

		$query            	= $this->_enviar_parametros();
		return $query;
	}

	public function consultar($arreglo = array()){
		$this->accion     = 'consulta_maestro';
		$this->id_maestro = $arreglo['id_maestro'];
		
		$query 			  = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_especialidad($arreglo = array()){
		$this->accion  = 'consulta_tipo';
		$this->id_tipo = $arreglo['id_tipo'];

		$query 		   = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_municipio($arreglo = array()){
		$this->accion  = 'consulta_municipios';
		$this->id_tipo = $arreglo['id_tipo_dependiente'];

		$query 		   = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_estados($arreglo = array()){
		$this->accion  = 'consulta_estados';

		$query 		   = $this->_enviar_parametros();
		return $query;
	}	

	public function eliminar_especialidad($arreglo = array()){
		$this->accion  = 'eliminar';
		$this->id_tipo = $arreglo['id_tipo'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_especialidad($arreglo = array()){
		$this->accion  = 'consulta_nombre_filtros';
		$this->id_tipo = $arreglo['id_tipo_especialidad'];

		$query         = $this->_enviar_parametros();
		return $query;
	}
	public function consulta_estado($arreglo = array()){
		$this->accion  = 'consulta_nombre_filtros';
		$this->id_tipo = $arreglo['id_tipo_estado'];

		$query 		   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_municipio($arreglo = array()){
		$this->accion  = 'consulta_nombre_filtros';
		$this->id_tipo = $arreglo['id_tipo_municipio'];

		$query 		   = $this->_enviar_parametros();
		return $query;
	}	


	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_tipo (
				'".$this->accion."', #accion
				'".$this->id_maestro."', #id_maestro
				'".normalizar($this->nombre_tipo)."', #nombre_tipo
				'".$this->id_tipo."', #id_tipo
				'".$this->id_tipo_dependiente."' #id_tipo_dependiente
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