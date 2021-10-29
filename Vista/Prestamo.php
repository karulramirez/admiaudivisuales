<!DOCTYPE html>
<?php ob_start();?>
<!-- Se utiliza para evitar errores a la hora de recargar la pagina tras un cambio -->
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> PRESTAMO </title>

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
<!---->
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="Prestamo.php" class="site_title"><span>Bienvenidos</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="images/infotep.jpg">
						</div>
					</div>

					<br />
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
										<li><a href="Registro_usuarios.php">Formumario Registo usuarios</a></li>
										<li><a href="Registo_de_equipo.php">Formumario Registo</a></li>	
										<li><a href="Prestamo.php">Formumario Prestamo del equipo</a></li>
										<li><a href="Devolucion.php">Recepcion de equipo</a></li>
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
										<li> <a> Compromiso prestamos de Equipo </a> </li>
									</ul>
                           
								</div>
                    
            </div>
		</div>
	</div>

	<!-- top navigation -->
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
									<img src="images/img.jpg" alt="">John Doe
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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
												<span>John Smith</span>
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
			<?php
			#con este include todas las instancias llamadas pueden usar esta funcion
			require "../DB/Functions_Mysql.php";
			?>
			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Formulario de prestamos de equipos audiovisuales </h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form method="POST" action="Prestamo.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Cedula <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="cedula" id="first-name" required class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Serieal del equipo (SN#) <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="serial" id="first-name" required class="form-control ">
											</div>
										</div>
										
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align"> Dia de entrega <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input id="birthday" name="fecha" class="date-picker form-control" placeholder="yyyy-mm-dd" type="text" required onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
												<script>
													function timeFunctionLong(input) {
														setTimeout(function() {
															input.type = 'text';
														}, 60000);
													}
												</script>
											</div>
										</div>
									

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<input type="submit" value="Confirmar" name="enviar" class="btn btn-success">
											</div>
										</div>

									</form>
									<?php
									if (isset($_POST['enviar'])) {include "../Controlador/prestar_eq.php";}
									?>
								</div>
							</div>
						</div>
					</div>
			<!-- /footer content -->
			<form method="POST" action="Prestamo.php" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Serieal del equipo (SN#) <span class="required">*</span>
				</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="number" id="first-name" name="equipo" required="required" class="form-control ">
					</div>
			</div>
			<div class="item form-group">
			  <div class="col-md-6 col-sm-6 offset-md-3">
				  <input type="submit" name="buscar" value="Buscar" class="btn btn-primary" type="button">
				</div>
			</div>
			</form>
			<?php
			$codBusqueda = ""; 
			if (isset($_POST['buscar'])) {include "../Controlador/buscar_eq.php";}
			?>
			<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
	<div class="x_panel">
	  <div class="x_title">
		<h2><small>Entrega de equipos </small></h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		</ul>	
			<div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Cedula</th>
                          <th>Nombre </th>
                          <th>apellido</th>
                          <th>Progrma/Area</th>
						  <th>telefono</th>
                          <th>serial equipo</th>
                          <th>Cargador</th>
						  <th>Hora de la entrega</th>
						  <th>Fecha de la entrega</th>
						  <th>Fecha de la devolucion</th>
                          <th>Entrega</th>
                        </tr>
                      </thead>


                      <tbody>
					  <?php
                       include "../controlador/mostrar_prestamos.php";
					  ?>
                  
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>

		</div>
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
	<?php ob_end_flush(); ?>
	<!-- Se utiliza para evitar errores a la hora de recargar la pagina tras un cambio -->
</body></html>
