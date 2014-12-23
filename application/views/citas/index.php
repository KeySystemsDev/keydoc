<section class="content-header">
	<ol class="breadcrumb">
		<li><i class="fa fa-cogs"></i> Citas</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<?php 
			if(isset($sub_menu)){
				$k = 'A';
				foreach ($sub_menu as $key) {
					echo 
					'<div class="col-lg-3 col-xs-6">
						<a  href="'.base_url().$key->link_menu.'" class="small-box-footer">
							<div class="small-box bg-light-blue">
								<div class="inner text-center">
									<h3 class="seccion">
										'.$k.'
									</h3>
									<p>
										'.mysql_to_utf8($key->descripcion_menu, 'titulo').'
									</p>
								</div>
							</div>
						</a>
					</div>';
					$k ++;
				}
			}
		?>           
	</div>
</section>