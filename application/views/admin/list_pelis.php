
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $titulo ?></h1>
            <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $item): ?>				
                    <li>
                        <?php if ($item['link']): ?>
                            <a href ="<?php echo $item['link'] ?>">
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
            <?php if (isset($mostrar_msg)): ?>
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>

             <div class="table-responsive">
                <table id="myTable" class="display" cellspacing="0" width="100%"">
                    <thead>
                        <tr>
                            <th>Id </th>
                            <th>Título </th>
                            <th>Cartel </th>
                            <th>Fecha estreno </th>
                            <th>Sinopsis </th>
                            <th>Operaciones </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peliculas as $item): ?>				
                            <tr>
                                <td><?php echo $item['id_pelicula']; ?></td>
                                <td><?php echo $item['titulo_ori']; ?></td>
                                <td><img src="<?php echo ($item['url_img'].'/'.$item['tit_img']); ?>" style="height: 100px"/></td>
                                <td><?php echo $item['f_estreno_bcn']; ?></td>                                           
                                <td style="max-width:500px"><?php echo $item['resumen']; ?></td>                                           
                                <td>
                                    <button  class="btn btn-primary" onclick="document.location.href = '/admin/peliculas/modificar/<?php echo $item['id_pelicula']; ?>';"  title="Editar pelicula" ><i class="fa fa-edit fa-lg"></i></button>  					

                                    <button  class="btn btn-danger" onclick="confirmar(<?php echo $item['id_pelicula']; ?>)"  title="Borrar producto" ><i class="fa fa-eraser fa-lg"></i></button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.row -->

</div><!-- /#page-wrapper -->

</div><!-- /#wrapper -->


<script>
    function confirmar(id_peli) {
        
        if (confirm("Está seguro de que desea eliminar la película ")) {
            document.location.href = '/admin/peliculas/eliminar/'+id_peli;
        }
        else {
            <?php $mostrar_msg = false; ?> //borramos el mensaje
            document.location.href = '/admin/peliculas/listado';
        }
    }

</script>
