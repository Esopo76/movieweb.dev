<div id="page-wrapper">
	<div class="row">
	    <div class="col-lg-12">
	        <h1><?php echo $titulo ?></h1>
	        <ol class="breadcrumb">
	       <!--   <li><a href="index.php"><i class="fa fa-home"></i> Escritorio</a></li>  -->
	        	<?php foreach ($breadcrumbs as $item): ?>
	        		<li>
		        		<?php if($item['link']): ?>
							<a href ="<?php echo base_url(); ?><?php echo $item['link'] ?>">
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
				<?php echo validation_errors('<div class="error">','</div>'); ?>
				
				<?php if (isset($error)):?>
					<div class="error">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<?php if (!isset($administrador)):?>
					<?php echo form_open('admin/usuarios/add'); ?>
				<?php else: ?>
					<?php echo form_open('admin/usuarios/update/'.$administrador['id_admin']); ?>
				<?php endif; ?>


				
					<label for="nombre" >Usuario</label>
					<input type="input" class="form-control" name="usuario" value="<?php echo ( isset($administrador['usuario']) )?$administrador['usuario']:''; ?>"/><br />
					<label for="text">Contrasena</label>
					<input type="password" class="form-control" name="password" value=""/><br />
					<label for="text">Email</label>
					<input type="input" class="form-control" name="email" value="<?php echo ( isset($administrador['email']) )?$administrador['email']:''; ?>"/><br />
							
					<?php if (!isset($administrador)):?>
						<input type="submit" name="submit" value="Añadir usuario" class="btn btn-success" />
					<?php else: ?>
						<input type="submit" name="submit" value="Modificar usuario" class="btn btn-success" />
					<?php endif; ?>
					
					<a href="<?php echo base_url();?>admin/usuarios" class="btn btn-default">Cancelar</a>
				</form>
			</div>
		</div>
	</div>



