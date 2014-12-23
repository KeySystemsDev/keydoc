<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Pasa la fecha de php a formato mysql
**/
if (! function_exists('fecha_php_to_mysql')) 
{
	function fecha_php_to_mysql($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[fecha_php_to_mysql($key)] = fecha_php_to_mysql($valor);
			}
		}
		elseif(is_string($entrada))
		{			
			return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $entrada)));
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}


/**
* Pasa el formato de fechas de mysql a php
**/
if (! function_exists('fecha_mysql_to_php')) 
{
    function fecha_mysql_to_php($entrada, $formato)
    {
        if(is_array($entrada))
        {
            foreach ($entrada as $key => $valor)
            {
                $salida[fecha_mysql_to_php($key)] = fecha_mysql_to_php($valor);
            }
        }
        elseif(is_string($entrada))
        {
            $strtotime = strtotime($entrada);
            if($formato == 'fecha')
            {
                $fecha = date('d/m/Y', strtotime(str_replace('-', '/', $entrada)));
                $entrada = ($strtotime === false) ? '' : $fecha;        
                return $entrada;
            }
            elseif ($formato == 'hora') 
            {
                $fecha = date('H:i:s', strtotime($entrada));
                $entrada = ($strtotime === false) ? '' : $fecha;        
                return $entrada;
            }
            elseif($formato == 'fecha-hora')
            {
                $fecha = date('d/m/Y H:i:s', strtotime(str_replace('/', '-', $entrada)));
                $entrada = ($strtotime === false) ? '' : $fecha;        
                return $entrada;
            }
            
        }
        else
        {
            return $entrada;
        }
        return $salida;
    }
}

/**
* Normaliza los datos para ingresarlos a la BD
**/
if (! function_exists('normalizar')) 
{
	function normalizar($entrada)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[normalizar($key)] = normalizar($valor);
			}
		}
		elseif(is_string($entrada))
		{			
			return strtolower(utf8_encode($entrada));
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}

/**
* Corta una cadena de caracteres a una cantidad especifica
**/
if (! function_exists('cortar_titulo')) 
{
	function cortar_titulo($entrada, $caracteres)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[cortar_titulo($key)] = cortar_titulo($valor);
			}
		}
		elseif(is_string($entrada))
		{		
			$longitud = strlen($entrada);	
			if($caracteres > 0)
			{
				if($longitud > $caracteres)
				{
					$utf8 = substr(ucwords(utf8_decode($entrada)), 0, $caracteres).'..';
					return utf8_encode($utf8);
				}
				else
				{
					$utf8 = substr(ucwords(utf8_decode($entrada)), 0, $caracteres);
					return utf8_encode($utf8);
				}
			}
			else
			{
				$utf8 = ucwords(utf8_decode($entrada));
				return utf8_encode($utf8);
			}
		}
		else
		{
			return $entrada;
		}
		return $salida;
	}
}

/**
*  Muestra el texo en codificacion de espeñol
**/
if (! function_exists('mysql_to_utf8'))
{
	function mysql_to_utf8($entrada, $formato)
	{
		if(is_array($entrada))
		{
			foreach ($entrada as $key => $valor)
			{
				$salida[mysql_to_utf8($key)] = mysql_to_utf8($valor);
			}
		}
		elseif(is_string($entrada))
		{			
			if($formato == 'titulo')
			{
				$utf8 = ucwords(utf8_decode($entrada));
				return utf8_encode($utf8);
			}
			elseif($formato == 'descripcion')
			{
				$utf8 = ucwords(utf8_decode($entrada));
				return utf8_encode($utf8);
			}			
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