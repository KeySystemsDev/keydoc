<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_detalle_observacion_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->db_app      	            = $this->load->database('aplicacion', true);	
	  	$this->id_cita                  = ''; 
	  	$this->observacion_privada      = ''; 
	  	$this->observacion_publica      = ''; 
	  	$this->id_usuario_paciente      = ''; 
	  	$this->id_usuario_doctor        = ''; 
	  	$this->costo_consulta_adicional = ''; 
	  	$this->costo_consulta_total     = ''; 	
	} 

	public function insertar_observacion($arreglo = array()){
		$this->accion     	            = 'insertar';
		$this->id_cita 			        = $arreglo['id_cita'];
		$this->observacion_privada 		= $arreglo['observacion_privada'];
		$this->observacion_publica 		= $arreglo['observacion_publica'];
		$this->costo_consulta_adicional = $arreglo['costo_consulta_adicional'];
		$this->costo_consulta_total 	= $arreglo['costo_consulta_total'];

		$query            	            = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_observacion_doctor($arreglo = array()){
		$this->accion  = 'consulta_observacion_doctor';
		$this->id_cita = $arreglo['id_cita'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_observacion_paciente($arreglo = array()){
		$this->accion  = 'consulta_observacion_paciente';
		$this->id_cita = $arreglo['id_cita'];

		$query         = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_lista_observaciones_por_doctor($arreglo = array()){
		$this->accion     	       = 'lista_observaciones_por_doctor';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_lista_observaciones_por_paciente($arreglo = array()){
		$this->accion     	       = 'lista_observaciones_por_paciente';
		$this->id_usuario_paciente = $arreglo['id_usuario_paciente'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}

	public function consultar_verificar_usuario_doctor($arreglo = array()){
		$this->accion     	       = 'verificar_usuario_doctor';
		$this->id_usuario_doctor   = $arreglo['id_usuario_doctor'];

		$query            	       = $this->_enviar_parametros();
		return $query;
	}	

	function _enviar_parametros(){  
		$procedure = $this->db_app
		->query(
			"CALL p_t_detalle_observaciones_cita (
				'".$this->accion."', #accion
				'".$this->id_cita."', #id_cita
				'".$this->observacion_privada."', #observacion_privada
				'".$this->observacion_publica."', #observacion_publica
				'".$this->id_usuario_paciente."', #id_usuario_paciente
				'".$this->id_usuario_doctor."', #id_usuario_doctor
				'".$this->costo_consulta_adicional."', #costo_consulta_adicional
				'".$this->costo_consulta_total."' #costo_consulta_total
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