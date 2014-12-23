<script type="text/javascript">
	$(function() {
		var temp = new Date();
		var now  = new Date(temp.getFullYear(), temp.getMonth(), temp.getDate(), 0, 0, 0, 0);
		var chequeando = $('#i_fecha_consulta').datepicker({
			format: 'dd/mm/yyyy',
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		});
		$('#listado').dataTable();
		$("#s_consultorio, #s_especialidad, #s_dia_consulta").select2();
		$('#i_costo_consulta').caracteres('0123456789.');
		$('#i_fecha_consulta').caracteres('0123456789/');
		$('#i_hora_desde, #i_hora_hasta').caracteres('0123456789:amp');
		$('#i_hora_desde, #i_hora_hasta').timepicker({
			showInputs: false
		});
		$('#i_fecha_consulta').datepicker({
			showInputs: false
		});
		evento.mostrar('.mostrar');

		$('#b_enviar').click(function(event) { 
			a = validar.fecha('i_fecha_consulta');
			b = validar.logico('i_cupos', 'i_cupos');
			c = validar.string('i_hora_desde');
			d = validar.string('i_hora_hasta');
			e = validar.logico('i_costo_consulta', 'i_costo_consulta');   
		
			if(a != 0 && b != 0 && c != 0 && d != 0 && e != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>gestion/horario-actualizar',
					data: datos,
					success: function () {         
						$('#b_enviar').hide();
						evento.mostrar('.mostrar');
						ajax.mensaje('msj','El Registro ha sido satisfactorio', 'success');            
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
		<li><i class="fa fa-cogs"></i> Gestión</li>
		<li class="active">Editar Horario</li>
	</ol>   
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Registro de Horario</h3>
			</div>
			<form id="form" role="form">
				<?php 
					if(isset($horarios) && !empty($horarios)){
						foreach ($horarios as $key) {
							$id_horario         = $key->id_horario;
							$id_usuario         = $key->id_usuario;
							$nombre_consultorio = $key->nombre_consultorio;
							$especialidad       = $key->especialidad;
							$desde_hora_horario = $key->desde_hora_horario;
							$hasta_hora_horario = $key->hasta_hora_horario;
							$cupos_horario      = $key->cupos_horario;
							$fecha_horario      = $key->fecha_horario;
							$costo_horario      = $key->costo_horario;
						}
					}
				?>        
				<input type="hidden" id="id_horario" name="id_horario" value="<?php echo $id_horario ?>">
				<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario ?>">
				<div class="box-body">
					<div class="form-group">
						<label for="i_consultorio">Consultorio</label>
						<input type="text" class="form-control" id="i_consultorio" name="i_consultorio" value="<?php echo mysql_to_utf8($nombre_consultorio, 'titulo') ?>" readonly>
					</div>
					<div class="form-group">
						<label for="i_especialidad">Especialidad</label>
						<input type="text" class="form-control" id="i_especialidad" name="i_especialidad" value="<?php echo mysql_to_utf8($especialidad, 'titulo') ?>" readonly> 
					</div>
					<div class="form-group col-md-6">
						<label for="i_fecha_consulta">Fecha de Consulta</label>
						<input type="text" class="form-control" id="i_fecha_consulta" name="i_fecha_consulta" placeholder="99/99/9999" maxlength="10" value="<?php echo  $fecha_horario  ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="i_cupos">Cupos Disponibles</label>
						<input type="text" class="form-control" id="i_cupos" name="i_cupos" placeholder="99" maxlength="2" value="<?php echo $cupos_horario ?>">
					</div>          
					<div class="form-group bootstrap-timepicker col-md-6">
						<label for="i_hora_desde">Hora de Inicio</label>
						<input type="text" class="form-control" id="i_hora_desde" name="i_hora_desde" placeholder="00:00 AM" maxlength="8" value="<?php echo $desde_hora_horario ?>">
					</div>        
					<div class="form-group bootstrap-timepicker col-md-6">
						<label for="i_hora_hasta">Hora de Culminación</label>
						<input type="text" class="form-control" id="i_hora_hasta" name="i_hora_hasta" placeholder="00:00 AM" maxlength="8" value="<?php echo $hasta_hora_horario ?>">
					</div>
					<div class="form-group">
						<label for="i_costo_consulta">Costo de la Consulta</label>
						<input type="text" class="form-control" id="i_costo_consulta" name="i_costo_consulta" placeholder="999999" maxlength="6" value="<?php echo $costo_horario ?>">
					</div>          
					<div class="box-footer">
						<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
					</div>
					<div class="btn-group col-md-push-4 mostrar">
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
