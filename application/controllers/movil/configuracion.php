<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Configuracion extends CI_Controller{
	
	function __construct(){
	  parent::__construct();
	  $this->db_app = $this->load->database('aplicacion', true);   
	 }

	function perfil(){

		$perfil = array(
			'id_usuario'    => $_GET['id_usuario'],
		);
		$datos_perfil   = $this->t_perfil_model->consultar_perfil($perfil);
		echo json_encode($datos_perfil);
	}

}
