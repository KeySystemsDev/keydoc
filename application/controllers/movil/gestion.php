<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Gestion extends CI_Controller{

	public function __construct(){
	  parent::__construct();
	  $this->db_app = $this->load->database('aplicacion', true);   
	}

	/* ----------------------------------------------------------------------
	
	
											  CONSULTORIOS GESTION
	
	
	-----------------------------------------------------------------------*/

	public function consultar_consultorio_doctor(){

		$arreglo = array(
			'id_usuario' => filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_STRING)
		);

		$consultorio_doctor = $this->t_consultorio_model->consultar_consultorio_por_usuario($arreglo);
		echo json_encode($consultorio_doctor);
	}

	public function consultar_especialidad_doctor(){

		$arreglo = array(
			'id_usuario_doctor' => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING)
		);

		$especialidad_doctor = $this->t_cita_model->consulta_especialidad_doctor($arreglo);
		echo json_encode($especialidad_doctor);
	}

		/* ----------------------------------------------------------------------
	
	
											  REGISTRO HORARIO
	
	
	-----------------------------------------------------------------------*/

	public function insertar_horario_movil(){

		$arreglo = array(
			'id_usuario'           => filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_STRING),
			'id_consultorio'       => filter_input(INPUT_POST,'id_consultorio',FILTER_SANITIZE_STRING),
			'id_tipo_especialidad' => filter_input(INPUT_POST,'id_tipo_especialidad',FILTER_SANITIZE_STRING),
			'fecha_horario'        => filter_input(INPUT_POST,'fecha_horario',FILTER_SANITIZE_STRING),
			'desde_hora_horario'   => filter_input(INPUT_POST,'desde_hora_horario',FILTER_SANITIZE_STRING),
			'hasta_hora_horario'   => filter_input(INPUT_POST,'hasta_hora_horario',FILTER_SANITIZE_STRING),
			'costo_horario'        => filter_input(INPUT_POST,'costo_horario',FILTER_SANITIZE_STRING),
			'cupos_horario'        => filter_input(INPUT_POST,'cupos_horario',FILTER_SANITIZE_STRING)
		);

    $this->t_horario_model->insertar_horario($arreglo);
	}

}