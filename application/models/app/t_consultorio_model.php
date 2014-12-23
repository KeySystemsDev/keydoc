<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_consultorio_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      			    = $this->load->database('aplicacion', true);		
		$this->nombre_consultorio 		= '';
		$this->direccion_consultorio 	= '';
		$this->id_consultorio  			= '';
		$this->id_usuario				= '';
		$this->id_tipo_estado			= '';
		$this->id_tipo_municipio		= '';
	} 
	
	public function insertar_consultorio($arreglo = array()){
		$this->accion     			 = 'insertar';
		$this->nombre_consultorio 	 = $arreglo['nombre_consultorio'];
		$this->direccion_consultorio = $arreglo['direccion_consultorio'];
		$this->id_usuario 			 = $arreglo['id_usuario'];
		$this->id_tipo_estado 		 = $arreglo['id_tipo_estado'];
		$this->id_tipo_municipio 	 = $arreglo['id_tipo_municipio'];

		$query            			 = $this->_enviar_parametros();
		return $query;
	}

	public function editar_consultorio($arreglo = array()){
		$this->accion     			 = 'editar';
		$this->nombre_consultorio 	 = $arreglo['nombre_consultorio'];
		$this->direccion_consultorio = $arreglo['direccion_consultorio'];
		$this->id_consultorio 		 = $arreglo['id_consultorio'];
		$this->id_usuario 			 = $arreglo['id_usuario'];

		$query            			 = $this->_enviar_parametros();
		return $query;
	}

	public function consultar(){
		$this->accion  = 'consulta_maestro';

		$query 		   = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_consultorio($arreglo = array()){
		$this->accion   	  = 'consulta_consultorio';
		$this->id_consultorio = $arreglo['id_consultorio'];

		$query 				  = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_consultorio_por_usuario($arreglo = array()){
		$this->accion     = 'consultorios_por_usuario';
		$this->id_usuario = $arreglo['id_usuario'];

		$query 			  = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_consultorios_usuarios_gestion($arreglo = array()){
		$this->accion     = 'consulta_consultorio_gestion';
		$this->id_usuario = $arreglo['id_usuario'];

		$query 			  = $this->_enviar_parametros();
		return $query;
	}	

	public function eliminar_consultorio($arreglo = array()){
		$this->accion     	  = 'eliminar';
		$this->id_consultorio = $arreglo['id_consultorio'];

		$query            	  = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_consultorio_recepcionista($arreglo = array()){
		$this->accion     = 'consulta_consultorio_recepcionista';
		$this->id_usuario = $arreglo['id_usuario'];

		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_nombre_consultorio($arreglo = array()){
		$this->accion         = 'consulta_nombre_consultorio';
		$this->id_consultorio = $arreglo['id_consultorio'];

		$query           	  = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_consultorio (
				'".$this->accion."', #accion
				'".normalizar($this->nombre_consultorio)."', #nombre_consultorio
				'".$this->direccion_consultorio."', #direccion_consultorio
				'".$this->id_consultorio."', #id_consultorio
				'".$this->id_usuario."', #id_usuario
				'".$this->id_tipo_estado."', #id_tipo_estado
				'".$this->id_tipo_municipio."' #id_tipo_municipio
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