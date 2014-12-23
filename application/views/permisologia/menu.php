<script type="text/javascript">
	$(function() {
		$("#s_sub_menu, #s_menu, #s_grupo").select2();

		$('#s_grupo, #s_menu').change(function () {
			a = validar.logico('s_grupo', 's_grupo');
			b = validar.logico('s_menu', 's_menu');
			if(a != 0 && b != 0){
				$(location).attr('href', '<?php echo base_url()?>permisologia/menu-listado/' + a + '/' + b);
			}   
		});
		$(".estatus").on('ifUnchecked', function(event) {
			var id = $(this).attr('id');
			ajax.activar(id, 'msj_listado', '<?php echo base_url()?>permisologia/menu_habilitar', 'Deshabilitado correctamente');
		});
		$(".estatus").on('ifChecked', function(event) {
			var id = $(this).attr('id');
			ajax.activar(id, 'msj_listado', '<?php echo base_url()?>permisologia/menu_habilitar', 'Habilitado correctamente');
		});
		$('#b_guardar').click(function () {
			a = validar.logico('s_grupo', 's_grupo');
			b = validar.logico('s_menu', 's_menu');
			c = validar.logico('s_sub_menu', 's_sub_menu');

			if(a != 0 && b != 0 && c != 0){
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>permisologia/menu_guardar',
					data: datos,
					beforeSend: function(){
						ajax.todc('#listado_ajax');
					}, 
					success: function () {         
						$(location).attr('href', '<?php echo base_url()?>permisologia/menu-listado/' + a + '/' + b);
					}, 
				});
			}else{
				ajax.mensaje('msj','Debe completar todos los campos', 'error');
			}
		});
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Permisología</li>
		<li class="active">Grupo & Menu</li>
	</ol>  
</section>
<section class="content">  
	<div class="col-md-4 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Asignación de Menu</h3>
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
					<div class="form-group">
						<label for="s_menu">Menu</label>
						<select style="width:315px" id="s_sub_menu" name="s_sub_menu">            
							<option value="0" selected>Seleccionar</option>
								<?php 
									if(isset($lista_menu)){
										$id_menu = (isset($id_menu)) ? $id_menu : '';
										foreach ($lista_menu as $key) {
											if ($key->id_menu == $id_menu){
												echo '<option value="'.$key->id_menu.'" selected>'.utf8_decode($key->descripcion_menu).'</option>';
											}else{
												echo '<option value="'.$key->id_menu.'">'.utf8_decode($key->descripcion_menu).'</option>';
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
			<div class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div>      
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
									<th>Grupo</th>
									<th>Seccion</th>
									<th>Menu</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>          
							<?php  
								$i = 0;
								foreach ($listado as $key) {
									$i++;
									$on = ($key->habilitado_grupo_menu == '1') ? 'checked' : '';
									echo 
									'<tr>
										<td>'
											.$key->descripcion_grupo.                    
										'</td>
										<td>'
											.$key->menu_raiz. 
										'</td>
										<td>'
											.utf8_decode($key->descripcion_menu). 
										'</td>
										<td align="center">
											<input type="checkbox" class="square-blue estatus" '.$on.'/>
										</td>
									</tr>';
								} 
							?>              
							</tbody>
						</table>
					</div>
					<div class="panel-footer">
						<info id="msj_listado">Aquí aparecerán mensajes del sistema</info>
					</div>
				</div>
			<?php } ?>
		</div>   
	</div>
</section>