


<div id="iniciar-sesion align-items-center">
<section class="ftco-section contact-section ftco-degree-bg">
  <div class="container " >
    <div class="row d-flex mb-5 contact-info">
      <div class="col-md-12 mb-4">
        <h2 class="h4">Iniciar Sesión como administrador</h2>
      </div>
    </div>
    <div class="row block-9">
      <div class="col-md-6 pr-md-5">
        <form action="" method="POST" autocomplete="off"  class="logInForm">
          <div class="form-group">
            <input type="text" class="form-control" name="Usuario" placeholder="Usuario">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="Clave" placeholder="Contraseña">
          </div>

          <div class="form-group">
            <input type="submit" value="Iniciar Sesión" class="btn btn-primary ">
          </div>
        </form>



      </div>

      <?php 
      
      
      ?>

      <div class="col-md-6" id="map"></div>
    </div>
  </div>
</section>

</body>
</html>
</div>

  <?php require_once './controladores/loginControlador.php';
    $login = new loginControlador();
    if (isset($_POST['Usuario']) && isset($_POST['Clave'])) {
     
      echo $login->iniciar_sesion_controlador();
    }   
  
?>

<script type="text/javascript">
    $(document).ready(function() {
   $('html,body').animate({
            scrollTop: $("#iniciar-sesion").offset().top
        }, 400);
    $(".ir-reg").click(function () {

        $('html,body').animate({
            scrollTop: $("#iniciar-sesion").offset().top
        }, 400);
    });

});
  </script>

