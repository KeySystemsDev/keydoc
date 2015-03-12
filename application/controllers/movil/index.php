<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Index extends CI_Controller{
	
	function __construct(){
		parent::__construct();			
	}

	function notificaciones(){
		$id_grupo = $_GET['id_grupo'];
		if($id_grupo == 2){
			$paciente = array('id_usuario_paciente' => $_GET['id_usuario']);
			$notificacion_paciente = $this->t_cita_model->consulta_notificacion_paciente($paciente);
			echo json_encode($notificacion_paciente);
		}else{
			$doctor = array( 'id_usuario_doctor' => $_GET['id_usuario']);
			$notificacion_doctor   = $this->t_cita_model->consulta_notificacion_doctor($doctor);
			echo json_encode($notificacion_doctor);
			$paciente = array('id_usuario_paciente' => $_GET['id_usuario']);
			$notificacion_paciente = $this->t_cita_model->consulta_notificacion_paciente($paciente);
			echo json_encode($notificacion_paciente);
		}
	}
}
