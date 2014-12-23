<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Verifica la ruta activa del panel
**/
if (! function_exists('ruta_activa')) 
{
	function ruta_activa($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[ruta_activa($key)] = ruta_activa($valor);
			}
		}
		elseif(is_string($entrada))
		{			
			$url = $_SERVER['REQUEST_URI'];
			$url = explode('/', $url);
			$active = ($url[1] == $entrada || (empty($url[1]) && $entrada == 'index')) ? 'active' : '';
			return $active;
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}

/**
* Coloca las classe .active en las opciones del panel superior
**/
if (! function_exists('menu_superior')) 
{
	function menu_superior($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[menu_superior($key)] = menu_superior($valor);
			}
		}
		elseif(is_string($entrada))
		{		          
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('/', $url);      
            if (isset($url[4]))
            {
                $opc = $url[3].'/'.$url[4];
                $aux = explode('-', $url[4]);
                if (isset($aux[1]))
                {
                    $opc = $url[3].'/'.$aux[0].'-'.$aux[1];
                    if($opc == $entrada)
                    {
                  	 $opc;
                    }
                    else
                    {
                  	 $opc = $url[3].'/'.$aux[0];
                    }
                }
                else
                {
                	$opc = $url[3].'/'.$aux[0];
                }
            } 
            elseif (isset($url[3]))
            {
                $opc = $url[2].'/'.$url[3];
                $aux = explode('-', $url[3]);        
                if (isset($aux[1]))
                {
                    $opc = $url[2].'/'.$aux[0].'-'.$aux[1];
                }
                else
                {
                	$opc = $url[2].'/'.$aux[0];
                }
            } 
            elseif (isset($url[2]))
            {
                $opc = $url[1].'/'.$url[2];
                $aux = explode('-', $url[2]);
                if (isset($aux[1]))
                {
                  $opc = $url[1].'/'.$aux[0].'-'.$aux[1];
                }
                else
                {
                	$opc = $url[1].'/'.$aux[0];
                }
            }      
            else 
            {
                $opc = '';
            }
            $active = ($opc == $entrada) ? 'activo' : '' ;
    		return $active;
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}

/**
* Activa el menu lateral con la clase .active
**/
if (! function_exists('menu_lateral')) 
{
	function menu_lateral($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[menu_lateral($key)] = menu_lateral($valor);
			}
		}
		elseif(is_string($entrada))
		{			           
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('/', $url);     
            if (isset($url[3]))
            {
                $opc = $url[3];
                $url = explode('-', $url[3]);
                if (isset($url[1]))
                {
                    $opc = $url[0];
                }
            }elseif (isset($url[1]))
            {
                $opc = $url[1];
                $url = explode('-', $url[1]);
                if (isset($url[1]))
                {
                    $opc = $url[1];
                }
            }  
            else
            {
                $opc = '';
            }
            $active = ($opc == $entrada) ? 'activo' : '' ;
			return $active;
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}

/**
* Decodifica las url compuestas ejemplo: metodo-base64_encode(id)
**/
if (! function_exists('decodificar')) 
{
	function decodificar($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[decodificar($key)] = decodificar($valor);
			}
		}
		elseif(is_string($entrada))
		{
			$entrada = str_replace('_', '-', $entrada);
			$reversa = strrev($entrada);
			$entrada = explode('-', $reversa);	
			$id      = strrev($entrada[0]);
			return base64_decode($id);
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}

/**
* Acorta las url
**/
if (! function_exists('short_url')) 
{
	function short_url($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[short_url($key)] = short_url($valor);
			}
		}
		elseif(is_string($entrada))
		{
			$usuario = 'o_4kej3p9hh4';
			$api = 'R_6a29ff16aea049ada921d0c49b0b600b';

			$valor = file_get_contents('http://api.bit.ly/shorten?version=2.0.1&format=xml&longUrl='.urlencode($entrada).'&login='.$usuario.'&apiKey='.$api);  
			$valor = simplexml_load_string($valor);
			 
			return 'http://bit.ly/'.$valor->results ->nodeKeyVal->hash;
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}
/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */