

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="bradcam_text">
						<h3>Contacto</h3>
						<p> <a href="<?php echo SERVERURL;?>home/">Inicio</a> / contacto</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ bradcam_area  -->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container">
            
            <h2 class="contact-title">Ubícanos!</h2>
                <div class="d-sm-block mb-5 pb-4">
                    <div id="map" style="height: 480px; position: relative;"> </div>
                    <script>
                        function iniciarMap(){
                
    var coord = {lat:-9.042699 ,lng: -78.605660};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.SATELLITE, 
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map,
      title:'SEMMAR'
    });
}
                    </script>
               <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>

    
    
                </div>
    
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Ponerse en Contacto</h2>
                    </div>
                    <div class="col-lg-8">
                        <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mensaje'" placeholder="Mensaje"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre'" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];}?> class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter'" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese Asunto'" placeholder="Ingrese Asunto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Direccion:Zona Industrial Los Pinos H-5</h3>
                                <p>Panamericana Norte, Chimbote.</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>Cel : +51 925 924 181</h3>
                                <h3>Cel : +51 982 539 237</h3>
                                <p>Lunes a Viernes 8am a 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>ventas@semmarmanufacturing.com</h3>
                                <p>
Envíanos tu consulta en cualquier momento!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
   