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
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<tr>
							<th width="5%">#</th>
							<th width="30%">Paciente</th>
							<th width="40%">Consultorio</th>
							<th width="10%">Fecha</th>
							<th width="15%">Acción</th>
						</tr>
						<?php
							if(isset($pacientes) && !empty($pacientes)){
								$i = 0;
								foreach ($pacientes as $key) {
									$i++; 
									echo 
									'<tr>
										<td>'.$i.'</td>
										<td>'.ucwords($key->nombre_paciente).'</td>
										<td>'.ucfirst($key->nombre_consultorio).'</td>
										<td>'.str_replace('-', '/', $key->fecha_horario).'</td>
										<td>
											<a href="'.base_url().'citas/historia/paciente-'.base64_encode($key->cedula_perfil).'">
												<span class="btn btn-sm btn-info">
												<i class="fa fa-edit"></i> Atender</span>
											</a>
										</td>
									</tr>';
								}
							}else{
								echo
								'<tr>
									<th colspan="5">No se encontraron resultados.</th>
								</tr>';
							}
						?>                   
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
