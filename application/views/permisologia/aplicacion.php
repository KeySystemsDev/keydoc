<script type="text/javascript">
	$(function() {
		$("#s_aplicacion, #s_grupo, #s_usuario").select2();

		$('#s_aplicacion, #s_grupo').change(function () {
			a = validar.logico('s_aplicacion', 's_aplicacion');
			b = validar.logico('s_grupo', 's_grupo');
			if(a != 0 && b != 0){
				$(location).attr('href', '<?php echo base_url()?>permisologia/aplicacion-listado/' + a + '/' + b);
			}   
		});

		$('#b_guardar').click(function () {
			a = validar.logico('s_aplicacion', 's_aplicacion');
			b = validar.logico('s_grupo', 's_grupo');
			c = validar.logico('s_usuario', 's_usuario');

			if(a != 0 && b != 0 && c != 0){
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>permisologia/aplicacion_guardar',
					data: datos,
					beforeSend: function(){
						ajax.todc('#listado_ajax');
					}, 
					success: function () {         
						$(location).attr('href', '<?php echo base_url()?>permisologia/aplicacion-listado/' + a + '/' + b);
					},          
				});
			}
		});
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Permisología</li>
		<li class="active">Aplicación & Usuario</li>
	</ol>    
</section>
<section class="content">  
	<div class="col-md-4 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Asignación de Usuario</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<label for="s_aplicacion">Aplicacion</label>
						<select style="width:315px" id="s_aplicacion" name="s_aplicacion">            
							<?php 
								if(isset($aplicacion)){
									$id_aplicacion = (isset($id_aplicacion)) ? $id_aplicacion : '';
									foreach ($aplicacion as $key) {
										if ($key->id_aplicacion == $id_aplicacion){
											echo '<option value="'.$key->id_aplicacion.'" selected>'.$key->descripcion_aplicacion.'</option>';
										}else{
											echo '<option value="'.$key->id_aplicacion.'">'.$key->descripcion_aplicacion.'</option>';
										}
									}
								}
							?>                
						</select> 
					</div>
					<div class="form-group">
						<label for="s_grupo">Grupo</label>
						<select style="width:315px" id="s_grupo" name="s_grupo">            
							<option value="0" selected>Seleccionar</option>
							<?php 
								if(isset($grupos)){
									$id_grupo = (isset($id_grupo)) ? $id_grupo : '';
									foreach ($grupos as $key) {
										if ($key->id_grupo == $id_grupo){
											echo '<option value="'.$key->id_grupo.'" selected>'.ucwords($key->descripcion_grupo).'</option>';
										}else{
											echo '<option value="'.$key->id_grupo.'">'.ucwords($key->descripcion_grupo).'</option>';
										}
									}
								}
							?>
						</select>  
					</div>
					<div class="form-group">
						<label for="i_usuario">Usuario</label>
						<select style="width:315px" id="s_usuario" name="s_usuario">            
							<option value="0" selected>Seleccionar</option>
							<?php 
								if(isset($usuarios)){
									$id_usuario = (isset($id_usuario)) ? $id_usuario : '';
									foreach ($usuarios as $key) {
										if ($key->id_usuario == $id_usuario){
											echo '<option value="'.$key->id_usuario.'" selected>'.ucwords($key->correo_usuario).'</option>';
										}else{
											echo '<option value="'.$key->id_usuario.'">'.ucwords($key->correo_usuario).'</option>';
										}
									}
								}
							?>
						</select>  
					</div>            
				</div>
				<div class="box-footer">
					<button type="button" id="b_guardar" class="btn btn-primary">Registrar</button>
				</div>
			</form>
		</div>
	</div>
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-2">
		<div id="listado_ajax">
			<?php if(!empty($listado)){ ?>
				<div class="panel panel-primary width-600 margin-auto">
					<div class="panel-heading">
						<h3 class="panel-title">Estatus de Grupos Registrados </h3>
					</div>           
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Aplicacion</th>
									<th>Grupo</th>
									<th>Usuario</th>
								</tr>
							</thead>
							<tbody>          
							<?php  
								$i = 0;
								foreach ($listado as $key) {
									$i++;
									echo 
									'<tr>
										<td>'
											.$key->descripcion_aplicacion.                    
										'</td>
										<td>'
											.$key->descripcion_grupo. 
										'</td>
										<td>'
											.$key->nombre_usuario. 
										'</td>
									</tr>';
								} 
							?>              
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						Mensajes de Notificacion: <info id="mensaje"> En esto momento no tiene ninguna notificación </info>
					</div>
				</div>
			<?php } ?>
		</div>   
	</div>
</section>