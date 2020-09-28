

	<div class="whole-wrap">
		<div class="container box_1170">
	<div class="section-top-border">
				<div class="row">
					<div class="col-lg-8 col-md-8">
						<div class="section_title mb-55">
                    <div class="single_feature text-center">
                            <h3>Registro <br>
                                <span>DE PROYECTO</span></h3>
                            <div class="devider">
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        </div>
      						<form action="<?php echo SERVERURL;?>ajax/catalagoAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">

							<h3 class="mb-30">Datos de Proyecto</h3>
							
							<div class="mt-10">
								<input type="text" name="nombre-proyecto-reg" placeholder="Nombre de Proyecto"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre de Proyecto'" required
									class="single-input">
							</div>
							<div class="mt-10">
								<input type="text" name="cliente-reg" placeholder="Nombre de Cliente"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre de Cliente'" required
									class="single-input">
							</div>
							<div class="input-group-icon mt-10">
								<div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
								<div class="form-select" id="default-select">
									<select class="single-input" name="id_sector">
										<?php
										$result = mainModel::ejecutar_consulta_simple("SELECT * FROM sector");

										while ($row= $result->fetch()) {

											?>


											<option value="<?php echo $row["id_sector"]?>"><?php echo $row["nombre_sector"]?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>




							

							<div class="mt-10">
                                  <textarea class="single-input" name="comentario-reg" id="comentario-reg" cols="10" rows="4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escribir Comentario'" placeholder="Escribir Comentario"></textarea>
                             </div>
                             <div class="mt-10">

								
								<input type="file" name="imagen-reg[]" class="single-input" multiple accept="image/*" id="gallery-photo-add">
								<br>
								<br>
                            <div class="about_exp_inner text-center">
								<div id="gallery" class="gallery"></div>
							</div>
 
								<br>
								<br>
							</div>

							<div class="mt-10">
                            <div class="about_exp_inner text-center">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


     
								<input type="submit" class="genric-btn danger-border e-large" value="Registrar" name="">
							</div>
							</div>	
							</div>

							<br>
							<br>

            <div class="RespuestaAjax" id="RespuestaAjax">
            </div>
							</div>
						</form>
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
