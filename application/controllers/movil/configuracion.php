<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Configuracion extends CI_Controller{
	
	function __construct(){
	  parent::__construct();
	  $this->db_app = $this->load->database('aplicacion', true);   
	 }

	function perfil_agregar(){

		$arreglo = array(
			'nombre' 						=> filter_input(INPUT_POST,'i_nombre',FILTER_SANITIZE_STRING),
			'apellido' 					=> filter_input(INPUT_POST,'i_apellido',FILTER_SANITIZE_STRING),
			'cedula' 						=> filter_input(INPUT_POST,'i_cedula',FILTER_SANITIZE_STRING),
			'telefono' 					=> filter_input(INPUT_POST,'i_telefono',FILTER_SANITIZE_STRING),
			'fecha_nacimiento' 	=> filter_input(INPUT_POST,'i_fecha_nacimiento',FILTER_SANITIZE_STRING),
			'direccion' 				=> filter_input(INPUT_POST,'i_direccion',FILTER_SANITIZE_STRING),
			'id_usuario' 				=> filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_STRING),
			'url_imagen_perfil' => 'cualquiera',
			'sexo_perfil'       => filter_input(INPUT_POST,'sexo_perfil',FILTER_SANITIZE_STRING),
			'portal_web_perfil' => filter_input(INPUT_POST,'portal_web_perfil',FILTER_SANITIZE_STRING),
		);

		$resultado = $this->t_perfil_model->actualizar_perfil($arreglo);
	}

}
