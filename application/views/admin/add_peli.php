
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
                <form action ="<?php echo base_url(); ?>admin/peliculas/add" enctype="multipart/form-data" role="form" method="post" id="form_add_peli">
                    <div class="col-lg-3">
                        <fieldset <?php echo (isset($alta) ? '' : 'disabled'); ?>>       
                            <a href="<?php echo base_url(); ?>admin/peliculas/reparto/<?php echo (isset($id_peli)? $id_peli : ''); ?>" class="btn btn-primary">Reparto</a><br>                            
                            <a href="<?php echo base_url(); ?>admin/peliculas/imagenes/<?php echo (isset($id_peli)? $id_peli : ''); ?>" class="btn btn-primary">Imágenes</a><br>
                            <a href="<?php echo base_url(); ?>admin/peliculas/videos/<?php echo (isset($id_peli)? $id_peli : ''); ?>" class="btn btn-primary">Vídeos</a><br>
                        </fieldset>
                        <br><br>
                         
                        <div class="list_idiomas">
                            <label>Doblajes </label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Idioma </th>
                                        <th>Audio </th>
                                        <th>Subtítulos </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($idiomas as $item): ?>	
                                        <tr>
                                            <td><?php echo $item['nombre']; ?></td>
                                            <td>
                                                <label class="checkbox-inline">
                                                  <input type="checkbox" name="audio[]" value="<?php echo $item['iso_idioma']; ?>">
                                                </label>
                                            </td>
                                            <td>
                                                <label class="checkbox-inline">
                                                  <input type="checkbox" name="sub[]" value="<?php echo $item['iso_idioma']; ?>">
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?><br>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-9">
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
                                    La película se ha dado de alta correctamente. Continue con el proceso
                                </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Título original </label>
                            <input class="form-control" name="tit_ori" id="tit_orig" value="<?php echo (isset($_POST['tit_ori']) ? $_POST['tit_ori'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Título distribución </label>
                            <input class="form-control" name="tit_dist" id="tit_dist" value="<?php echo (isset($_POST['tit_dist']) ? $_POST['tit_dist'] : ''); ?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Idioma original </label>
                                    <!--<input class="form-control" name="idioma_ori" id="nombre" value="<?php echo (isset($form_idioma_ori) ? $form_idioma_ori : ''); ?>">-->
                                    <select class="form-control" name="iso_idioma">
                                        <?php foreach ($idiomas as $item): ?>	
                                             <option value="<?php echo $item['iso_idioma']; ?>"><?php echo $item['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Año de producción </label>
                                    <input class="form-control" name="ano" id="ano" value="<?php echo (isset($_POST['ano']) ? $_POST['ano'] : ''); ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Duración</label>
                                    <input class="form-control" name="duracion" id="duracion" value="<?php echo (isset($_POST['duracion']) ? $_POST['duracion'] : ''); ?>" placeholder="HH:MM:SS">
                                </div>                                
                            </div>   
                        </div>
                        <div class="form-group">
                            <label>Dirección web de la película </label>
                            <input class="form-control" name="url_web" id="url_web" value="<?php echo (isset($_POST['url_web']) ? $_POST['url_web'] : ''); ?>">
                        </div>
                        <div class="form-group">
                            <label>Dirección web imdb </label>
                            <input class="form-control" name="url_imdb" id="url_imdb" value="<?php echo (isset($_POST['url_imdb']) ? $_POST['url_imdb'] : ''); ?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-6"> 
                                <div class="form-group">
                                    <label>Imágen principal</label>
                                    <input type="file" name="img1" id="img1">
                                </div>   
                            </div>
                            <div class="col-lg-6"> 
                                <div class="form-group">
                                    <label>Calificación </label>
                                    <select class="form-control" name="calificacion">
                                        <?php foreach ($calificaciones as $item): ?>	
                                             <option value="<?php echo $item['id_calificacion']; ?>"><?php echo $item['descripcion']; ?></option>
                                        <?php endforeach; ?>
                                   </select>
                                </div>
                            </div>
                        </div>
                      <div class="row">
                            <div class="col-lg-6">                    
                                <div class="form-group">
                                    <label>Fecha de estreno</label>
                                    <input class="form-control" name="fecha" id="fecha" placeholder="AAAA-MM-DD" value="<?php echo (isset($_POST['fecha']) ? $_POST['fecha'] : ''); ?>" >
                                </div>
                            </div>
                            <div class="col-lg-6"> 
                                <div class="form-group">
                                    <label>Valoración </label>
                                    <input class="form-control" name="valoracion" id="valoracion" value="<?php echo (isset($_POST['valoracion']) ? $_POST['valoracion'] : ''); ?>">
                                </div>
                            </div>
                        </div>                


                        <div class="form-group">
                            <label>Sinopsis</label>
                            <textarea class="form-control" name="resumen" id="desc"  cols="50" rows="5"><?php echo (isset($_POST['resumen']) ? $_POST['resumen'] : ''); ?></textarea>
                            <p class="help-block">Introduzca un resumen de la película</p>
                        </div><br><br>  

                        <button type="submit" class="btn btn-success" id="btn_add" <?php echo (isset($alta) ? 'disabled' : ''); ?>>Enviar</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" onclick="cancelar();">Cancelar</button>
                    </div>

                </form>
            </div><!-- /.row -->

        </div><!-- /.col12 -->
    </div><!-- /.row -->

</div><!-- /#page-wrapper -->


<script type="text/javascript">
    function cancelar() {
        // window.history.back()
        document.location.href = '/admin/peliculas/listado';
    }

</script>

