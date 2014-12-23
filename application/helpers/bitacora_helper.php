<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**********************************************************************************************
	FUNCION agregar_bitacora($objeto, $arreglo = array())





************************************************************************************************/
if (! function_exists('agregar_bitacora')) 
{
	function agregar_bitacora($objeto, $arreglo = array())
	{
		$arreglo2 = array(
			'descripcion_bitacora' => $arreglo['bitacora'].".",
			'id_usuario' 					 => $arreglo['id_usuario_transaccion'],
			'id_grupo' 						 => $arreglo['id_grupo']
		);
		$objeto->t_bitacora_model->insertar_bitacora($arreglo2);
	}
}