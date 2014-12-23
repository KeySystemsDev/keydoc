<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');

class Citas extends CI_Controller{

	public function __construct(){
	  parent::__construct();
	  $this->db_app = $this->load->database('aplicacion', true);   
	}

	/* ----------------------------------------------------------------------
	
	
											  CITAS (PROCESO DE AGENDAR)
	
	
	-----------------------------------------------------------------------*/

	public function especialidades(){

		$resultado_especialidades = $this->t_cita_model->consulta_especialidades_existentes();
		echo json_encode($resultado_especialidades);	
	}		

	public function estados(){

		$arreglo = array(
			'id_tipo_especialidad' => filter_input(INPUT_POST,'id_especialidad',FILTER_SANITIZE_STRING)					
		);

		$resultado_estados = $this->t_cita_model->consulta_estado_especialidad($arreglo);
		echo json_encode($resultado_estados);	
	}

	public function municipios(){

		$arreglo = array(
			'id_tipo_estado' => filter_input(INPUT_POST,'id_estado',FILTER_SANITIZE_STRING)					
		);

		$resultado_municipios = $this->t_cita_model->consulta_municipio_por_estado($arreglo);
		echo json_encode($resultado_municipios);	
	}

	public function listado_doctores(){

		$resultado_doctores = $this->t_cita_model->consulta_doctores_todos();
		echo json_encode($resultado_doctores);
	}

	public function doctores(){

		$arreglo = array(
			'id_tipo_municipio' => filter_input(INPUT_POST,'id_municipio',FILTER_SANITIZE_STRING)
		);

		$resultado_doctores = $this->t_cita_model->consulta_doctores_municipio($arreglo);
		echo json_encode($resultado_doctores);	
	}

	public function agendar(){

		$arreglo = array(
			'id_usuario'   => filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_STRING)
		);

