!function ($) {

  $(function(){
    
    validar = { 
      /* ----------------------------------------------------
      | VALIDA QUE EL CAMvalorO DEL USUARIO SEA UN CORREO
      | ELECTRONICO, QUE NO TENGA CARACTERES ESPECIALES
      | Y QUE EL SERVIDOR SEA VALIDO.
      |
      |
      |----------------------------------------------------*/
      correo: function (div) {
        this.div = $('#' + div).val();
        arroba = 0;
        punto = 0;
        ind = 0;

        for(i=1;i<(this.div.length-1);i++){
          if(this.div[i] == '@'){
            arroba++;
            ind = i;
          }
        }
        for(i=ind;i<(this.div.length-1);i++){
          if(this.div[i] == '.')
            punto++;
        }

        if((arroba == 1) && (punto > 0)){
          patron = /[\^$*+?=!¡¿#~€¬!"%&?:|\\/()\[\]{}]/;
          if (patron.test(this.div)){
            $('#' + div).css({'border-left':'3px solid #FF8484'});
            return 0;
          }else{
            $('#' + div).css({'border-left':'1px solid #CCCCCC'});
            return this.div;
          }          
        }else{
          $('#' + div).css({'border-left':'3px solid #FF8484'});
          return 0;
        }
      },
      string: function (valor) {
        this.valor = $('#' + valor).val();
        if(this.valor.length >= 2){
          $('#' + valor).css({'border-left':'1px solid #CCCCCC'});
          return this.valor;
        }else{
          $('#' + valor).css({'border-left':'3px solid #FF8484'});
          return 0;
        }
      },
      notificacion: function (div, form, milisegundos){
        $('#' + form).slideUp();
        $('#' + div).slideDown();
        setTimeout(function(){
          $('#' + div).slideUp();
          $('#' + form).slideDown();
        }, milisegundos);
      } 
    } 
  })


}(window.jQuery)

