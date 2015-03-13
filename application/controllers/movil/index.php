<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Index extends CI_Controller{
	
	function __construct(){
		parent::__construct();			
	}

	function notificaciones(){
		/**
		* con el id del grupo se consultan las notificaciones respectivas
		**/	
		$id_grupo = $_GET['id_grupo'];
		if($id_grupo == 2){
			$paciente = array('id_usuario_paciente' => $_GET['id_usuario']);
			$notificacion_paciente = $this->t_cita_model->consulta_notificacion_paciente($paciente);
			echo json_encode($notificacion_paciente);
		}else{
			$doctor = array( 'id_usuario_doctor' => $_GET['id_usuario']);
			$notificacion_doctor   = $this->t_cita_model->consulta_notificacion_doctor($doctor);
			$paciente = array('id_usuario_paciente' => $_GET['id_usuario']);
			$notificacion_paciente = $this->t_cita_model->consulta_notificacion_paciente($paciente);
			echo json_encode(array_merge($notificacion_paciente, $notificacion_doctor));
		}
	}

	public function detalle_notificacion(){	
		/**
		*	Se envia el id_cita para conocer los detalles
		* de la cita seleccionada.
		**/		
		$arreglo      = array(
			'id_cita' => $_GET['id_cita'],
		);			
		//$leido        = $this->t_cita_model->notificacion_leida_paciente($arreglo);
		$detalle_cita = $this->t_cita_model->consulta_detalle_notificacion($arreglo);
		echo json_encode($detalle_cita);	
	}	
}
