  <!DOCTYPE html>
  <html lang="es">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
        <!-- login.css -->
        <link href="<?php echo base_url();?>css/login.css" rel="stylesheet">

        <!-- Add custom CSS here -->
        <link href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
        <link rel="stylesheet" href="<?php echo base_url();?>css/peliculas.css">

        
    </head>

    <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"><!-- se cierra en head_menu.php -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/admin">movieweb admin</a>
        </div>  
      <div class="collapse navbar-collapse navbar-ex1-collapse"> <!-- se cierra en head_menu.php -->