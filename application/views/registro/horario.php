<script type="text/javascript">
	$(function() {    
		var temp = new Date();
		var now  = new Date(temp.getFullYear(), temp.getMonth(), temp.getDate() + 1, 0, 0, 0, 0);
		var chequeando = $('#i_fecha_consulta').datepicker({
			format: 'dd/mm/yyyy',
			language: 'es',
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		});
		$('#listado').dataTable();
		$("#s_consultorio, #s_especialidad, #s_dia_consulta").select2();
		$('#i_costo_consulta').caracteres('0123456789');
		$('#i_fecha_consulta').caracteres('0123456789/');
		$('#i_cupos').caracteres('0123456789');
		$('#i_hora_desde, #i_hora_hasta').caracteres('0123456789:amp');
		$('#i_hora_desde, #i_hora_hasta').timepicker({
			showInputs: false,
			showMeridian: false
		});    
		evento.mostrar('.mostrar');

		$('#b_enviar').click(function(event) { 
			a = validar.logico('s_consultorio');
			b = validar.logico('s_especialidad');
			c = validar.fecha('i_fecha_consulta');
			d = validar.logico('i_cupos', 'i_cupos');
			e = validar.string('i_hora_desde');
			f = validar.string('i_hora_hasta');
			g = validar.logico('i_costo_consulta', 'i_costo_consulta');   
		
			if(a != 0 && b != 0 && c != 0 && d != 0 && e != 0
			&& f != 0 && g != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>registro/horario-agregar',
					data: datos,
					success: function () {         
						$('#b_enviar').hide();
						evento.mostrar('.mostrar');
						ajax.mensaje('msj','Horario registrado con éxito', 'success');            
					}, 
				});       
			}else{
				ajax.mensaje('msj','Aun debe completar todos los campos', 'error');
			}
		}); 
	}); 
</script>

<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Registro de Horario</li>
	</ol>   
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Registro de Horario</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $arreglo['id_usuario'] ?>">
						<label for="s_consultorio">Consultorio:</label>
						<select style="width:100%" id="s_consultorio" name="s_consultorio"> 
							<option value="0" selected>Seleccionar</option>           
							<?php 
								if(isset($consultorios) && !empty($consultorios)){
									foreach ($consultorios as $key) {
										echo  
										'<option value="'.$key->id_consultorio.'"> '.mysql_to_utf8($key->nombre_consultorio, 'titulo').' </option>';
									}
								}
							?> 
						</select> 
					</div>
					<div class="form-group">
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
					<div class="form-group col-md-6">
						<label for="i_fecha_consulta">Fecha de Consulta</label>
						<input type="text" class="form-control" id="i_fecha_consulta" name="i_fecha_consulta" placeholder="99/99/9999" maxlength="10">
					</div>
					<div class="form-group col-md-6">
						<label for="i_cupos">Cupos Disponibles</label>
						<input type="text" class="form-control popover-msj" id="i_cupos" name="i_cupos" placeholder="99" maxlength="2" data-container="body" data-toggle="popover" data-placement="right" data-content="Indique la cantidad de cupos">
					</div>          
					<div class="form-group bootstrap-timepicker col-md-6">
						<label for="i_hora_desde">Hora de Inicio</label>
						<input type="text" class="form-control" id="i_hora_desde" name="i_hora_desde" placeholder="00:00 AM" maxlength="8">
					</div>        
					<div class="form-group bootstrap-timepicker col-md-6">
						<label for="i_hora_hasta">Hora de Culminación</label>
						<input type="text" class="form-control" id="i_hora_hasta" name="i_hora_hasta" placeholder="00:00 AM" maxlength="8">
					</div>
					<div class="form-group">
						<label for="i_costo_consulta">Costo de la Consulta</label>
						<input type="text" class="form-control popover-msj" id="i_costo_consulta po" name="i_costo_consulta" placeholder="999999" maxlength="6" data-container="body" data-toggle="popover" data-placement="left" data-content="Indique el costo de la consulta">
					</div>          
					<div class="box-footer">
						<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
					</div>
					<div class="btn-group col-md-push-3 mostrar">
						<a href="<?php echo base_url();?>registro/horario" class="btn btn-primary">Registrar otro Horario</a>
						<a href="<?php echo base_url();?>gestion/horario" class="btn btn-success">Gestionar Horario</a>
					</div>               
				</div>                
			</form>
			<div id="msj" class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div>
		</div>  
	</div>
</section>  
