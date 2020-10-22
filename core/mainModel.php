<?php
if (isset($peticionAjax)) {
	require_once "../core/configAPP.php";
}else{
	require_once "./core/configAPP.php";
}



class mainModel{
	public function conectar(){
		
		$enlace = new PDO(SGBD,USER,PASS);
		$enlace->exec("set names utf8");
		return $enlace;
	}

	public function ejecutar_consulta_simple($consulta){
		$respuesta=self::conectar()->prepare($consulta);
		$respuesta->execute();
		return $respuesta;
	}

	
	public static function encryption($string){
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
		return $output;
	}

	public static function decryption($string){
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}

	protected function generar_codigo_aleatorio($letra,$longitud,$num){
		for ($i=1; $i <= $longitud; $i++) { 
			$numero = rand(0,9);
			$letra.=$numero;
		}
		return $letra.$num;
	}

	protected function limpiar_cadena($cadena){

		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		return $cadena;
	}

	protected function sweet_alert($datos){
			//valor 'alerta' para saber q tipo de alerta mostrar
		if ($datos['Alerta']=="simple") {
			$alerta="
			<script>
			swal(
			'".$datos['Titulo']."' ,
			'".$datos['Texto']."' ,
			'".$datos['Tipo']."' 
			);
			</script>
			";
				// para recargar la pagina
		}elseif($datos['Alerta']=="recargar"){
			$alerta="
			<script>
			swal({
				title: '".$datos['Titulo']."',
				text: '".$datos['Texto']."',
				type:'".$datos['Tipo']."',
				confirmButtonText:'Aceptar'
				}).then(function(){
					location.reload();
					});
					</script>
					";
				}
			//CONDICION PARA LIMPIAR
				elseif ($datos['Alerta']=="limpiar") {
					$alerta="
					<script>
					swal({
						title: '".$datos['Titulo']."',
						text: '".$datos['Texto']."',
						type:'".$datos['Tipo']."',
						confirmButtonText: 'Aceptar'
						}).then(function(){
							$('.FormularioAjax')[0].reset();
							});
							</script>
							";
						}
			//CONDICION PARA redireccionar
						elseif ($datos['Alerta']=="redireccionar") {

							$url=SERVERURL;
							$contenido=$datos['Contenido'];
							$variable=$datos['Variable'];
							$redireccionar=$url.$contenido.'/'.$variable;
							$alerta="
							<script>
							swal({
								title: '".$datos['Titulo']."',
								text: '".$datos['Texto']."',
								type:'".$datos['Tipo']."',
								confirmButtonText: 'Aceptar'
								}).then(function(){
									location.href='$redireccionar';
									});
									</script>
									";
								}
								return $alerta;
							}
						}