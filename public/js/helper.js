/**********************************************************
  HELPER ELABORADO POR KEYSYSTEMS C.A
  DESARROLLADORA PARA JQUERY
  FUNCIONES EN PROTOTYPO Y INDIVIDUALES




**********************************************************/


!function ($) {

  	$(function(){    
		validar = { 
		/**
		* validar campo logico, select o numeros
		**/
	  	logico: function (div, aux) {
			logico = $('#' + div).val();
			if(logico != ''){
			  	$('#' + aux).css({'border-left':'1px solid #CCCCCC'});
			  	return logico;
			}else{
			  	$('#' + aux).css({'border-left':'3px solid #FF8484'});
			  	return 0;
			}
	  	},      
	  	/**
		* validar las contraseñas que sean mayores a 8 y menores
		* a 15 digitos
		**/
	  	password: function (div) {
			password = $('#' + div).val();
			placeholder = $('#' + div).attr('placeholder');
			if(password.length >= 8 && password.length <= 15 ){
				$('#' + div).css({'border-left':'1px solid #CCCCCC'});
				return password;
			}else{
			    $('#' + div).css({'border-left':'3px solid #FF8484'});
			    $('#' + div).val('').attr('placeholder', placeholder);
			    return 0;
			}
	  	},     
	  	/**
		* valida que la cadena tenga caracteres
		**/
	  	string: function (div) {
			string = $('#' + div).val();
			placeholder = $('#' + div).attr('placeholder');
			if(string.length >= 2){
				$('#' + div).css({'border-left':'1px solid #CCCCCC'});
				return string;
			}else{
				$('#' + div).css({'border-left':'3px solid #FF8484'});
				$('#' + div).val('').attr('placeholder', placeholder);
			    return 0;
			}
	  	},
	  	/**
		* valida que el campo tenga solo texto.
		**/     
	  	texto: function(div) {
			texto = $('#' + div).val();
			for(i = 0; i < texto.length; i++){
			    if (texto.indexOf(texto.charAt(i),0) != -1){
				    return 1;
			  	}
			}
			$('#' + div).css({'border-left':'3px solid #FF8484'});
			return 0;        
	  	},   
	  	/**
		* valida el campo de la cedula de identidad 
		* venezolana
		**/
	  	cedula: function (div) {
			cedula = $('#' + div).val();
			placeholder = $('#' + div).attr('placeholder');
			numero = cedula.substr(1,9);
			letra = cedula.split("",1);
			if (letra == 'v' || letra == 'e' 
			 || letra == 'V' || letra == 'E'){
			  	if((cedula.length >= 4) && (cedula.length <= 9)){
				  	$('#' + div).css({'border-left':'1px solid #CCCCCC'});
				  	return cedula;
			  	}else{
				  	$('#' + div).css({'border-left':'3px solid #FF8484'});
				  	$('#' + div).val('').attr('placeholder', placeholder);
				  	return 0;
			  	}
			}else{
		    	$('#' + div).css({'border-left':'3px solid #FF8484'});
		    	$('#' + div).val('').attr('placeholder', placeholder);
		    	return 0;
			}
	  	}, 
	  	/**
		* validar el rif en venezuela
		**/
	  	rif: function (valor) { 
			rif = $('#' + valor).val();
			numero = rif.substr(1,15);
			letra = rif.split("",1);

			if(letra == 'j' || letra == 'o' 
			|| letra == 'J' || letra == 'O'){
			  	if((rif.length == 10)){
				  	$('#' + valor).css({'border-left':'1px solid #CCCCCC'});
				  	return rif;
			  	}else{
				  	$('#' + valor).css({'border-left':'3px solid #FF8484'});
				  	$('#' + div).val('').attr('placeholder', 'Rif incorrecto');
				  	return 0;
			  	}
			}else{
			    $('#' + valor).css({'border-left':'3px solid #FF8484'});
			    $('#' + div).val('').attr('placeholder', 'Rif sin formato');
			    return 0;
			}
	  	},       
	  	/**
		* valida el campo del telefono
		**/
	  	telefono: function (div) {
			telefono = $('#' + div).val();
			if(telefono.length == 11){
			    $('#' + div).css({'border-left':'1px solid #CCCCCC'});
			    return telefono;
			}else{
			    $('#' + div).css({'border-left':'3px solid #FF8484'});
			    $('#' + div).val('').attr('placeholder', 'Teléfono incorrecto');
			    return 0;
			}
	  	}, 
	  	/**
		* valida el campo del correo
		**/
		correo: function (div) {
			correo = $('#' + div).val();
			arroba = 0;
			punto = 0;
			ind = 0;

			for(i=1;i<(correo.length-1);i++){
			    if(correo[i] == '@'){
				    arroba ++;
				    ind = i;
			    }
			}
			for(i=ind;i<(correo.length-1);i++){
			    if(correo[i] == '.')
				    punto ++;
			}

			if((arroba == 1) && (punto > 0)){
			    patron = /[\^$*+?=!¡¿#~€¬!"%&?:\\/()\[\]{}]/;
			        if (patron.test(correo)){
					    $('#' + div).css({'border-left':'3px solid #FF8484'});
					    $('#' + div).val('').attr('placeholder', 'Correo incorrecto');
					    return 0;
			}else{
				$('#' + div).css({'border-left':'1px solid #CCCCCC'});
				return correo;
			    }          
			}else{
			    $('#' + div).css({'border-left':'3px solid #FF8484'});
			    $('#' + div).val('').attr('placeholder', 'Correo sin formato');
			    return 0;
			}
		},
		/**
		* valida que el formato sea de fecha
		**/		
		fecha: function (div) {
			fecha = $('#' + div).val();
			expresion = new RegExp('(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}','g');
			date  = new Date(fecha.substring(6,10),fecha.substring(3,5)-1,fecha.substring(0,2));
			if (expresion.test(fecha)){
			    $('#' + div).css({'border-left':'1px solid #CCCCCC'});
			    return 1;
			}else{
			    $('#' + div).css({'border-left':'3px solid #FF8484'});
			    $('#' + div).val('').attr('placeholder', 'Fecha incorrecto');
			    return 0
			}        
		},
		/**
		* valida que la url sea valida
		**/
		url: function(div){
			url = $('#' + div).val();
			url = 'http://'+ url;
			expresion = /^(http):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
			if (expresion.test(url)){
			    return url;
			}else{
			    return 0;
			}
		},    
	};

	autocomplete = {           
	  	/**
		* autocompletado con elemntos bloqueados
		* label, id, input (se bloquea)
		**/     
		bloqueado: function(div, id_div, controlador){ 
			$('#' + div).autocomplete({
			    delay: 0,
				source: controlador,
				minLength: 1,
				select: opcionSeleccionada,
			});

			function opcionSeleccionada(event, ui){
			    nombre = ui.item.label;
			    id = ui.item.id;
			    $('#' + div).attr('disabled', true);          
			    $('#' + div).val(nombre);
			    $('#' + id_div).val(id);
			    event.preventDefault();
			}
	  	},
	  	/**
		* autocompletado con auxiliar
		* para rellenar input adicional
		* ejmplo: cedula (completar nombre)
		**/         
		auxiliar: function(div, id_div, aux, controlador){
			$('#' + div).autocomplete({
			    delay: 0,
				source: controlador,
				minLength: 1,
				select: opcionSeleccionada,
			});

			function opcionSeleccionada(event, ui){
			    nombre = ui.item.label;
			    id = ui.item.id;
			    auxiliar = (aux != '') ? ui.item.aux : '';
			    $('#' + div).attr('disabled', true);          
			    $('#' + div).val(nombre);
			    $('#' + id_div).val(id);
			    $('#' + aux).val(auxiliar);
			   event.preventDefault();
			}
	  	},
	  	/**
		* autocompletado editable
		* una vez seleccionado el input luego se puede editar
		**/             
		editable: function(div, id_div, controlador){
			$('#' + div).autocomplete({
			delay: 0,
			source: controlador,
			minLength: 1,
			select: opcionSeleccionada,
			});

			function opcionSeleccionada(event, ui){
			    nombre = ui.item.label;
			    id = ui.item.id;		  
			    $('#' + div).val(nombre);
			    $('#' + id_div).val(id);
			    event.preventDefault();
			}
	  	},
	}; 

	evento = {
	  	/**
		* muestra o oculta una determinada capa
		* si esta oculta la pone visible
		* si esta visible la coloca oculta
		**/     
		mostrar: function(div){
			var div = div.split(",");
			for (i = 0; i < div.length; i++) {
			    if($(div[i]).is(':hidden')){
				    $(div[i]).slideDown();
			    }else{
				    $(div[i]).hide();          
			  }
			}
		  },
		}

	obtener = { 
		/**
		* obtener la fecha actual
		**/
		fecha: function(){
			obj = new Date();
			dia = obj.getDate();
			mes = (obj.getMonth() + 1);
			if(mes < 10)  mes = '0' + (obj.getMonth() + 1); else mes = (obj.getMonth() + 1);        
			if(dia < 10)  dia = '0' + obj.getDate();        else dia = obj.getDate();        
			anno = obj.getFullYear();
			fecha = dia + '/' + mes + '/' + anno;
			return fecha;
	  	},
	  	/**
		* obtener la hora actual
		**/   
		tiempo: function(){
			obj = new Date();
			hora = obj.getHours();
			minutos = obj.getMinutes();
			segundos = obj.getSeconds();
			if(hora < 10) { hora = '0' + obj.getHours(); } else { hora = obj.getHours(); }
			if(minutos < 10) { minutos = '0' + obj.getMinutes(); } else { minutos = obj.getMinutes(); }
			tiempo = hora + ':' + minutos;
			return tiempo;
	  	}
	};

	ajax = { 
		/**
		* animacion cuando se envia una peticion
		**/         
		before: function(div, img){
			$(div).html('<p align="center"><img src="'+ img +'" style="margin: 5% auto; width: 20px;"></p>');
		},
		/**
		* notificacion por una cantidad limitada de segundos
		**/  
		notificacion: function (div, milisegundos){
			$('#' + div).slideDown();
			setTimeout(function(){
			$('#' + div).slideUp();
			}, milisegundos);
	  	},
	  	/**
		* mensajes del sistema
		**/  
		mensaje: function (div, msj, tipo){
			original = $('#' + div).html();        
			if(tipo == 'error'){
			    $('#' + div).html('<h4><span class="label label-danger"><strong>Error!</strong> '+ msj +'</span></h4>');
			}else if(tipo == 'success'){
			    $('#' + div).html('<h4><span class="label label-success"><strong>Satisfactorio!</strong> '+ msj +'</span></h4>');
			}else if(tipo == 'info'){
			    $('#' + div).html('<h4><span class="label label-info"><strong>Información:</strong> '+ msj +'</span></h4>');
			}
			setTimeout(function(){          
			    $('#' + div).html(original);
			}, 5000);
	  	},
	  	/**
		* habilita y deshabilita campos en base de datos
		**/
		activar: function(id, div, url, msj){
			$.ajax({
				type: 'POST',
				url: url,
				data: id,
				success: function (data) { 
					ajax.mensaje( div, msj, 'success');
				},
			});
	  	},
	  	/**
		* informacion al usuario
		**/  
		informacion: function (div, msj){
			original = $('#' + div).html();        
			$('#' + div).html('<i><b>'+ msj +'</b></i>');
			setTimeout(function(){          
		    	$('#' + div).html(original);
			}, 5000);
		},     
	};  

	transformar = { 
		
		/**
		* Transforma la primera letra en mayuscula
		**/      
		ucfirst: function (str) {
			//   example 1: ucfirst('kevin van zonneveld');
			//   returns 1: 'Kevin van zonneveld'
			str += '';
			var f = str.charAt(0).toUpperCase();
			return f + str.substr(1);
		},

		/**
		* Transforma la primera palabra
		**/        
	  	ucwords: function (str) {
			//   example 1: ucwords('kevin van  zonneveld');
			//   returns 1: 'Kevin Van  Zonneveld'
			//   example 2: ucwords('HELLO WORLD');
			//   returns 2: 'HELLO WORLD'
			return (str + '').replace(/^([a-z\u00E0-\u00FC])\s+([a-z\u00E0-\u00FC])/g, function($1) {
		    return $1.toUpperCase();
		  	});
	  	},

		/**
		* Formatea los numeros
		**/
		number_format: function (number, decimals, dec_point, thousands_sep) {
			//  discuss at: http://phpjs.org/functions/number_format/
			// original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
			// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// improved by: davook
			// improved by: Brett Zamir (http://brett-zamir.me)
			// improved by: Brett Zamir (http://brett-zamir.me)
			// improved by: Theriault
			// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// bugfixed by: Michael White (http://getsprink.com)
			// bugfixed by: Benjamin Lupton
			// bugfixed by: Allan Jensen (http://www.winternet.no)
			// bugfixed by: Howard Yeend
			// bugfixed by: Diogo Resende
			// bugfixed by: Rival
			// bugfixed by: Brett Zamir (http://brett-zamir.me)
			//  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
			//  revised by: Luke Smith (http://lucassmith.name)
			//    input by: Kheang Hok Chin (http://www.distantia.ca/)
			//    input by: Jay Klehr
			//    input by: Amir Habibi (http://www.residence-mixte.com/)
			//    input by: Amirouche
			//   example 1: number_format(1234.56);
			//   returns 1: '1,235'
			//   example 2: number_format(1234.56, 2, ',', ' ');
			//   returns 2: '1 234,56'
			//   example 3: number_format(1234.5678, 2, '.', '');
			//   returns 3: '1234.57'
			//   example 4: number_format(67, 2, ',', '.');
			//   returns 4: '67,00'
			//   example 5: number_format(1000);
			//   returns 5: '1,000'
			//   example 6: number_format(67.311, 2);
			//   returns 6: '67.31'
			//   example 7: number_format(1000.55, 1);
			//   returns 7: '1,000.6'
			//   example 8: number_format(67000, 5, ',', '.');
			//   returns 8: '67.000,00000'
			//   example 9: number_format(0.9, 0);
			//   returns 9: '1'
			//  example 10: number_format('1.20', 2);
			//  returns 10: '1.20'
			//  example 11: number_format('1.20', 4);
			//  returns 11: '1.2000'
			//  example 12: number_format('1.2000', 3);
			//  returns 12: '1.200'
			//  example 13: number_format('1 000,50', 2, '.', ' ');
			//  returns 13: '100 050.00'
			//  example 14: number_format(1e-8, 8, '.', '');
			//  returns 14: '0.00000001'

			number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
				return '' + (Math.round(n * k) / k).toFixed(prec);
			};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);      
		}, 

		strtolower: function (str) {
		  //  discuss at: http://phpjs.org/functions/strtolower/
		  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		  // improved by: Onno Marsman
		  //   example 1: strtolower('Kevin van Zonneveld');
		  //   returns 1: 'kevin van zonneveld'

		  return (str + '')
			.toLowerCase();
		},

		base64_encode: function (data) {
			//  discuss at: http://phpjs.org/functions/base64_encode/
			// original by: Tyler Akins (http://rumkin.com)
			// improved by: Bayron Guevara
			// improved by: Thunder.m
			// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// improved by: Rafał Kukawski (http://kukawski.pl)
			// bugfixed by: Pellentesque Malesuada
			//   example 1: base64_encode('Kevin van Zonneveld');
			//   returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
			//   example 2: base64_encode('a');
			//   returns 2: 'YQ=='
		  	var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
		  	var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
		    ac = 0,
		    enc = '',
		    tmp_arr = [];
			if (!data) {
			    return data;
			}
			do { // pack three octets into four hexets
			    o1 = data.charCodeAt(i++);
			    o2 = data.charCodeAt(i++);
			    o3 = data.charCodeAt(i++);

			    bits = o1 << 16 | o2 << 8 | o3;

			    h1 = bits >> 18 & 0x3f;
			    h2 = bits >> 12 & 0x3f;
			    h3 = bits >> 6 & 0x3f;
			    h4 = bits & 0x3f;

			    // use hexets to index into b64, and append result to encoded string
			    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
			} while (i < data.length);
		  	enc = tmp_arr.join('');
		  	var r = data.length % 3;
		  	return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
		}
	}; 

	/**
	* Reinicia el input
	**/
	$('.reiniciar').click(function() {
	    $(this).parent().siblings("input[type=hidden]").val('');
	    $(this).parent().siblings("input[type=text]").val('');
	    $(this).parent().siblings("input[type=text]").attr('disabled', false); 
	});

		
	/**
	* Elimina los datos del arreglo duplicado
	**/
	Array.prototype.unique = function(a){
	    return function(){return this.filter(a)}}(function(a,b,c){return c.indexOf(a,b+1)<0
	});
	
	/**
	* Delimita los caracteres permitidos
	**/
	(function(a){a.fn.caracteres=function(b){a(this).on({keypress:function(a){var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()}})}})(jQuery);
  })

}(window.jQuery)