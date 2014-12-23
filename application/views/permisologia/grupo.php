<script type="text/javascript">
	$(function() {
		$('#i_grupo').caracteres('qwertyuiopasdfghjklñzxcvbnmáéíóú')

		$(".estatus").on('ifUnchecked', function(event) {
			var id = $(this).attr('id');
			ajax.activar(id, 'msj_listado', '<?php echo base_url()?>permisologia/grupo_habilitar', 'Deshabilitado correctamente');
		});

		$(".estatus").on('ifChecked', function(event) {
			var id = $(this).attr('id');
			ajax.activar(id, 'msj_listado', '<?php echo base_url()?>permisologia/grupo_habilitar', 'Habilitado correctamente');
		});

		$('.editar').click(function () {
			id = $(this).attr('id');
			aux = $('#id_' + id).html();
			$('#i_nombre').val(aux);
			$('#id').val(id);
			
			$('#b_modificar').click(function () {
				a = validar.logico('i_nombre', 'i_nombre');
				b = validar.logico('id', 'id');

				if(a != 0 && b != 0){
					datos = $('#form_editar').serialize();
					$.ajax({
						type: 'POST',
						url: '<?php echo base_url()?>permisologia/grupo_modificar',
						data: datos,
						beforeSend: function(){
							ajax.todc('#listado_ajax');
						}, 
						success: function () {         
							$(location).attr('href', '<?php echo base_url()?>permisologia/grupo');
						}, 
					});
				}
			});      
		});

		$('#b_guardar').click(function () {
			a = validar.texto('i_grupo', 'i_grupo');
			if(a != 0){
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>permisologia/grupo_guardar',
					data: datos,
					beforeSend: function(){
						ajax.todc('#listado_ajax');
					}, 
					success: function () {         
						$(location).attr('href', '<?php echo base_url()?>permisologia/grupo');
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
		<li class="active">Grupo</li>
	</ol>      
</section>
<section class="content">
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Registro de Grupo</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<label for="i_grupo">Grupo</label>
						<input type="text" class="form-control" id="i_grupo" name="i_grupo" placeholder="Nombre del Grupo">
					</div>           
				</div>
				<div class="box-footer">
					<button type="button" id="b_guardar" class="btn btn-primary">Registrar</button>
				</div>
			</form>
			<div class="panel-footer">
				<info id="msj">Aquí aparecerán mensajes del sistema</info>
			</div>
		</div>
		<div id="listado_ajax">  
			<?php if(!empty($grupos)){ ?>
				<div class="panel panel-primary width-600 margin-auto">
					<div class="panel-heading">
						<h3 class="panel-title">Estatus de Grupos Registrados </h3>
					</div>           
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th width="350">Nombre</th>
									<th>Editar</th>
									<th>Estatus</th>
								</tr>
							</thead>
							<tbody>          
							<?php
								$i = 0;
								foreach ($grupos as $key) {
									$i++;
									$on = ($key->habilitado_grupo == '1') ? 'checked' : '';
									echo 
									'<tr>
										<td>'
											.$key->id_grupo.                    
										'</td>
										<td id="id_'.$key->id_grupo.'">'
											.$key->descripcion_grupo. 
										'</td>
										<td>
											<a href="#" id="'.$key->id_grupo.'" data-toggle="modal" data-target="#compose-modal" class="editar">
												<div class="btn-toolbar" role="toolbar">
													<div class="btn-group">
														<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
													</div>
												</div>
											</a>
										</td>
										<td align="center">
											<input type="checkbox" class="estatus" '.$on.'/>
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
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-envelope-o"></i> Modificar Grupo </h4>
			</div>
			 <form id="form_editar" role="form">
				<div class="modal-body">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Editar:</span>
							<input type="hidden" id="id" name="id">
							<input type="text" class="form-control" id="i_nombre" name="i_nombre" placeholder="Ingrese Nombre"> 
						</div>
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
					<button type="button" id="b_modificar" class="btn btn-success pull-left"><i class="fa fa-check"></i> Modificar </button>
				</div>
			</form>
		</div>
	</div>
</div>