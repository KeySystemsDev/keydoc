<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Registro extends CI_Controller{

	public function __construct(){
	  parent::__construct();
	  $this->db_app = $this->load->database('aplicacion', true);   
	}

	/* ----------------------------------------------------------------------
	
	
											  REGISTRAR CONSULTORIO
	
	
	-----------------------------------------------------------------------*/
	public function estados_todos(){
		$resultado_estados = $this->t_tipo_model->consultar_estados();
		echo json_encode($resultado_estados);	
	}

	public function municipios_todos(){
		$arreglo = array(
			'id_tipo_dependiente' => filter_input(INPUT_POST,'id_estado',FILTER_SANITIZE_STRING)					
		);

		$resultado_municipios = $this->t_tipo_model->consultar_municipio($arreglo);
		echo json_encode($resultado_municipios);	
	}

	public function registrar_consultorio(){

		$arreglo = array(
			'id_usuario' 				 		=> filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_STRING),
			'id_tipo_estado' 		 		=> filter_input(INPUT_POST,'id_tipo_estado',FILTER_SANITIZE_STRING),
			'id_tipo_municipio'	 		=> filter_input(INPUT_POST,'id_tipo_municipio',FILTER_SANITIZE_STRING),
			'nombre_consultorio' 		=> filter_input(INPUT_POST,'nombre_consultorio',FILTER_SANITIZE_STRING),
			'direccion_consultorio' => filter_input(INPUT_POST,'direccion_consultorio',FILTER_SANITIZE_STRING)
		);

		$resultado_pacientes 	= $this->t_consultorio_model-> insertar_consultorio($arreglo);
		echo json_encode($resultado_pacientes);
	}


}