		$resultado_doctor	 = $this->t_perfil_model->consultar_perfil($arreglo);
		$resultado_horario = $this->t_horario_model->consultar_horario_por_usuario($arreglo);
		echo json_encode(array_merge($resultado_doctor,$resultado_horario));
	}

	public function deposito(){

		$arreglo = array(
			'id_usuario_doctor'   => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING),
			'id_usuario_paciente' => filter_input(INPUT_POST,'id_usuario_paciente',FILTER_SANITIZE_STRING),
			'id_horario'   				=> filter_input(INPUT_POST,'id_horario',FILTER_SANITIZE_STRING),
			'id_consultorio'   		=> filter_input(INPUT_POST,'id_consultorio',FILTER_SANITIZE_STRING)
		);

		$amistad 				= $this->t_cita_model->consultar_amistad($arreglo);
		$resultado_cita = $this->t_cita_model->agregar_cita($arreglo);
		
		echo json_encode(array_merge($amistad, $resultado_cita));
	}

	public function confirmar(){

		$arreglo = array(
			'deposito_referencia' => filter_input(INPUT_POST,'i_deposito',FILTER_SANITIZE_STRING),
			'id_cita'   					=> filter_input(INPUT_POST,'id_cita',FILTER_SANITIZE_STRING)
		);

		$this->t_cita_model->agregar_deposito($arreglo);
	}

	/* ----------------------------------------------------------------------
	
	
											  CITAS (PROCESO DE CITADOS)
	
	
	-----------------------------------------------------------------------*/

	public function consultorios(){

		$arreglo = array(
			'id_usuario' => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING)
		);
		
		$resultado_consultorios = $this->t_consultorio_model->consultar_consultorio_por_usuario($arreglo);
		echo json_encode($resultado_consultorios);
	}

	public function fechas(){

		$arreglo = array(
			'id_usuario_doctor' => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING),
			'id_consultorio' 		=> filter_input(INPUT_POST,'id_consultorio',FILTER_SANITIZE_STRING)
		);
		
		$resultado_fechas = $this->t_cita_model->consulta_fechas_citados_por_consultorio($arreglo);
		echo json_encode($resultado_fechas);
	}

	public function pacientes(){

		$arreglo = array(
			'id_usuario_doctor' => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING),
			'id_consultorio' 		=> filter_input(INPUT_POST,'id_consultorio',FILTER_SANITIZE_STRING),
			'fecha_agenda' 			=> filter_input(INPUT_POST,'i_fecha',FILTER_SANITIZE_STRING),
			'id_horario' 				=> filter_input(INPUT_POST,'id_horario',FILTER_SANITIZE_STRING)
		);

		$resultado_pacientes 	= $this->t_cita_model->consulta_pacientes_citados_dia_consultorio($arreglo);
		echo json_encode($resultado_pacientes);
	}

	public function citas_eliminar_todas(){
		$arreglo = array(
			'id_usuario_doctor' 							 => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING),
			'id_horario' 											 => filter_input(INPUT_POST,'id_horario',FILTER_SANITIZE_STRING),
			'descripcion_detalle_rechazo_cita' => filter_input(INPUT_POST,'i_mensaje',FILTER_SANITIZE_STRING)
		);
		
		$this->t_cita_model->rechazar_citas_todas($arreglo);
	}

	/* ----------------------------------------------------------------------
	
	
											  CITAS (PROCESO DE PANEL-NOTIFICACIONES)
	
	
	-----------------------------------------------------------------------*/

	public function notificaciones_doctor(){

		$arreglo = array(
			'id_usuario_doctor' => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING)
		);

		$notificaciones = $this->t_cita_model->consulta_notificacion_doctor($arreglo);
		echo json_encode($notificaciones);
	}

	public function detalle_notificaciones(){

		$arreglo = array(
			'id_cita' => filter_input(INPUT_POST,'id_cita',FILTER_SANITIZE_STRING)
		);

		$detalle = $this->t_cita_model->consulta_detalle_notificacion_doctor($arreglo);
		echo json_encode($detalle);
	}

	public function aprobar_notificaciones(){

		$arreglo = array(
			'id_cita' 						=> filter_input(INPUT_POST,'id_cita',FILTER_SANITIZE_STRING),
			'id_usuario_doctor' 	=> filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING),
			'id_usuario_paciente' => filter_input(INPUT_POST,'id_usuario_paciente',FILTER_SANITIZE_STRING)
		);

		$this->t_cita_model->aprobar_cita($arreglo);
	}

	public function rechazar_notificaciones(){

		$arreglo = array(
			'id_cita' 													=> filter_input(INPUT_POST,'id_cita',FILTER_SANITIZE_STRING),
			'descripcion_detalle_rechazo_cita' 	=> filter_input(INPUT_POST,'i_detalle',FILTER_SANITIZE_STRING)				
		);
		
		$this->t_cita_model->rechazar_cita($arreglo);
	}

	public function notificaciones_paciente(){

		$arreglo = array(
			'id_usuario_paciente' => filter_input(INPUT_POST,'id_usuario_paciente',FILTER_SANITIZE_STRING) 
		);

		$notificaciones = $this->t_cita_model->consulta_notificacion_paciente($arreglo);
		echo json_encode($notificaciones);
	}

	public function detalle_notificaciones_paciente(){

		$arreglo = array(
			'id_usuario_paciente' => filter_input(INPUT_POST,'id_usuario_paciente',FILTER_SANITIZE_STRING),
			'id_consultorio' 			=> filter_input(INPUT_POST,'id_consultorio',FILTER_SANITIZE_STRING)
		);
		$detalle = $this->t_cita_model->consulta_detalle_notificacion_paciente($arreglo);

		echo json_encode($detalle);
	}

	public function notificaciones_rechazadas_paciente(){

		$arreglo = array(
			'id_cita' 						=> filter_input(INPUT_POST,'id_cita',FILTER_SANITIZE_STRING),
			'id_usuario_paciente' => filter_input(INPUT_POST,'id_usuario_paciente',FILTER_SANITIZE_STRING)
		);
		$detalle = $this->t_cita_model->consulta_detalle_rechazo_cita($arreglo);
		echo json_encode($notificaciones);
	}

	public function cantidad_notificaciones(){
		
		$arreglo = array(
			'id_usuario_doctor' => filter_input(INPUT_POST,'id_usuario_doctor',FILTER_SANITIZE_STRING)
		);

		$cantidad = $this->t_cita_model->consulta_pacientes_nuevos($arreglo);
	}

}