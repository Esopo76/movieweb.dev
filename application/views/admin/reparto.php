
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $titulo ?> </h1>
            <ol class="breadcrumb">
           <!--   <li><a href="index.php"><i class="fa fa-home"></i> Escritorio</a></li>  -->
                <?php foreach ($breadcrumbs as $item): ?>				
                    <li>
                        <?php if ($item['link']): ?>
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

            <div class="row">
                <form action ="<?php echo base_url(); ?>admin/peliculas/reparto/<?php echo $pelicula['id_pelicula']; ?>"  role="form" method="post" id="form_add_reparto">
  
                    <div class="col-lg-12">
                        <!--Mostramos los errores en la validación del formulario-->
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>'); ?>
                        <?php if (isset($error)):?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $error; ?>
                                </div>
                        <?php endif; ?>
                        <?php if (isset($alta)):?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    La persona se ha dado de alta correctamente en el reparto.
                                </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label>Título </label>
                                    <input class="form-control" name="tit_dist" id="tit_dist" value="<?php echo (isset($pelicula['titulo_dist']) ? $pelicula['titulo_dist'] : 'Sin título'); ?>" disabled>
                                </div><br>
                            </div>                         
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Persona </label>                                   
                                    <select class="form-control" name="persona">
                                        <?php foreach ($personas as $item): ?>	
                                             <option value="<?php echo $item['id_persona']; ?>"><?php echo ($item['nombre'].' '.$item['apellidos']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>     
                        </div>
                        <div class="row">
                             <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="actor" id="optionsRadiosInline1" value="1" checked ><b> Actor </b></label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="actor" id="optionsRadiosInline2" value="0" <?php echo ( (isset($data['form_activo']) && $data['form_activo'] == 0 )?'checked':'');?> ><b> Director</b>
                                    </label>           
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label>Personaje </label>
                                    <input class="form-control" name="personaje" id="personaje" value="<?php echo (isset($_POST['personaje']) ? $_POST['personaje'] : ''); ?>">
                                </div>
                            </div><br> 
                        </div>

                        <button type="submit" class="btn btn-success" id="btn_add" >Alta</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" onclick="cancelar();">Cancelar</button><br><br>                    

                    </div>

                </form>
            </div><!-- /.row -->
        
            <div class="row">        
                <div class="table-responsive">
                   <table id="myTable" class="display" cellspacing="0" width="100%"">
                       <thead>
                           <tr>
                               <th>Persona </th>
                               <th>Actor/Director </th>
                               <th>Personaje </th>
                               <th>Eliminar </th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php foreach ($reparto as $item): ?>				
                               <tr>
                                   <td><?php echo ($item['nombre'].' '.$item['apellidos']); ?></td>
                                   <td><?php echo ($item['actor_sn'] == 1 ? 'Actor': 'Director'); ?></td>                                   
                                   <td><?php echo $item['personaje']; ?></td>                                           
                                   <td>
                                        <button  class="btn btn-danger" onclick="confirmar(<?php echo ($item['id_pelicula'].','.$item['id_reparto']); ?>)"  title="Borrar reparto" ><i class="fa fa-eraser fa-lg"></i></button>
                                   </td>
                               </tr>
                           <?php endforeach; ?>
                       </tbody>
                   </table>
               </div>
            </div>
        </div>
    </div><!-- /.row -->

        </div><!-- /.col12 -->
    </div><!-- /.row -->

</div><!-- /#page-wrapper -->


<script type="text/javascript">
    function cancelar() {
        // window.history.back()
        document.location.href = '/admin/peliculas/listado';
    }
    
    function confirmar(id_peli, id_reparto) {
        
        if (confirm("Está seguro de que desea eliminar la persona del reparto ")) {
            document.location.href = '/admin/peliculas/eliminar_reparto/'+id_peli+'/'+id_reparto;
        }
       
    }
</script>

