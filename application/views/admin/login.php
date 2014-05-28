		<?php echo validation_errors('<div class="error">','</div>'); ?>
		<?php if (isset($error)):?>
			<div class="error">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>
		<form name="form-login" class="form-login" method="post" action="<?php echo base_url(); ?>admin/principal/check">
			<div class="campos">
				<label for="user">Usuario</label>
				<input type="text" id="user" name="user">
				<br>
				<label for="pass">Contraseña</label>
				<input type="password" id="pass" name="pass">
			</div>
			<button>Entrar</button>
		</form>
