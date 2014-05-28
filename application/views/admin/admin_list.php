<div id="page-wrapper">
	<div class="row">
	    <div class="col-lg-12">
	        <h1><?php echo $titulo ?> <small><?php echo $subtitulo ?></small></h1>
	        <ol class="breadcrumb">

	       <!--   <li><a href="index.php"><i class="fa fa-home"></i> Escritorio</a></li>  -->
	        	<?php foreach ($breadcrumbs as $item): ?>
	        		<li>
		        		<?php if($item['link']): ?>
							<a href ="<?php echo base_url(); ?>/<?php echo $item['link'] ?>">
						<?php endif; ?>
						<?php if ($item['icono']): ?>
							<i class="<?php echo $item['icono'] ?>"></i>
						<?php endif; ?>				
						<?php echo $item['nombre']; ?>
							<?php if ($item['link']): ?>
							</a>
						<?php endif; ?>
					</li>
		       	<?php endforeach; ?>
	        </ol>
			<div class="col-md-12">
				<?php if(isset($eliminada)): ?>
					<div class="alert alert-info alert-dismissable">
			              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			              	Datos de la id: <?php echo $eliminada; ?> eliminados
			        </div>
				<?php endif; ?>

				<?php if(isset($añadida)): ?>
					<div class="alert alert-info alert-dismissable">
			              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			              	Nuevo administrador añadido
			        </div>
				<?php endif; ?>
				<table id="myTable" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>
								Id
							</th>
							<th>
								Usuario
							</th>
							<th>
								email
							</th>
							
							<th>
								Operaciones
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($administradores as $value) :?>
							<tr>
								<td>
									<?php echo $value['id_admin']; ?>
								</td>
								<td>
									<?php echo $value['usuario']; ?>
								</td>
								<td>
									<?php echo $value['email']; ?>
								</td>

								<td>
									<a href="<?php echo base_url();?>admin/usuarios/edit/<?php echo $value['id_admin'];?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									<a href="<?php echo base_url();?>admin/usuarios/delete/<?php echo $value['id_admin'];?>" class="btn btn-danger"><i class="fa fa-eraser"></i></a>
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
			 	
				</table>

			</div>
		</div>
	</div>
</div>