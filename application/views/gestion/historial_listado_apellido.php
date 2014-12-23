<script type="text/javascript">
	$(function() {

		var temp = new Date();
		var now  = new Date(temp.getFullYear(), temp.getMonth(), temp.getDate(), 0, 0, 0, 0);
		var chequeando = $('#i_fecha_desde, #i_fecha_hasta').datepicker({
			format: 'dd/mm/yyyy',
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
		});
		$('#i_fecha_desde').caracteres('0123456789/');
		$('#i_fecha_hasta').caracteres('0123456789/');
		$("#s_especialidad").select2(); 

		$('#b_enviar').click(function () {
			a = validar.logico('s_especialidad', 's_especialidad');
			b = validar.fecha('i_fecha_desde');
			b = str_replace('/', '-', b);
			c = validar.fecha('i_fecha_hasta');
			c = str_replace('/', '-', c);

			if(a != 0 || b != 0 || c != 0){
				$(location).attr('href', '<?php echo base_url()?>gestion/historial-filtrar/especialidad-' + a + '/desde-' + b + '/hasta-' + c);
			}   
		});
		
		$('.filtro').click(function () {
			a = $(this).attr('id');      
			if(a != 0){
				$(location).attr('href', '<?php echo base_url()?>gestion/historial-filtrar-apellido/apellido-' + a);
			}   
		});

		function str_replace(search, replace, subject, count) {
			var i = 0,
				j = 0,
				temp = '',
				repl = '',
				sl = 0,
				fl = 0,
				f = [].concat(search),
				r = [].concat(replace),
				s = subject,
				ra = Object.prototype.toString.call(r) === '[object Array]',
				sa = Object.prototype.toString.call(s) === '[object Array]';
			s = [].concat(s);
			if (count) {
				this.window[count] = 0;
			}

			for (i = 0, sl = s.length; i < sl; i++) {
				if (s[i] === '') {
					continue;
				}
				for (j = 0, fl = f.length; j < fl; j++) {
					temp = s[i] + '';
					repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
					s[i] = (temp)
						.split(f[j])
						.join(repl);
					if (count && s[i] !== temp) {
						this.window[count] += (temp.length - s[i].length) / f[j].length;
					}
				}
			}
			return sa ? s : s[0];
		}    
				
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Gestión</li>
		<li class="active">Historial</li>
	</ol>    
</section>
<section class="content"> 
	<form id="form" role="form">
		<div class="box-body">
			<table class="table table-hover">
				<?php
					echo 
					'<tr>';
						foreach (range('A', 'Z') as $letra) {
							echo
							'<td>
								<a href="#" class="filtro" id="'.strtolower($letra).'">'.$letra.'</a>
							</td>';
						}
					echo 
					'</tr>';
				?>                  
			</table>  

			<div class="col-md-4">
				<div class="box box-solid box-info">
					<div class="box-header">
						<h3 class="box-title">Selecciona la Especialidad</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="s_especialidad">Especialidad</label>
							<select style="width:100%" id="s_especialidad" name="s_especialidad">
								<option value="0" selected> Seleccionar</option>  
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
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="box box-solid box-info">
					<div class="box-header">
						<h3 class="box-title">Selecciona la Fecha</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
								<label for="i_fecha_desde">Fecha Desde</label>
								<input type="text" class="form-control" id="i_fecha_desde" name="i_fecha_desde" placeholder="99/99/9999" maxlength="10">
						</div>
						<div class="form-group">      
								<label for="i_fecha_hasta">Fecha Hasta</label>
								<input type="text" class="form-control" id="i_fecha_hasta" name="i_fecha_hasta" placeholder="99/99/9999" maxlength="10">
						</div>        
					</div>
				</div>     
			</div>
			<div class="col-md-4">
				<div class="box box-solid box-info">
					<div class="box-header">
						<h3 class="box-title">Selecciona la Fecha</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
						</div>
					</div>         
				</div>     
			</div>      
	</form>    
</section>

<section  class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">

				<!---->
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
						<thead>
							<th width="20%">#</th>
							<th width="20%">Nombre Paciente</th>
							<th width="20%">Cedula</th>
							<th width="20%">Sexo</th>
							<th width="20%">Fecha Agenda</th>
						</thead>
						<tbody>
							<?php
								if(isset($pacientes) && !empty($pacientes)){
									$i = 0;
									foreach ($pacientes as $key) {
										$i++;
										if ($key->sexo_perfil == 1){
											$sexo = 'Femenino';
										}else{
											$sexo = 'Masculino';
										}                     
										echo 
										'<tr>
											<td>'.$i.'</td>
											<td>'.mysql_to_utf8($key->nombre_paciente, 'titulo').'</td>
											<td>'.$key->cedula_perfil.'</td>
											<td>'.$sexo.'</td>
											<td>'.fecha_mysql_to_php($key->fecha_agenda_cita, 'fecha-hora').'</td>
										</tr>';
									}
								}
							?>                                     
						</tbody>
					</table>
				</div> 
			</div>
		</div>
	</div>
</section>