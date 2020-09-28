
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/catalagoControlador.php';
$instancearCatalago = new catalagoControlador();

if(isset($_POST['nombre-proyecto-reg'])&&isset($_POST['cliente-reg'])&&isset($_POST['id_sector'])) {


	echo $instancearCatalago->agregar_catalago_controlador();


}elseif(isset($_POST['nombre'])) {


	echo $instancearCatalago->agregar_catalago_controlador();


}elseif (isset($_POST['id_catalago'])&& isset($_POST['path'])) {

	echo $instancearCatalago->eliminar_proyecto_controlador();
	
}elseif (isset($_POST['parche'])&& isset($_POST['archivo'])) {

	echo $instancearCatalago->eliminar_imagen_controlador();
	
}elseif (isset($_POST['upProyect']) && isset($_POST['nombrePRO'])&& isset($_POST['clientePRO'])) {

	echo $instancearCatalago->actualizar_proyecto_controlador();
	
}
else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
