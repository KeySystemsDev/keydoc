<section class="content-header">
    <ol class="breadcrumb">
        <li><i class="fa fa-cogs"></i> Horarios del Doctor Seleccionado</li>
    </ol>    
</section>
<section class="content">  
    <div class="col-md-6 col-md-push-3">
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
            </div>        
        </div>
    </div>      
</section>
<section class="content">  
    <div class="box box-primary">
        <div class="box-body"> 
            <div class="box-header">
                <article class="col-md-2"> 
                    <?php
                        if(isset($doctor) && !empty($doctor)){
                            foreach ($doctor as $key) {
                                echo     
                                '<div class="thumbnail">
                                    <img src="'.base_url().$key->url_imagen_perfil.'" width="100%" class="img-responsive">
                                </div>';
                            }
                        }
                    ?> 
                </article>      
                <article class="col-md-3">
                    <ul class="list-group">        
                        <?php
                            foreach ($especialidad as $key) {
                                echo
                                '<li class="list-group-item disabled">
                                    '.mysql_to_utf8($key->nombre_tipo, 'titulo').'
                                </li>';
                            }
                        ?>
                        <?php
                            foreach ($estado as $key) {
                                echo
                                '<li class="list-group-item disabled">
                                    '.mysql_to_utf8($key->nombre_tipo, 'titulo').'
                                </li>';
                            }
                        ?>
                        <?php
                            foreach ($municipio as $key) {
                                echo
                                '<li class="list-group-item disabled">
                                    '.mysql_to_utf8($key->nombre_tipo, 'titulo').'
                                </li>';
                            }
                        ?>
                        <?php
                            foreach ($doctor as $key) {
                                echo
                                '<a href="'.base_url().'citas/agendar/'.str_replace('_', '-', $url_1).'/'.str_replace('_', '-', $url_2).'/'.str_replace('_', '-', $url_3).'" class="list-group-item disabled">
                                    <span class="badge" style="background: red;"><span class="fa fa-times"></span></span>
                                    '.mysql_to_utf8($key->nombre_perfil, 'titulo').'
                                </a>';
                            }
                            if (!$amistad) {
                                echo
                                '<a href="#" class="list-group-item active" style="color: #FFF;">
                                    <span class="badge" style="background: #FFF;"><span class="fa fa-arrow-right"></span></span>
                                    Enviar Solicitud
                                </a>';
                            }
                        ?>   
                    </ul>          
                </article>
                <article class="col-md-7"> 
                    <?php 
                        if ($amistad) {
                            foreach ($doctor as $key) {
                                echo '
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"><i class="fa fa-pencil-square-o"></i> <b>Doctor:</b> '.ucwords($key->nombre_perfil).'</a></li>
                                    <li><a href="#"><i class="fa fa-mail-forward"></i> <b>Cédula:</b> '.ucwords($key->cedula_perfil).'</a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> <b>Correo:</b> '.strtolower($key->correo_usuario).'</a></li>
                                    <li><a href="#"><i class="fa fa-folder"></i> <b>Web:</b> '.strtolower($key->portal_web_perfil).'</a></li>
                                </ul>';                
                            }
                        }else{
                            echo 
                            '<div class="callout callout-info col-md-12">
                                <h4>¡Importante!</h4>
                                <p>Podrás ver su información cuando eseas su amigo o sea aprobada tu primera cita.</p>
                            </div>';
                        }                  
                    ?> 
                </article>       
            </div>   
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Consultorio</th>
                                    <th width="20%">Especialidad</th>
                                    <th width="15%">Fecha</th>
                                    <th width="10%">Desde</th>
                                    <th width="10%">Hasta</th>
                                    <th width="5%">Costo</th>
                                    <th width="10%">Acción</th>
                                </tr>
                                <?php                 
                                    if(isset($horarios) && !empty($horarios)){
                                        $i = 0;
                                        foreach ($horarios as $key) {
                                            $i++; 
                                            echo 
                                            '<tr>
                                                <td>'.$i.'</td>
                                                <td>'.mysql_to_utf8($key->nombre_consultorio, 'titulo').'</td>
                                                <td>'.mysql_to_utf8($key->especialidad, 'titulo').'</td>
                                                <td>'.$key->fecha_horario.'</td>
                                                <td>'.$key->desde_hora_horario.'</td>
                                                <td>'.$key->hasta_hora_horario.'</td>
                                                <td>'.$key->costo_horario.'</td>
                                                <td>
                                                  <a href="'.base_url().'citas/agendar/'.str_replace('_', '-', $url).'/horario-'.base64_encode($key->id_horario).'"><span class="btn btn-sm btn-success"><i class="fa fa-check"></i> Agendar</span></a>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                ?>                   
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
