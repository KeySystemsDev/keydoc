<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_amigos_model extends CI_Model {

	public function __construct(){
	parent::__construct();
	$this->db_app      		   = $this->load->database('aplicacion', true);		
	$this->id_usuario_doctor   = '';
	$this->id_usuario_paciente = '';
	$this->id_amigo            = '';
	} 
	
	public function insertar_amigos($arreglo = array()){
		$this->accion     		   = 'insertar';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            		   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_directorio_doctor_amigo($arreglo = array()){
		$this->accion              = 'directorio_doctor_amigo';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_directorio_paciente_amigo($arreglo = array()){
		$this->accion            = 'directorio_paciente_amigo';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function aprobar_solicitud_amistad($arreglo = array()){
		$this->accion              = 'aprobar_solicitud_amistad';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function rechazar_solicitud_amistad($arreglo = array()){
		$this->accion              = 'rechazar_solicitud_amistad';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_status_amistad($arreglo = array()){
		$this->accion              = 'consulta_status_amistad';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_notificacion_doctor_amistad($arreglo = array()){
		$this->accion            = 'notificacion_doctor_amistad';
		$this->id_usuario_doctor = $arreglo['id_usuario_doctor'];

		$query                   = $this->_enviar_parametros();
		return $query;
	}

	public function consulta_notificacion_paciente_amistad($arreglo = array()){
		$this->accion              = 'notificacion_paciente_amistad';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query                     = $this->_enviar_parametros();
		return $query;
	}

	public function leida_notificacion_doctor($arreglo = array()){
		$this->accion   = 'notificacion_doctor_amistad';
		$this->id_amigo = $arreglo['id_amigo'];

		$query          = $this->_enviar_parametros();
		return $query;
	}

	public function leida_notificacion_paciente($arreglo = array()){
		$this->accion   = 'leida_notificacion_paciente';
		$this->id_amigo = $arreglo['id_amigo'];

		$query          = $this->_enviar_parametros();
		return $query;
	}

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
		   "CALL p_t_amigos (
				'".$this->accion."', #accion
				'".$this->id_usuario_doctor."', #id_usuario_doctor
				'".$this->id_usuario_paciente."', #id_usuario_paciente
				'".$this->id_amigo."' #id_amigo
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