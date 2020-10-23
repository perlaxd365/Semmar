
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Proyectos</h3>
                        <p> <a href="<?php echo SERVERURL?>home">INICIO</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <br>
    <br>


<ul class="nav nav-tabs justify-content-center" >
  <li class="nav-item">
    <?php

    $numero="";

    $pagina=explode("/",$_GET['views']);
     if (isset($pagina[1])) {
      $numero=$pagina[1];
    }
     ?>
    <a class="nav-link <?php if($numero=='1'){echo 'active';} ?>"  href="<?php echo SERVERURL;?>property/1/1" ><div class="row justify-content-center">
    <img width="50" height="50" src="<?php echo SERVERURL;?>vistas/img/sectores/SECTOR1.png">
</div>SECTOR PESQUERO</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($numero=='2'){echo 'active';} ?>"  href="<?php echo SERVERURL;?>property/2/1" ><div class="row justify-content-center">
    <img width="50" height="50" src="<?php echo SERVERURL;?>vistas/img/sectores/SECTOR2.png" >
</div>SECTOR MINERO</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($numero=='3'){echo 'active';} ?>" href="<?php echo SERVERURL;?>property/3/1"><div class="row justify-content-center">
    <img width="50" height="50" src="<?php echo SERVERURL;?>vistas/img/sectores/SECTOR3.png" >
</div>SECTOR AGROINDUSTRIAL</a>
  </li>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($numero=='4'){echo 'active';} ?>" href="<?php echo SERVERURL;?>property/4/1"><div class="row justify-content-center">
    <img width="50" height="50" src="<?php echo SERVERURL;?>vistas/img/sectores/SECTOR4.png">
</div>SECTOR SIDERURGICO</a>
  </li>
</ul>


 <div class="appertment_area appertment_area2" style="padding-top: 70px">
        <div class="container">
            <div class="row">



       <?php require_once './controladores/catalagoControlador.php';
        $doc = new catalagoControlador();
        
         $pagina=explode("/",$_GET['views']);

         echo $doc->paginador_catalago_controlador($pagina[2],15,$pagina[2],$pagina[1]);
         ?>

                
                
            </div>
        </div>
    </div>


</div>


    <!-- appertment_area_start  -->
   
    <!-- appertment_area_end  -->
    
    <!-- testimonial_area  -->

   