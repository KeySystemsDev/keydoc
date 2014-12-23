<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_perfil_model extends CI_Model {

	public function __construct(){
		parent::__construct();	
		$this->id_usuario  				= '';
		$this->id_aplicacion 			= '';
		$this->nombre_perfil 			= '';
		$this->id_perfil 				= '';
		$this->apellido_perfil 			= '';
		$this->fecha_nacimiento_perfil	= '';
		$this->cedula_perfil 			= '';
		$this->telefono_perfil 			= '';
		$this->direccion_perfil 		= '';
		$this->url_imagen_perfil 		= '';
		$this->sexo_perfil 				= '';
		$this->portal_web_perfil	    = '';
	} 
	
	public function insertar_perfil($arreglo = array()){
		$this->accion     			   = 'insertar';
		$this->id_aplicacion 		   = $arreglo['id_aplicacion'];
		$this->id_usuario 			   = $arreglo['id_usuario'];
		$this->nombre_perfil 		   = $arreglo['nombre'];
		$this->fecha_nacimiento_perfil = $arreglo['fecha_nacimiento'];
		$this->apellido_perfil 		   = $arreglo['apellido'];
		$this->cedula_perfil 		   = $arreglo['cedula'];
		$this->telefono_perfil 		   = $arreglo['telefono'];
		$this->direccion_perfil 	   = $arreglo['direccion'];
		$this->url_imagen_perfil 	   = $arreglo['url_imagen_perfil'];
		$this->sexo_perfil 			   = $arreglo['sexo_perfil'];
		$this->portal_web_perfil 	   = $arreglo['portal_web_perfil'];

		$query            			   = $this->_enviar_parametros();
		return $query;
	}

	public function actualizar_perfil($arreglo = array()){
		$this->accion     			   = 'actualizar_perfil';
		$this->apellido_perfil 		   = $arreglo['apellido'];
		$this->cedula_perfil 		   = $arreglo['cedula'];
		$this->direccion_perfil 	   = $arreglo['direccion'];
		$this->fecha_nacimiento_perfil = $arreglo['fecha_nacimiento'];
		$this->nombre_perfil 		   = $arreglo['nombre'];
		$this->telefono_perfil 		   = $arreglo['telefono'];
		$this->id_usuario 			   = $arreglo['id_usuario'];
		$this->sexo_perfil 			   = $arreglo['sexo_perfil'];
		$this->portal_web_perfil 	   = $arreglo['portal_web_perfil'];
		
		$query            			   = $this->_enviar_parametros();
		return $query;
	}

	public function editar_datos_perfil($arreglo = array()){
		$this->accion     			   = 'editar_datos_perfil';
		$this->apellido_perfil 		   = $arreglo['apellido'];
		$this->cedula_perfil 		   = $arreglo['cedula'];
		$this->direccion_perfil 	   = $arreglo['direccion'];
		$this->fecha_nacimiento_perfil = $arreglo['fecha_nacimiento'];
		$this->nombre_perfil 		   = $arreglo['nombre'];
		$this->telefono_perfil 		   = $arreglo['telefono'];
		$this->id_usuario 			   = $arreglo['id_usuario'];
		$this->sexo_perfil 			   = $arreglo['sexo_perfil'];
		$this->portal_web_perfil 	   = $arreglo['portal_web_perfil'];
		
		$query            			   = $this->_enviar_parametros();
		return $query;
	}

	public function actualizar_imagen_perfil($arreglo = array()){
		$this->accion     		 = 'actualizar_imagen';
		$this->id_usuario 		 = $arreglo['id_usuario'];
		$this->url_imagen_perfil = $arreglo['url_imagen_perfil'];

		$query            		 = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_perfil($arreglo = array()){
		$this->accion     = 'consulta';
		$this->id_usuario = $arreglo['id_usuario'];
		
		$query 			  = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_validar_actualizar_perfil($arreglo = array()){
		$this->accion        = 'validar_actualizar_perfil';
		$this->id_usuario    = $arreglo['id_usuario'];
		$this->id_aplicacion = $arreglo['id_aplicacion'];

		$query               = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_existencia_por_cedula($arreglo = array()){
		$this->accion        = 'existencia_por_cedula';
		$this->cedula_perfil = $arreglo['cedula_perfil'];

		$query            = $this->_enviar_parametros();
		return $query;
	}


	function _enviar_parametros(){  
		$procedure = $this->db
		->query(
			"CALL p_t_perfil (
				'".$this->accion."', #accion
				'".$this->id_usuario."', #id_usuario
				'".'1'."', #id_aplicacion
				'".normalizar($this->nombre_perfil)."', #nombre_perfil
				'".$this->id_perfil."', #id_perfil
				'".normalizar($this->apellido_perfil)."', #apellido_perfil
				'".fecha_php_to_mysql($this->fecha_nacimiento_perfil)."', #fecha_nacimiento_perfil
				'".$this->cedula_perfil."', #cedula_perfil
				'".$this->telefono_perfil."', #telefono_perfil
				'".$this->direccion_perfil."', #direccion_perfil
				'".$this->url_imagen_perfil."', #url_imagen_perfil
				'".$this->sexo_perfil."', #sexo_perfil
				'".$this->portal_web_perfil."' #portal_web_perfil
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