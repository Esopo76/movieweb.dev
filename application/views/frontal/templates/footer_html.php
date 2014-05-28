<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>js/code.js"></script>
        <?php if(isset($estrenos)):?>
        <script>
        $(document).ready(function(){
        	var alturacines = $('.cines').height();
			var alturacuerpo = $('.cuerpo').height();
			var alturaestrenos = $('.estrenos').height();
			var alturacartelera = $('.cartelera').height();
			var derecha = alturaestrenos+alturacartelera;
			
			if (alturacines < alturacuerpo) {
				$('.cines').height(alturacuerpo-28);
			};

			if (alturacines > derecha) {
					$('.cartelera').height(alturacartelera+alturacines-derecha);
				};
			
			$( window ).resize(function() {
					if (alturacines < alturacuerpo) {
					$('.cines').height(alturacuerpo-28);
				};
				if (alturacines > derecha) {
					$('.cartelera').height(alturacartelera+alturacines-derecha);
				};
				
			});
			var incremento = -1;
			var intervalo =  setInterval(function(){cargaImagen()},3000);


			var images = new Array();
			<?php $cont=0;?>
			<?php foreach ($estrenos as $item):?>
			images[<?php echo $cont; ?>] = "<?php echo $item['url']?>/<?php echo $item['imagen']?>";
			<?php $cont++; ?>			
			<?php endforeach; ?>


			var titulos = new Array();
			<?php $cont=0;?>
			<?php foreach ($estrenos as $item):?>
			titulos[<?php echo $cont; ?>] = "<?php echo $item['titulo_p'] ?>";
			<?php $cont++; ?>			
			<?php endforeach; ?>
			
			var fechas = new Array();
			<?php $cont=0;?>
			<?php foreach ($estrenos as $item):?>
			fechas[<?php echo $cont; ?>] = "<?php echo date('d/m/Y',strtotime($item['estreno'])); ?>";
			<?php $cont++; ?>			
			<?php endforeach; ?>

			var duraciones = new Array();
			<?php $cont=0;?>
			<?php foreach ($estrenos as $item):?>
			<?php 
				$hora = $item['duracion'];
				list($horas, $minutos, $segundos) = explode(':', $hora);
				$minutos = round(($horas * 60 ) + ($minutos) + ($segundos/60)); 
			?>
			duraciones[<?php echo $cont; ?>] = "<?php echo $minutos; ?>";
			<?php $cont++; ?>			
			<?php endforeach; ?>

			var calificaciones = new Array();
			<?php $cont=0;?>
			<?php foreach ($estrenos as $item):?>
			calificaciones[<?php echo $cont; ?>] = "<?php echo $item['descripcion']; ?>";
			<?php $cont++; ?>			
			<?php endforeach; ?>

			var enlaces = new Array();
			<?php $cont=0;?>
			<?php foreach ($estrenos as $item):?>
			enlaces[<?php echo $cont; ?>] = "<?php echo base_url()?>pelicula/<?php echo $item['id']; ?>";
			<?php $cont++; ?>			
			<?php endforeach; ?>
			




			function cargaImagen(){
				if(incremento>=images.length-1){
					incremento = -1;
					return cargaImagen();
				} else {
					incremento++;
					$('#marco').fadeOut("slow",function(){
						$('#marco').css("background-image","url('"+images[incremento]+"')");
						$('#marco h1').text(titulos[incremento]);
						$('#marco h2').text('Estreno '+fechas[incremento]);
						$('#marco .duracion').text(duraciones[incremento]+' min.');
						$('#marco .calificacion').text(calificaciones[incremento]);
						$('.enlace_e').attr("href", enlaces[incremento]);
						$('#marco').fadeIn("slow");
					})
				}
			}
		});
		</script>
	 	<?php endif ?>
	</body>
</html>
