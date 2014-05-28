<!-- Menú lateral -->
<ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-home"></i> Escritorio</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-key"></i>  Administradores <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>admin/usuarios/listado"><i class="fa fa-list"></i> Listado</a></li>
            <li><a href="<?php echo base_url(); ?>admin/usuarios/add"><i class="fa fa-plus"></i> Añadir</a></li>
        </ul>
    </li>		
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-university"></i>  Cines <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>admin/cines/listado"><i class="fa fa-list"></i> Listado</a></li>
            <li><a href="<?php echo base_url(); ?>admin/cines/add"><i class="fa fa-plus"></i> Añadir</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-video-camera"></i>  Películas <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>admin/peliculas/listado"><i class="fa fa-list"></i> Listado</a></li>
            <li><a href="<?php echo base_url(); ?>admin/peliculas/add"><i class="fa fa-plus"></i> Añadir</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-star"></i>  Actores/Directores <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>admin/personas/listado"><i class="fa fa-list"></i> Listado</a></li>
            <li><a href="<?php echo base_url(); ?>admin/personas/add"><i class="fa fa-plus"></i> Añadir</a></li>
        </ul>
    </li>    
    
</ul>
