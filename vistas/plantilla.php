<!doctype html>
<div class="loader"></div>
<html class="no-js" lang="zxx">


    <?php include "modulos/link.php";?>
    <?php session_start(['name'=>'semmar']); ?>


<body>
    <!-- header-start -->
    
    
    <?php
    
    include "./controladores/loginControlador.php";
    $lc = new loginControlador();
     include "modulos/header.php";?>

    <!-- header-end -->


    <!-- about_area_start  -->
   <?php 

  $peticionAjax=false;
  require_once"./core/mainModel.php";
  require_once"./controladores/vistasControlador.php";

    $vt = new vistasControlador();
    $vistasR =$vt -> obtener_vistas_controlador();

    if ($vistasR=="home"|| $vistasR=="404"){
      if ($vistasR=="home") {

        require_once"./vistas/contenidos/home-view.php";

      }else{
        require_once"./vistas/contenidos/404-view.php";
      }
      
    }else{



   require_once $vistasR;
    } ?>

    <!-- our_latest_news_area_end  -->

    <!-- footer_start  -->
    <?php 
    
            include 'modulos/footer.php';
    ?>
    <!-- footer_end  -->


    <!-- JS here -->
  <?php 
            include 'modulos/script.php';
             include "modulos/logoutScript.php";
  ?>

</body>

</html>
<script>
    $.material.init();
</script>
<style type="text/css">
  .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('<?php echo SERVERURL;?>vistas/img/loading.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
var el = $('a.button'); // the element you want to hover over
var hi = $('div.hidden'); // the div containing the hidden buttons

el.hover(function(){
    //do this when the mouse hovers over the link, eg
    hi.show('slide',{direction:'right'},250);
}, function(){
    //do this when the mouse leaves the link, eg
    hi.hide('slide',{direction:'left'},250);
});
</script>
<style type="text/css">
  .fab-container {
    position: fixed;
    bottom: 50px;
    right: 50px;
    z-index: 999;
    cursor: pointer;
}

.fab-icon-holder {
    width: 50px;
    height: 50px;
    border-radius: 100%;
    background: #016fb9;

    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.fab-icon-holder:hover {
    opacity: 0.8;
}

.fab-icon-holder i {
    display: flex;
    align-items: center;
    justify-content: center;

    height: 100%;
    font-size: 25px;
    color: #ffffff;
}

.fab {
    width: 60px;
    height: 60px;
    background: #d23f31;
}

.fab-options {
    list-style-type: none;
    margin: 0;

    position: absolute;
    bottom: 70px;
    right: 0;

    opacity: 0;

    transition: all 0.3s ease;
    transform: scale(0);
    transform-origin: 85% bottom;
}

.fab:hover+.fab-options,
.fab-options:hover {
    opacity: 1;
    transform: scale(1);
}

.fab-options li {
    display: flex;
    justify-content: flex-end;
    padding: 5px;
}

.fab-label {
    padding: 2px 5px;
    align-self: center;
    user-select: none;
    white-space: nowrap;
    border-radius: 3px;
    font-size: 16px;
    background: rgba(0, 0, 0, 0.5);
    color: #ffffff;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.8);
    margin-right: 10px;
}
</style>
<div class="fab-container" style="right: 20px" >
    <div class="fab fab-icon-holder"style="background: url('<?php echo SERVERURL;?>vistas/img/mas.png');">
       <img width="60" src="<?php echo SERVERURL;?>vistas/img/mas.png" alt="">
    </div>
    <ul class="fab-options">
    <?php if(isset($_SESSION['tipo_usuario'])): ?>
    
        <li>
            <span class="fab-label">AÑADIR PROYECTO</span>
            <div class="fab-icon-holder">
                <i class="fas fa-comment-alt ">
                    
                    <a href="<?php echo SERVERURL;?>register/">  <img width="50" src="<?php echo SERVERURL;?>vistas/img/anadir.png" alt=""></a>
                </i>
            </div>
        </li>
    <?php else:?>
        <li>
            <span class="fab-label">FACEBOOK</span>
            <div class="fab-icon-holder">
                <i class="fas fa-file-alt">
                    <a href="">  <img width="50" src="<?php echo SERVERURL;?>vistas/img/facebook.png" alt=""></a>
                </i>
            </div>
        </li>
        <li>
            <span class="fab-label">WHATSAPP</span>
            <div class="fab-icon-holder">
                <i class="fas fa-video">
                    
                    <a href="https://api.whatsapp.com/send?phone=+51982539237">  <img width="50" src="<?php echo SERVERURL;?>vistas/img/whatsapp.png" alt=""></a>
                </i>
            </div>
        </li>
        <li>
            <span class="fab-label">GMAIL</span>
            <div class="fab-icon-holder">
                <i class="fas ">
                    
                    <a href="">  <img width="50" src="<?php echo SERVERURL;?>vistas/img/gmail.png" alt=""></a>
                </i>
            </div>
        </li>
        <li>
            <span class="fab-label">MESSENGER</span>
            <div class="fab-icon-holder">
                <i class="fas fa-comment-alt ">
                    
                    <a href="">  <img width="50" src="<?php echo SERVERURL;?>vistas/img/messenger.png" alt=""></a>
                </i>
            </div>
        </li>
    <?php endif;?>
    </ul>
</div>
    <!--CSS-->
