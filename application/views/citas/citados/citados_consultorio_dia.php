<!--
* Modal para confirmar el rechazo
-->
<script type="text/javascript">
    $(function() {
        $('#b_rechazar').click(function(event) {             
          
            a = validar.logico('id_horario');
            c = validar.string('i_mensaje');

            datos = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>citas/citas_eliminar_todas',
                data: datos, 
                success: function (data) {
                    $('.ocultar').hide();        
                    setTimeout(function(){ 
                        $(location).attr('href', '<?php echo base_url()?>citas/citados');
                    }, 2000);                  
                }, 
            });      
        }); 
    });
</script>

<section class="content-header">
    <ol class="breadcrumb">
        <li><i class="fa fa-cogs"></i> Citados del día</li>
    </ol>
</section>
<section class="content"> 
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">        
                <?php
                    foreach ($consultorio as $key) {
                        echo
                        '<a href="'.base_url().'citas/citados/consultorio-'.base64_encode($key->id_consultorio).'" class="list-group-item disabled">
                            '.mysql_to_utf8($key->nombre_consultorio, 'titulo').'
                        </a>';
                    }
                ?>      
                <?php
                    foreach ($fecha as $key) {
                        $id_horario = $key->id_horario;
                        echo
                        '<a href="'.base_url().'citas/citados/consultorio-'.base64_encode($key->id_consultorio).'" class="list-group-item disabled">
                            <span class="badge" style="background: red;"><span class="fa fa-times"></span></span>
                            '.mysql_to_utf8($key->fecha_horario, 'titulo').'
                        </a>';
                    }
                ?>     
            </ul>
            <div class="box box-info">
                <form id="form" role="form" enctype="multipart/form-data" action="<?php echo base_url()?>citas/citas-eliminar-todas" method="POST">
                    <input type="hidden" id="id_horario" name="id_horario" value="<?php echo $id_horario; ?>">
                    <div class="box-body">
                        <div>
                            <h2 class="seccion" align="center">Eliminar todas las Citas </h2>
                            <p>Este proceso se utiliza en caso de que usted no pueda asistir a las citas agendadas este día recordándole que el proceso es <b class="seccion">"Irreversible"</b>. </p>
                            <p> Luego de eliminar todas las citas se le enviara automáticamente una notificación a todos los pacientes agendados este día.</p>
                        </div>

                        <div class="form-group">
                            <label for="i_mensaje">Descripcion del Motivo</label>
                            <textarea class="form-control" rows="3" id="i_mensaje" name="i_mensaje" placeholder="Descripción" maxlength="300"></textarea>
                        </div>
                                       
                        <div class="box-footer">
                            <div class="btn-group">
                                <a href="#" data-toggle="modal" data-target="#modal-eliminar-citas" class="btn btn-danger">¡Si, Debo cancelarlas!</a>
                                <a href="#" data-toggle="modal" data-target="#modal-eliminar-citas" class="btn btn-danger">
                                  <span class="fa fa-times"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>      
        </div>
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title" style="font-size: 14px;"><i class="fa fa-calendar"></i>&nbsp; Pacientes del día Seleccionado</h3>                                    
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Paciente</th>
                            <th width="20%">Cédula</th>
                            <th width="20%">Edad</th>                            
                            <th width="20%">Fecha</th>
                        </tr>
                        <tr>      
                            <?php              
                                if(isset($pacientes) && !empty($pacientes)){
                                    $i = 0;                  
                                    foreach ($pacientes as $key) {
                                        $i++; 
                                        echo 
                                        '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.mysql_to_utf8($key->nombre_paciente, 'titulo').'</td>
                                            <td>'.$key->cedula_perfil.'</td>
                                            <td>'.$key->edad.' Años</td>                                            
                                            <td>'.str_replace('-', '/', $key->fecha_horario).'</td>
                                        </tr>';
                                    }
                                }
                            ?>              
                        </tr>  
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>   

<div class="modal fade" id="modal-eliminar-citas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" align="center">¡Confirmación!</h4>
            </div>        
            <div class="modal-body">
                ¿Esta seguro de cancelar la cita de todos los pacientes el día de hoy?                
            </div>
            <div class="modal-footer ocultar">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No, Aún no.</button>
                <button type="button" class="btn btn-success" id="b_rechazar">¡Si, Enviar!</button>          
            </div>
        </div>
    </div>
</div>