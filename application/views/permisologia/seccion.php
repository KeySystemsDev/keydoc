<script type="text/javascript">
	$(function() {
		$("#s_grupo, #s_menu").select2();

		$('#s_grupo').change(function () {
			a = validar.logico('s_grupo', 's_grupo');
			if(a != 0){
				$(location).attr('href', '<?php echo base_url()?>permisologia/seccion-listado/' + a);
			}   
		});

		$('#b_guardar').click(function () {
			a = validar.logico('s_grupo', 's_grupo');
			b = validar.logico('s_menu', 's_menu');
			if(a != 0 && b != 0){
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>permisologia/seccion_guardar',
					data: datos,
					beforeSend: function(){
						ajax.todc('#listado_ajax');
					}, 
					success: function () {         
						$(location).attr('href', '<?php echo base_url()?>permisologia/seccion-listado/' + a);
					},
				});
			}
		});
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Permisología</li>
		<li class="active">Sección</li>
	</ol>  
</section>
<section class="content">  
	<div class="col-md-4 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Asignación de Sección</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
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
						<label for="s_menu">Menu</label>
						<select style="width:315px" id="s_menu" name="s_menu">            
							<option value="0" selected>Seleccionar</option>
								<?php 
									if(isset($menu_raiz)){
										foreach ($menu_raiz as $key) {
											if ($key->id_menu == $id_menu){
												echo '<option value="'.$key->id_menu.'" selected>'.$key->descripcion_menu.'</option>';
											}else{
												echo '<option value="'.$key->id_menu.'">'.$key->descripcion_menu.'</option>';
											}
										}
									}
								?> 
						</select>  
					</div>            
				</div>
				<div class="box-footer">
					<button type="button" id="b_guardar" class="btn btn-primary">Asignar</button>
				</div>
			</form>
		</div>
	</div>
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-2">
		<div id="listado_ajax">
			<?php if(!empty($listado_seccion)){ ?>
				<div class="panel panel-primary width-500 margin-auto">
					<div class="panel-heading">
						<h3 class="panel-title">Estatus de Seccion Asignado </h3>
					</div>           
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th width="300">Nombre</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody>          
							<?php
								$i = 0;
								foreach ($listado_seccion as $key) {
									$i++;
									echo 
									'<tr>
										<td>'
											.$key->id_menu.                    
										'</td>
										<td>'
											.$key->descripcion_menu. 
										'</td>
										<td>
											<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-minus-sign"></span></button>
										</td>
									</tr>';
								}
							?>                
							</tbody>
						</table>
					</div>
					<div class="panel-body">
						<pre>Mensajes de Notificacion: <info id="mensaje"> En esto momento no tiene ninguna notificación </info></pre>
					</div>
				</div>
			<?php } ?>
		</div>   
	</div>
</section>