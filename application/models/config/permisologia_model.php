<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisologia_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}

	public function getMenu($id_aplicacion, $id_grupo, $id_usuario){
		$procedure = $this->db
		->query(
			"CALL p_consultar_menu(
				'".$id_aplicacion."', #id_aplicacion 
				'".$id_grupo."', #id_grupo 
				'".$id_usuario."' #id_usuario
			)"
		);
		$query = $procedure->result();
		$procedure->next_result();
		$procedure->free_result();
		return $query;
	}

	public function getSubMenu($id_menu, $id_usuario, $id_grupo, $id_aplicacion = 1){
		$procedure = $this->db
		->query(
			"CALL p_consultar_sub_menu(
				'".$id_menu."', #id_menu
				'".$id_usuario."', #id_usuario
				'".$id_grupo."', #id_grupo
				'".$id_aplicacion."' #id_aplicacion
			)"
		);
		$query = $procedure->result();
		$procedure->next_result();
		$procedure->free_result();
		return $query;
	}

	public function getUsuario($usuario, $password, $id_aplicacion = 1){
		$procedure = $this->db
		->query(
			"CALL p_consultar_usuario(
				'".$usuario."', #usuario 
				'".$password."', #password
				'".$id_aplicacion."' #id_aplicacion
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