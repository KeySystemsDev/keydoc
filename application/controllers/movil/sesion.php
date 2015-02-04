<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Sesion extends CI_Controller{
	
	function __construct(){
	  parent::__construct();
	  $this->db_app = $this->load->database('aplicacion', true);   
	 }

	function conectar(){
		$usuario 	= $_GET['i_usuario'];
		$password	= $_GET['i_password'];

		$resultado 	= $this->permisologia_model->getUsuario($usuario, $password);
		echo json_encode($resultado);	
	}

	function registrar(){       
		$usuario 	= filter_input(INPUT_POST,'i_user',FILTER_SANITIZE_STRING);
		$password	= filter_input(INPUT_POST,'i_pass',FILTER_SANITIZE_STRING);
		
  	$arreglo = array(
  		'correo_usuario' => filter_input(INPUT_POST,'i_user',FILTER_SANITIZE_STRING),
  		'clave_usuario'  => filter_input(INPUT_POST,'i_pass',FILTER_SANITIZE_STRING),
  	);
  	$usuarios = $this->t_usuario_model->insertar_usuario($arreglo);
  	$resultado 	= $this->permisologia_model->getUsuario($usuario, $password);
		echo json_encode($resultado);	
  }
}
