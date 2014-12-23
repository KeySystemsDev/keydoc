<script type="text/javascript">
	$(function(){
		evento.mostrar('.mostrar');
		$('#b_guardar').click(function(event){                                  
			a = b = c = 0;
			a = $('#ajax_img').width(); //Obtener ancho de imagen
			b = $('#ajax_img').height(); //Obtener largo de imagen
			c = $('#ajax_img').size(); //Obtener tamaño de imagen  

			$('#ancho').html(a);
			$('#alto').html(b);

			if(a <= 500 && b <= 500 && c <= 256){
				if(a >= 250 && b >= 250){
					if (a == b){
						$("#form").submit();
					}else{
						evento.mostrar('.mostrar');
						ajax.mensaje('msj','La imagen debe ser totalmente cuadrada', 'error');
					} 
				}else{
					evento.mostrar('.mostrar');
					ajax.mensaje('msj','La imagen es muy pequeña. Tamaño mínimo permitido 250px', 'error');
				} 
			}else{
				evento.mostrar('.mostrar');
				if(a>500){
					ajax.mensaje('msj','La imagen es muy ancha. Tamaño máximo: 500px', 'error');
				}else{
					if(b>500){
						ajax.mensaje('msj','La imagen es muy alta, Tamaño máximo: 500px', 'error');
					}         
				}
			}      
		});     
	});
</script>
<section class="content">  
	<div class="col-md-8 col-xs-offset-2">
		<form id="form" role="form" enctype="multipart/form-data" action="<?php echo base_url()?>configuracion/subir-foto" method="POST">
			<div class="box-body">          
				<div class="form-group" align="center">
					<img id="ajax_img" class="ajax-img thumbnail" src="<?php echo base_url()?>public/img/upload.png" />            
				</div>
				<div class="form-group" align="center">
					<div class="btn-group">
						<div class="archivo-subir btn btn-info">
							<span>Subir Foto</span>
							<input type="file" id="i_file" name="i_file" class="upload" />
						</div>
						<a href="<?php echo base_url();?>configuracion/perfil" class="btn btn-warning">Regresar</a>
					</div> 

				</div>
				<div class="form-group mostrar" align="center">
					<div class="btn-group">
						<button type="button" class="btn btn-default">Ancho: <b id="ancho"></b>px</button>
						<button type="button" class="btn btn-default">Alto: <b id="alto"></b>px</button>
					</div>         
				</div>
				<div class="form-group mostrar" align="center">
					<button type="button" id="b_guardar" class="btn btn-primary">Enviar</button>         
				</div>                          
			</div>
		</form>
	</div>
</section>

