<script type="text/javascript">
	$(function(){      
		$('#b_enviar').click(function(event) { 
			a = validar.cedula('i_cedula');
			
			if(a != 0){                           
				datos = $('#form').serialize();
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url()?>registro/recepcionista-buscar',
					data: datos,
					beforeSend: function(){
						ajax.before('#ajax', '<?php echo base_url()?>public/img/ajax.gif');
					},          
					success: function (data) {          
						$('#ajax').html(data);       
					},                                         
				});           
			}else{
				ajax.mensaje('msj','Aún debe completar todos los campos', 'error');
			}
		});
	});
</script>
<section class="content-header">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url().'registro'?>"><i class="fa fa-cogs"></i> Registro</a></li>
		<li class="active">Elegir Recepcionista</li>
	</ol>   
</section>
<section class="content">
	<div class="row">
		<div class="col-md-6 col-md-push-3">
			<div class="box box-primary">
				<div class="box-body">
					<form id="form" role="form">
						<div class="box-body">
							<div class="form-group">
								<label for="i_cedula">Cédula de Identidad</label>
								<input type="text" class="form-control popover-msj" id="i_cedula" name="i_cedula" placeholder="v00000000" maxlength="9" data-container="body" data-toggle="popover" data-placement="left" data-content="Formato: v22444555 / e99333555"> 
							</div>         
							<div class="box-footer">
								<button type="button" id="b_enviar" class="btn btn-primary">Registrar</button>
							</div>
						</div>                
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="ajax" class="content">
</section>
