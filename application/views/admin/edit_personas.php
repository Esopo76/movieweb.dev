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

				<?php if (!isset($personas)):?>
					<?php echo form_open('admin/personas/add'); ?>
				<?php else: ?>
					<?php echo form_open('admin/personas/update/'.$personas['id_persona']); ?>
				<?php endif; ?>


				
					<label for="nombre" >Nombre</label>
					<input type="input" class="form-control" name="nombre" value="<?php echo ( isset($personas['nombre']) )?$personas['nombre']:''; ?>"/><br />
					<label for="text">Apellidos</label>
					<input type="input" class="form-control" name="apellidos" value="<?php echo ( isset($personas['apellidos']) )?$personas['apellidos']:''; ?>"/><br />
					<label for="text">Número asociación de actores/directores</label>
					<input type="input" class="form-control" name="asoc" value="<?php echo ( isset($personas['num_asoc']) )?$personas['num_asoc']:''; ?>"/><br />
					<label for="text">País</label>
				
					<select name="pais" class="form-control">
						<?php foreach ($paises as $key => $value): ?>
							<option value="<?php echo $value['iso_pais']; ?>"><?php echo $value['nombre_pais']; ?></option>
						<?php endforeach ?>
					</select>
					<br><br>
					

					
					<?php if (!isset($personas)):?>
						<input type="submit" name="submit" value="Añadir Persona" class="btn btn-success" />
					<?php else: ?>
						<input type="submit" name="submit" value="Modificar Persona" class="btn btn-success" />
					<?php endif; ?>
					
					<a href="<?php echo base_url();?>admin/personas" class="btn btn-default">Cancelar</a>
				</form>
			</div>

		</div>
	</div>
</div>
