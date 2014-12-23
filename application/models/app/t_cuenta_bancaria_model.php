<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_cuenta_bancaria_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      					= $this->load->database('aplicacion', true);		
		$this->id_usuario_doctor 		    = '';
		$this->numero_cuenta_bancaria 	    = '';
		$this->razon_social_cuenta_bancaria = '';
		$this->rif_ci_cuenta_bancaria		= '';
		$this->id_cuenta_bancaria			= '';
		$this->id_tipo_cuenta			    = '';

	} 
	
	public function insertar_cuenta_bancaria($arreglo = array()){
		$this->accion     				    = 'insertar';
		$this->id_usuario_doctor 	        = $arreglo['id_usuario_doctor'];
		$this->numero_cuenta_bancaria       = $arreglo['numero_cuenta_bancaria'];
		$this->razon_social_cuenta_bancaria = $arreglo['razon_social_cuenta_bancaria'];
		$this->rif_ci_cuenta_bancaria 		= $arreglo['rif_ci_cuenta_bancaria'];
		$this->id_cuenta_bancaria 		    = $arreglo['id_cuenta_bancaria'];
		$this->id_tipo_cuenta 		        = $arreglo['id_tipo_cuenta'];

		$query            					= $this->_enviar_parametros();
		return $query;
	}

	public function deshabilitar_cuenta_bancaria($arreglo = array()){
		$this->accion     		  = 'eliminar';
		$this->id_cuenta_bancaria = $arreglo['id_cuenta_bancaria'];

		$query            		  = $this->_enviar_parametros();
		return $query;
	}


	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_consultorio (
				'".$this->accion."', #accion
				'".$this->id_usuario_doctor."', #id_usuario_doctor
				'".$this->numero_cuenta_bancaria."', #numero_cuenta_bancaria
				'".$this->razon_social_cuenta_bancaria."', #razon_social_cuenta_bancaria
				'".$this->rif_ci_cuenta_bancaria."', #rif_ci_cuenta_bancaria
				'".$this->id_cuenta_bancaria."', #id_cuenta_bancaria
				'".$this->id_tipo_cuenta."' #id_tipo_cuenta
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