<!DOCTYPE html>
<?php include "../DB/v_session.php" ?>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Registro usarios</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- starrr -->
	<link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="Registro_usuarios.php" class="site_title"><span>Bienvenidos</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="images/infotep.jpg">
						</div>
						
					</div>
					<!-- /menu profile quick info -->

					<br />

					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                    <li><a href="Registro_usuarios.php">Formumario Registo usuarios</a></li>
										<li><a href="Registo_de_equipo.php">Formumario Registo audiovisuales</a></li>	
										<li><a href="Prestamo.php">Formumario Prestamo del equipo</a></li>
										<li><a href="mora.php">Retraso devolucion de equipo</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Mantenimiento <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
										<li><a href="MantenimientoEquipos.php">Mantenimiento Computo</a></li>
										<li><a href="Registro_mantenimiento.php">Registro de Mantenimiento</a></li>
                                    </ul>

								<li><a><i class="fa fa-desktop"></i> Reportes <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li> <a> Reporte de prestamos</a> </li>
										<li> <a> Reporte de registro equipos </a> </li>
										<li> <a> Reporte de de usarios </a> </li>
										<li> <a> Compromiso prestamos de Equipo </a> </li>
									</ul>
                           
								</div>       
                    </div>
			
				</div>
			</div>
			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="images/img.jpg" alt=""><?php include "../controlador/mostrar_name.php"?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="../DB/cerrar_session.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>

							<li role="presentation" class="nav-item dropdown open">
								<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-envelope-o"></i>
									<span class="badge bg-green">1</span>
								</a>
								<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
									<li class="nav-item">
										<a class="dropdown-item">
											<span alt="Profile Image" ></span>
											<span>
												<span><?php include "../controlador/mostrar_name.php"?></span>
												<span class="time">Hace 3 minutos </span>
											</span>
											<span class="message">
												vencieron el tiempo de devolcuion del usario 122164508 jose perez docente 
											</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Formulario de registro de equipos audiovisuales</small></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<?php
									#con este include todas las instancias llamadas pueden usar esta funcion
									include "../DB/Functions_Mysql.php";
									?>
									<form method="POST" action="Registro_usuarios.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Cedula <span class="required">*</span>
											</label>
											<div class="col-md-4 col-sm-4 ">
												<input type="number" name="cedula" id="first-name" required class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name"> Nombre <span class="required">*</span>
											</label>
											<div class="col-md-4 col-sm-4 ">
												<input type="text" id="last-name" name="nombre" required class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Apellido</label>
											<div class="col-md-4 col-sm-4 ">
												<input id="middle-name" class="form-control" type="text" required name="apellido">
											</div>
										</div>	
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">faculta</label>
											<div class="col-md-4 col-sm-4 ">
												<input id="middle-name" class="form-control" type="text" name="facultad">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Rol</label>
											<div class="col-md-2 col-sm-2 ">
												<select name="tipoUsuario" class="select2_single form-control" tabindex="-1">
													<option></option>
													<option value="Estudiante">Estudiante</option>
													<option value="Docente">Docente</option>
												</select>
											</div>
										
											</div>
										
                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Telefono</label>
											<div class="col-md-4 col-sm-4 ">
												<input id="middle-name" class="form-control" type="number" name="tel">
											</div>
										</div>
                                        <div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Correo</label>
											<div class="col-md-4 col-sm-4 ">
												<input id="middle-name" class="form-control" type="text" name="correo">
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<input type="submit" class="btn btn-success" value="Enviar" name="enviar">
												<!--<button type="submit" class="btn btn-success">Enviar</button>-->
											</div>
										</div>
									</form> 

									<?php require("../controlador/excelToDBUsuarios.php") ?> 
                  					<form enctype="multipart/form-data"  action="./Registro_usuarios.php" method="POST">
										<input name="csvFile" type="file">
										<button type="submit" class="btn btn-success">cargar usuarios</button>
									</form>

									<form action="../controlador/DBToExcelUsuario.php" method="POST" enctype="multipart/form-data">
										<button name="descargar" value="descargar" type="submit" class="btn btn-success">descargar lista</button>
									</form>


									<?php
									if (isset($_POST['enviar'])) {include "../Controlador/insertar.php";}
									?>
									

									<div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Cedula</th>
                          <th>Nombre</th>
						  <th>Apellido</th>
                          <th>Facultad</th>
                          <th>tel</th>
						  <th>correo</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include "../controlador/mostrarUsuarios.php";
					  ?>	
                      </tbody>
                    </table>
								</div>
							</div>
						</div>
					</div>
			<!-- /footer content -->
			
		</div>
	</div>
	

	<!-- jQuery -->
	<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="../vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="../vendors/moment/min/moment.min.js"></script>
	<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="../vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="../vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="../vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="../vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

</body></html>
