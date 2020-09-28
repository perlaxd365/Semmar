
<div class="whole-wrap">
  <div class="container box_1170">
    <div class="section-top-border">
      <!-- Content here -->


      <div class="section_title mb-55">
        <div class="single_feature text-center">
          <h3>Listado <br>
            <span>DE PROYECTOS</span></h3>
            <div class="devider">
              <span></span>
              <span></span>
            </div>
          </div>
        </div>

        <?php require_once './controladores/catalagoControlador.php';
        $doc = new catalagoControlador();
        ?>
<div class="table-responsive-lg">
        <table class="table">
         <?php 
         $pagina=explode("/",$_GET['views']);

         echo $doc->paginador_proyectos_controlador($pagina[1],10,"");
         ?>
       </table>
     </div>
     </div></div></div>