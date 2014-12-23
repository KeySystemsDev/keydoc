<script type="text/javascript">
	$(function() {
		$('#listado').dataTable();
		$("#s_especialidad").select2();
		evento.mostrar('.mostrar');

		$('#b_enviar').click(function(event) { 
			a = validar.logico('s_especialidad');  

			if(a != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>registro/especialidad-agregar',
					data: datos, 
					success: function () {         
						$('#b_enviar').hide();
						evento.mostrar('.mostrar');
						ajax.mensaje('msj','Especialidad registrada con éxito', 'success');            
					}, 
				});      
			}
		}); 
	}); 
</script>

<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Registro de Especialidad</li>
	</ol>   
</section> 
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Registro de Especialidad</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" id="usuario" name="usuario" value="<?php if (isset($arreglo)) {  echo $arreglo['id_usuario']; }?>">
						<label for="s_especialidad">Especialidad:</label>
						<select style="width:100%" id="s_especialidad" name="s_especialidad"> 
							<option value="0" selected>Seleccionar</option>           
							<?php 
								if(isset($especialidades) && !empty($especialidades)){
									foreach ($especialidades as $key) {
										echo  
										'<option value="'.$key->id_tipo.'"> '.mysql_to_utf8($key->nombre_tipo, 'titulo').' </option>';
									}
								}
							?> 
						</select> 
					</div>                             
					<div class="box-footer">
						<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
					</div>
					<div class="btn-group col-md-push-3 mostrar">
						<a href="<?php echo base_url();?>registro/especialidad" class="btn btn-primary">Registrar otra Especialidad</a>
						<a href="<?php echo base_url();?>gestion/especialidad" class="btn btn-success">Gestionar Especialidades</a>
					</div>
				</div>
			</form>
		</div>  
	</div>
</section>    
