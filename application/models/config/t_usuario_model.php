<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_usuario_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
		$this->correo_usuario   	 = '';
		$this->clave_usuario    	 = '';
		$this->id_usuario       	 = '';
		$this->id_aplicacion         = '';
		$this->id_grupo       		 = '';
		$this->id_usuario_vendedor   = '';
	}
	
	public function getUsuarios(){
		$this->accion = 'consulta_maestro';
		$query        = $this->_enviar_parametros();
		return $query;
	}

	public function insertar_usuario($arreglo = array()){
		$this->accion              = 'insertar';
		$this->correo_usuario      = $arreglo['correo_usuario'];
		$this->clave_usuario       = $arreglo['clave_usuario'];
		$this->id_aplicacion       = '1';
		$this->id_grupo            = '2';
		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function insertar_usuario_vendedor($arreglo = array()){
		$this->accion              = 'insertar';
		$this->correo_usuario      = $arreglo['correo_usuario'];
		$this->clave_usuario       = $arreglo['clave_usuario'];
		$this->id_aplicacion       = '1';
		$this->id_grupo            = '2';
		$this->id_usuario_vendedor = $arreglo['id_usuario_vendedor']; 
		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_usuario($arreglo = array()){
		$this->accion     = 'consulta_usuario';
		$this->id_usuario = $arreglo['id_usuario'];		
		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function editar_clave_usuario($arreglo = array()){
		$this->accion     		= 'cambio_password';
		$this->correo_usuario   = $arreglo['correo_usuario'];
		$this->clave_usuario 	= $arreglo['clave_usuario'];

		$query            		= $this->_enviar_parametros();
		return $query;
	}

	public function habilitar_usuario($arreglo = array()){
		$this->accion     = 'eliminar';
		$this->id_usuario = $arreglo['id_usuario'];		
		$query            = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_validar_correo($arreglo = array()){
		$this->accion         = 'validar_correo';
		$this->correo_usuario = $arreglo['correo_usuario'];		
		$query                = $this->_enviar_parametros();
		return $query;
	}

	public function validar_cuenta_usuario($arreglo = array()){
		$this->accion     = 'validar_cuenta';
		$this->id_usuario = $arreglo['id_usuario'];	
		$query            = $this->_enviar_parametros();
		return $query;
	}	

	function _enviar_parametros(){  

		$procedure = $this->db
		->query(
		   	"CALL p_t_usuario (
				'".$this->accion."', #accion
				'".normalizar($this->correo_usuario)."', #correo_usuario
				'".normalizar($this->clave_usuario)."', #clave_usuario
				'".$this->id_usuario."', #id_usuario
				'".$this->id_aplicacion."', #id_aplicacion
				'".$this->id_grupo."', #id_grupo
				'".$this->id_usuario_vendedor."' #id_usuario_vendedor
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