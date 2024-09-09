<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">

        <!-- boststrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

	<!-- Icons Fontawesome -->
	<script src="https://kit.fontawesome.com/5ec9b8fd98.js" crossorigin="anonymous"></script>

    <!--local -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/CSS/style_home.css">
    <script src="<?php echo base_url; ?>assets/JS/jquery-3.7.1.min.js" ></script>
    <script src="<?php echo base_url; ?>assets/JS/menu.js" ></script>

	<!-- Datateblas -->
    <link rel="stylesheet" href="<?php echo base_url; ?>assets/CSS/datatables.min.css">
    <script src="<?php echo base_url; ?>assets/JS/datatables.min.js" ></script>

	<!-- Select2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- alertas -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Styles -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <title>Planilla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<!-- Menu -->
    <div class="sidebar">
    	<div class="logo-details">
			<a class="logo_name" href="<?php echo base_url; ?>Inicio">LACTEOS EL SUR</a>
    	    <i class='bx bx-menu' id="btn" ></i>
    	</div>
    <ul class="nav-list" style="padding-left: 0;">
      	<!-- planilla -->
      	<li id="Menu_planillas">
        	<div class= "item0" >
        	  	<a>
        	  		<i class="bx  bxs-chevron-down"></i>
        	  		<span class="links_name">Planillas</span>
        	  	</a>
        	  	<span class="tooltip0">Planillas</span>
        	</div>
        	<!-- Submenu -->
        	<div class="sub-menu" >
        	    <div  class= "item1">
        	        <a  class="nav-link" href="<?php echo base_url; ?>Planilla_Salarial" style="margin: 0.1rem;">
        	            <i class='bx bx-book'></i>
        	            <span class="links_name" >Planillas de Salarios</span>
        	        </a>
        	        <span class="tooltip1">Planillas Salarios</span>
        	    </div>
        	    <div class= "item2">
        	        <a class="nav-link" href="<?php echo base_url; ?>Aguinaldo" style="margin: 0.1rem;">
        	        	<i class='bx bx-book-bookmark'></i>                    
        	        	<span class="links_name" >Planillas de Aguinaldo</span>
        	        </a>
        	        <span class="tooltip2">Planillas Aguinaldo</span>
        	    </div>                                                       
        	</div>
      	</li >

		<!-- Empleados -->
      	<li>
      		<a class="nav-link" href="<?php echo base_url; ?>Empleados" >
      			<i class='bx bx-user' ></i>
      			<span class="links_name">Empleado</span>
      		</a>
      		<span class="tooltip">Empleado</span>
     	</li>

		<!-- Deducciones de Ley -->
		<li>
        	<div class= "item0" >
        	  	<a>
				  	<i class='bx bx-pie-chart-alt-2' ></i>
        	  		<span class="links_name">Deducciones</span>
        	  	</a>
        	  	<span class="tooltip0">Deducciones</span>
        	</div>
        	<!-- Submenu -->
        	<div class="sub-menu" >
        	    <div class= "item1">
        	        <a class="nav-link" href="<?php echo base_url; ?>Prestaciones" style="margin: 0.1rem;">
						<i class="fa-solid fa-hand-holding-dollar"></i>
        	            <span class="links_name" >Prestaciones de Ley</span>
        	        </a>
        	        <span class="tooltip1">Prestaciones de Ley</span>
        	    </div>
        	    <div class= "item2">
					<a class="nav-link" href="<?php echo base_url; ?>Renta" style="margin: 0.1rem;">
						<i class="fa-solid fa-scale-balanced"></i>                
        	        	<span class="links_name" >Renta</span>
        	        </a>
        	        <span class="tooltip2">Renta</span>
        	    </div>                                                       
        	</div>
      	</li >
     	<li class="profile">
     	    <div class="profile-details">
     	      	<img src="<?php echo base_url; ?>assets/IMG/Login_icono.png" alt="profileImg">
     	      	<div class="name_job">
     	      	  	<div class="name">LACTEOS</div>
     	      	  	<div class="job">Sistema Web Planillas</div>
     	      	</div>
     	    </div>
     	    <a href="<?php echo base_url; ?>Login/salir"><i class='bx bx-log-out' id="log_out" ></i></a>
     	</li>
    </ul>
  	</div>
  	<!-- Menu End -->

  	<!-- // Contenedor -->  
  	<section class="home-section">
    <!-- titulo -->
    <div class="d-flex justify-content-center p-2 text-white" style="background-color: #0f469a;">
     	<div class="row justify-content-md-center" style="width: 90%;">
     	 	<div class="col col-lg-2">
     	 		<img  class="rounded float-start" style="width:100%;" src="<?php echo base_url; ?>assets/IMG/LOGOSUPERLAC.png" alt="">
     	 	</div>
     	 	<div class="col-md-4 align-self-center">
     	 		<p  class="fs-3 " style="justify-content: center;"  >Sistema de Planillas LACTEOS EL SUR</p>
     	 	</div>
     	</div>
   </div>