<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="marco" class="col-md-12">
                <div class="col-md-3"id="peli_info">
                    <h1>Indiana Jones</h1>
                    <h3>Estreno 14/06/2014</h3>
                    <span class="duracion">Duración: 98min</span>
                    <span class="calificacion">Mayores de 9 años</span>
                    <a class="btn btn-info enlace_e" href="">ver cines</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container cuerpo">
    <div class="col-md-3 cines">
        <h4>Cines</h4>
        <ul>
        <?php foreach ($cines as $item): ?>
            
        <?php endforeach ?>
            <li><a href="<?php echo base_url()?>cine/<?php echo $item['id_cine']?>"><?php echo $item['nombre'] ?></a></li>
            
        </ul>
    </div>
    <div class="col-md-9 estrenos">
        <h4>Estrenos</h4>
        <div class="row">
            <?php foreach ($estrenos as $item): ?>
                <div class="col-md-2 col-sm-6 col-xs-6 cartel">
                    <a href="<?php echo base_url()?>pelicula/<?php echo $item['id']?>"><img src="<?php echo $item['url']?>/<?php echo $item['imagen'] ?>" alt="<?php echo $item['titulo_p']; ?>" title="<?php echo $item['titulo_p']; ?>"></a>
                </div>                
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-9 cartelera">
        <h4>cartelera</h4>
        <div class="row">
            <?php foreach ($cartelera as $item): ?>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <a href="<?php echo base_url()?>pelicula/<?php echo $item['id']?>"><img src="<?php echo $item['url']?>/<?php echo $item['imagen'] ?>" alt="<?php echo $item['titulo_p']; ?>" title="<?php echo $item['titulo_p']; ?>"></a>
                </div>                
            <?php endforeach ?>
        </div>
    </div>


    </div>

</div>
        