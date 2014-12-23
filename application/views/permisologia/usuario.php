
<script type="text/javascript">
	$(function() {
		$("#i_pass").charCount({
			allowed: 15,    
			warning: 8,
			counterText: 'Restante: '   
		});

		$(".estatus").on('ifUnchecked', function(event) {
			var id = $(this).attr('id');
			ajax.activar(id, 'msj_listado', '<?php echo base_url()?>permisologia/usuario_habilitar', 'Deshabilitado correctamente');
		});

		$(".estatus").on('ifChecked', function(event) {
			var id = $(this).attr('id');
			ajax.activar(id, 'msj_listado', '<?php echo base_url()?>permisologia/usuario_habilitar', 'Habilitado correctamente');
		});

		$('#b_guardar').click(function () {
			a = validar.correo('i_email');
			b = validar.password('i_pass');
			c = validar.password('i_confirmar_pass');
			if(a != 0){
				if(b != 0){
					if (b == c) {
						if(a != 0 && b != 0){
							var datos = $("#form").serialize();
							$.ajax({
								type: 'POST',
								url: '<?php echo base_url()?>permisologia/usuario_guardar',
								data: datos,
								beforeSend: function(){
									ajax.todc('#listado_ajax');
								},         
								success: function (data) {          
									$(location).attr('href', '<?php echo base_url()?>permisologia/usuario'); 
								}
							});
						}        
					}else{
						ajax.mensaje('msj','Su contraseña no coinciden', 'error');
					}
				}else{
					ajax.mensaje('msj','Por su seguridad la contraseña debe contener al menos 8 caracteres', 'error');
				}
			}else {
				ajax.mensaje('msj','Primero debe ingresar un correo válido', 'error');
			}
		});
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Permisología</li>
		<li class="active">Usuario</li>
	</ol>  
</section>
<section class="content">  
	<div class="col-md-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Registro de Usuario</h3>
			</div>
			<form id="form" role="form">
				<div class="box-body">
					<div class="form-group">
						<label for="i_email">Correo:</label>
						<input type="email" class="form-control" id="i_email" name="i_email" placeholder="Correo Electronico">
					</div>
					<div class="form-group">
						<label for="i_pass">Contraseña:</label>
						<input type="password" class="form-control" id="i_pass" name="i_pass" placeholder="Contraseña" maxlength="15">
					</div>
					<div class="form-group">
						<label for="i_confirmar_pass">Repertir Contraseña:</label>
						<input type="password" class="form-control" id="i_confirmar_pass" placeholder="Contraseña" maxlength="15">
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
			<?php if(!empty($usuarios)){ ?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Estatus de Grupos Registrados </h3>
					</div>           
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th width="400">Correo</th>
									<th>Estatus</th>
								</tr>
							</thead>
							<tbody>          
							<?php
								$i = 0;
								foreach ($usuarios as $key) {
									$i++;
									$on = ($key->habilitado_usuario == '1') ? 'checked' : '';
									echo 
									'<tr>
										<td>'
											.$i.                    
										'</td>
										<td id="id_'.$key->id_usuario.'">'
											.$key->correo_usuario. 
										'</td>
										<!--<td>
											<a href="#" id="'.$key->id_usuario.'" data-toggle="modal" data-target="#compose-modal" class="editar">
												<div class="btn-toolbar" role="toolbar">
													<div class="btn-group">
														<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
													</div>
												</div>
											</a>
										</td>-->                 
										<td align="center">
											<input type="checkbox" id="'.$key->id_usuario.'" class="estatus" '.$on.'/>
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
				<h4 class="modal-title"><i class="fa fa-envelope-o"></i> Modificar Usuario </h4>
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
					<button type="submit" id="b_modificar" class="btn btn-success pull-left"><i class="fa fa-check"></i> Modificar </button>
				</div>
			</form>
		</div>
	</div>
</div>