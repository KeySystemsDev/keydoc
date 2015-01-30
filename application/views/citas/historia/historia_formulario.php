<script type="text/javascript">
	$(function() {
		$('#i_monto_adicional').caracteres('0123456789');
		$('#i_monto_adicional').focusout(function(){
		  	monto_base = $('#i_monto_base').val();
		  	monto_adicional = $(this).val(); 
		  	monto_total = parseInt(monto_base) + parseInt(monto_adicional); 
		  	$('#i_monto_total').val(transformar.number_format(monto_total, 2, ',', '.'));
		});	

		$('#prueba').click(function(event) {
			
			ajax.before('#ajax-carga', '<?php echo base_url()?>public/img/ajax.gif');
			setTimeout(function(){
				$('#ajax-carga').hide();
			}, 5000);
		});
		$('#b_enviar').click(function(event) { 

			a = validar.string('i_observacion_publica');
			b = validar.string('i_observacion_privada');
		
			if(a != 0 && b != 0){               
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>citas/historia_agregar',
					data: datos,
					beforeSend: function(){
						ajax.before('#ajax-carga', '<?php echo base_url()?>public/img/ajax.gif');
					},
					success: function (data) {
						setTimeout(function(){
							$('#b_enviar, #ajax-carga').hide();						
							ajax.mensaje('msj','El registro se ha realizado satisfactoriamente', 'success');    
						}, 2000);

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
		<li><i class="fa fa-cogs"></i> Historia del Paciente</li>
	</ol>   
</section>
<section class="content">  
	<div class="col-md-8">
		<?php 
			foreach ($historia as $key) {
				$id_cita       = $key->id_cita;
				$costo_horario = $key->costo_horario;
			}
		?>
		<form id="form">
			<input type="hidden" id="id_cita" name="id_cita" value="<?php echo $id_cita ?>">
			<div class="form-group">
				<label for="i_monto_base">Monto Base</label>
				<input type="text" id="i_monto_base" class="form-control" name="i_monto_base" placeholder="Monto Base" value="<?php echo number_format($costo_horario, 2, ',',''); ?>" readonly>
			</div>
			<div class="form-group">
				<label for="i_monto_adicional">Monto Adicional</label>
				<input type="text" id="i_monto_adicional" class="form-control popover-msj" name="i_monto_adicional" placeholder="Monto Adicional" data-container="body" data-toggle="popover" data-placement="right" data-content="Ingrese el monto adicional de la cita (opcional).">
			</div>
			<div class="form-group">
				<label for="i_monto_total">Monto a Cancelar</label>
				<input type="text" id="i_monto_total" class="form-control popover-msj" name="i_monto_total" placeholder="Monto Total" readonly>
			</div>
			<div class="form-group">
				<label for="i_observacion_publica">Observacion Pública</label>
				<textarea class="form-control popover-msj" rows="5" id="i_observacion_publica" name="i_observacion_publica" placeholder="Observación Pública" maxlength="300" data-container="body" data-toggle="popover" data-placement="right" data-content="Esta observación la podrá observar el paciente y el doctor para el historial de la cita."></textarea>
			</div>
			<div class="form-group">
				<label for="i_observacion_privada">Observacion Privada</label>
				<textarea class="form-control popover-msj" rows="5" id="i_observacion_privada" name="i_observacion_privada" placeholder="Observación Privada" maxlength="300" data-container="body" data-toggle="popover" data-placement="right" data-content="Esta observación la podrá ver solo Ud. Aquí puede ingresar lo necesario para llevar su control y recordar el tratamiento en una próxima oportunidad."></textarea>
			</div>
			<div class="form-group">
				<label id="msj">Mensajes del sistema</label>				
			</div>

			<button class="btn btn-success" type="button" id="b_enviar"><i class="fa fa-pencil-square-o"></i> Registrar</button>

		</form>
		<br>	
	</div>
</section>


