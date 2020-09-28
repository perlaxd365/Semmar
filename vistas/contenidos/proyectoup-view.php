

<?php
$datos=explode("/", $_GET['views']);

    require_once "./controladores/catalagoControlador.php";
  $classDoc = new catalagoControlador();
  $filesL=$classDoc->datos_proyecto_controlador($datos[1]);

  	 if ($filesL->rowCount()>=1) {

      $campos=$filesL->fetch();

      ?>


	<div class="whole-wrap">
		<div class="container box_1170">
	<div class="section-top-border">
				<div class="row">
					<div class="col-lg-8 col-md-8">
						<div class="section_title mb-55">
                    <div class="single_feature text-center">
                            <h3>Actualización <br>
                                <span>DE PROYECTO</span></h3>
                            <div class="devider">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        </div>

      						<form action="<?php echo SERVERURL;?>ajax/catalagoAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $campos['id_catalago'];?>"  name="upProyect">

							<h3 class="mb-30">Datos de Proyecto</h3>
							
							<div class="mt-10">
								<input type="text" name="nombrePRO" placeholder="Nombre de Proyecto"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre de Proyecto'" required
									class="single-input" value="<?php echo $campos['nombre_proyecto'];?> ">
							</div>
							<div class="mt-10">
								<input type="text" name="clientePRO" placeholder="Nombre de Cliente"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre de Cliente'" required
									class="single-input" value="<?php echo $campos['cliente'];?> ">
							</div>
							<div class="input-group-icon mt-10">
								<div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
								<div class="form-select" id="default-select">
									<select class="single-input" name="id_sectorPRO">
										<?php
										$result = mainModel::ejecutar_consulta_simple("SELECT * FROM sector");

										while ($row= $result->fetch()) {

											?>


											<option <?php if($campos['id_sector']==$row['id_sector']){echo "selected";} ?> value="<?php echo $row["id_sector"]?>"><?php echo $row["nombre_sector"]?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>




							

							<div class="mt-10">
                                  <textarea class="single-input" name="comentarioPRO" id="comentario-reg" cols="10" rows="4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escribir Comentario'" placeholder="Escribir Comentario"><?php echo $campos['comentario'];?></textarea>
                             </div>

                               <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
            

           
         <br>

            <h3>Añadir imagenes</h3>

         <br>

								
								<input type="file" name="imagen-reg[]" class="single-input" multiple accept="image/*" id="gallery-photo-add">
								<br>
								<br>
                            <div class="about_exp_inner text-center">
								<div id="gallery" class="gallery"></div>
							</div>
 
								
							</div>

							<div class="mt-10">
                            <div class="about_exp_inner text-center">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


     
								<input type="submit" class="genric-btn danger-border e-large" value="Actualizar" name="">
							</div>
							</div>	
							</div>

							<br>
							<br>

            <div class="RespuestaAjax" id="RespuestaAjax">
            </div>
							</div>
						</form>

              <br>
               <h3>Imagenes subidas</h3>
            <div class="row gallery-item">
            


       <?php require_once './controladores/catalagoControlador.php';
        $doc = new catalagoControlador();
        
         $pagina=explode("/",$_GET['views']);

         
        $id=mainModel::decryption($pagina[1]);

         echo $doc->imagenes_up_controlador(1,10,$id);

         
         ?>
            
</div>
					</div>
				</div>
			</div>
		</div>
	</div>




<script type="text/javascript">

$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img style="margin: 1rem auto;width:100%;max-width:360px;xcolumn-count: 3;" height="200px" width="200px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                  
                }
            

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {

        $("#gallery").children("img").remove(); 
        imagesPreview(this, 'div.gallery');
    });
});

</script>
<script type="text/javascript">
	$(".gallery").click(function(){ 
     $(this).parent(".pip").remove(); 
     $('#files').val(""); 
     });` 
</script>



      <?php
  	}else{
  		echo "<h2>No se pudo recuperar los datos</h2>";
  	}


  ?>


