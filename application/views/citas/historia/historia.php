<script type="text/javascript">
	$(document).ready(function() {
		$('#i_cedula').caracteres('veVE0123456789');
		$('#buscar').click(function(event) {			
			cedula = $('#i_cedula').val();
			cedula_base64 = transformar.base64_encode(cedula);
			a = validar.cedula('i_cedula');
			if (a != 0) {
				$(location).attr('href', '<?php echo base_url()?>citas/historia/paciente-' + cedula_base64);
			}else{
				ajax.mensaje('msj', 'Debe ingresar una cedula válida', 'error');
			}
		});
	});
</script>
<section class="content-header">
  	<ol class="breadcrumb">
	    <li><i class="fa fa-cogs"></i> Historia del Paciente</li>
  	</ol>
</section>
<section class="content">
    <div class="col-md-6 col-xs-offset-3">
        <div class="box box-primary">
            <form id="form" role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="i_cedula">Cédula</label>
                        <input type="text" class="form-control" id="i_cedula" name="i_cedula" maxlength="9" placeholder="Ingrese cédula del paciente">
                    </div>           
                </div>
                <div class="box-footer">
                    <button type="button" id="buscar" class="btn btn-primary">Buscar</button>
                </div>
            </form>
            <div class="panel-footer">
                <info id="msj">Aquí aparecerán mensajes del sistema</info>
            </div>
        </div> 
    </div>

	<div class="row">
		<div class="col-xs-12">
			<p align="center"><b>Pacientes</b></p>
			<div class="box">				
				<div class="box-body" style="text-align: center;">
					<div class="row">
						<?php 
							if(isset($pacientes) && !empty($pacientes)){
								foreach ($pacientes as $key) {
									echo
									'<div class="col-md-3">
										<ul class="list-group">                 
											<li class="list-group-item" align="center">
												<a href="'.base_url().'citas/historia/paciente-'.base64_encode($key->cedula_perfil).'" class="btn-sm btn-default">'.ucwords($key->nombre_paciente).'</a>
											</li>
											<a href="'.base_url().'citas/historia/paciente-'.base64_encode($key->cedula_perfil).'" class="list-group-item" align="center" style="padding:0px;">
												<img src="'.base_url().$key->url_imagen_perfil.'" width="100%" alt="'.mysql_to_utf8($key->nombre_paciente, 'titulo').'" class="img-responsive"/>
											</a>
											<li class="list-group-item" align="center">												
												<a href="'.base_url().'citas/historia/paciente-'.base64_encode($key->cedula_perfil).'" class="btn-sm btn-success">Atender</a>
											</li>
										</ul>								
									</div>';
								}
							}else{
								echo 
								'
								<div class="alert alert-danger" style="margin-right:15px; margin-bottom:0px;">
                                    <b><i class="fa fa-user-md"></i> En estos momentos no posee ningún paciente.</b>
                                </div>
								'
								;
							}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
