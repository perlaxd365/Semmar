<?php 
if ($peticionAjax) {
	require_once '../modelos/loginModelo.php';
}else{
	require_once './modelos/loginModelo.php';
}

class loginControlador extends loginModelo
{
	
	public function iniciar_sesion_controlador(){

		$usuario=mainModel::limpiar_cadena($_POST["usuario"]);
		$clave=mainModel::limpiar_cadena($_POST["clave"]);
		$clave=mainModel::encryption($clave);

		$datosLogin=[

			"Usuario"=>$usuario,
			"Clave"=>$clave
		];

		$datosCuenta=loginModelo::iniciar_sesion_modelo($datosLogin);
		if ($datosCuenta->rowCount()==1) {
			$row=$datosCuenta->fetch();
			$fechaActual=date("Y-m-d");
			$yearActual=date("Y");
			$horaActual=date("h:i:s a");

			$consulta1=mainModel::ejecutar_consulta_simple("SELECT id from bitacora");

			$numero=($consulta1->rowCount())+1;

			$codigoB=mainModel::generar_codigo_aleatorio("CB",7,$numero);

			$datosBitacora=[
				"Codigo"=>$codigoB,
				"Fecha"=>$fechaActual,
				"HoraInicio"=>$horaActual,
				"HoraFinal"=>"Sin Registro",
				"Tipo"=>$row['cuentatipo'],
				"Year"=>$yearActual,
				"Cuenta"=>$row['cuentacodigo']
				];	

			$insertarBitacora=mainModel::guardar_bitacora($datosBitacora);		
			if ($insertarBitacora->rowCount()>=1) {

				if ($row['cuentatipo']=="Administrador") {
								# code...
					$query1=mainModel::ejecutar_consulta_simple("SELECT * FROM admin WHERE CuentaCodigo='".$row['cuentacodigo']."'");
				}else{
					$query1=mainModel::ejecutar_consulta_simple("SELECT * FROM Estudiante WHERE CuentaCodigo='".$row['cuentacodigo']."'");
				}

				session_start(['name'=>'SBP']);
				$cuentacodigoVer=$row['cuentacodigo'];
				
				$UserData=$query1->fetch();

				if ($row['cuentatipo']=="Administrador") {
									// para q aparezca en ves del nombre de usuaruio de la tabla cuenta, si no el nombre de la tablaAdmin, datos personales
					$_SESSION['nombre_sbp']=$UserData['adminnombre'];
					$_SESSION['apellido_sbp']=$UserData['adminapellido'];
					$_SESSION['nombre_completo_sbp']=$_SESSION['nombre_sbp']." ".$_SESSION['apellido_sbp'];
				}else{
					$_SESSION['nombre_sbp']=$UserData['EstudianteNombre'];
					$_SESSION['apellido_sbp']=$UserData['EstudianteApellido'];
					$_SESSION['nombre_completo_sbp']=$_SESSION['nombre_sbp']." ".$_SESSION['apellido_sbp'];
				}

				$_SESSION['usuario_sbp']=$row['cuentausuario'];
				$_SESSION['tipo_sbp']=$row['cuentatipo'];
				$_SESSION['privilegio_sbp']=$row['cuentaprivilegio'];
				$_SESSION['foto_sbp']=$row['cuentafoto'];
				$_SESSION['token_sbp']=md5(uniqid(mt_rand(),true));
				$_SESSION['codigo_cuenta_sbp']=$row['cuentacodigo'];
				$_SESSION['codigo_bitacora_sbp']=$codigoB;

				if ($_SESSION['tipo_sbp']=='Administrador') {
					$url=SERVERURL."home/";
				}else{

					$url=SERVERURL."catalog/";
				}
				return $urlLocation='<script>window.location="'.$url.'"</script>';
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Algo salió mal",
					"Texto"=>"No se ha podido iniciar sesion por problemas técnicos. ¡Ups!",
					"Tipo"=>"error"
				];
				return mainModel::sweet_alert($alerta);

			}

		}else{

			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Algo salió mal",
				"Texto"=>"El usuario y contraseña no son correctos / Cuenta inactiva. ¡Ups!",
				"Tipo"=>"error"
			];
			return mainModel::sweet_alert($alerta);		
		}

	}

	public function cerrar_sesion_controlador(){

		session_start(['name'=>'SBP']);
		$token=mainModel::decryption($_GET['Token']);
		$hora=date("h:i:s a");
		$datos=[
			"Usuario"=>$_SESSION['usuario_sbp'],
			"Token_S"=>$_SESSION['token_sbp'],
			"Token"=>$token,
			"Codigo"=>$_SESSION['codigo_bitacora_sbp'],
			"Hora"=>$hora
		];
		return loginModelo::cerrar_sesion_modelo($datos);

	}

	public function forzar_cierre_sesion_controlador(){
		
		session_start(['name'=>'SBP']);
		session_destroy(); 
		return header("location:".SERVERURL."login/");
	}

		
	
	public function iniciar_sesion_invitado_controlador(){
			$fechaActual=date("Y-m-d");
			$yearActual=date("Y");
			$horaActual=date("h:i:s a");

			$consulta1=mainModel::ejecutar_consulta_simple("SELECT id from bitacora");

			$numero=($consulta1->rowCount())+1;

			$codigoB=mainModel::generar_codigo_aleatorio("CB",7,$numero);

			$datosBitacora=[
				"Codigo"=>$codigoB,
				"Fecha"=>$fechaActual,
				"HoraInicio"=>$horaActual,
				"HoraFinal"=>"Sin Registro",
				"Tipo"=>"Invitado",
				"Year"=>$yearActual,
				"Cuenta"=>""
				];	

			$insertarBitacora=mainModel::guardar_bitacora($datosBitacora);		
			if ($insertarBitacora->rowCount()>=1) {

				session_start(['name'=>'SBP']);

				$_SESSION['nombre_sbp']="Invitado";
				$_SESSION['apellido_sbp']="Pedagogico";
				$_SESSION['nombre_completo_sbp']=$_SESSION['nombre_sbp']." ".$_SESSION['apellido_sbp'];
				

				$_SESSION['usuario_sbp']="Invitado";
				$_SESSION['tipo_sbp']="Estudiante";
				$_SESSION['privilegio_sbp']=5;
				$_SESSION['foto_sbp']="StudetMaleAvatar.png";
				$_SESSION['token_sbp']=md5(uniqid(mt_rand(),true));
				$_SESSION['codigo_cuenta_sbp']="";
				$_SESSION['codigo_bitacora_sbp']=$codigoB;
				$url=SERVERURL."catalog/";
			
				return $urlLocation='<script>window.location="'.$url.'"</script>';
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Algo salió mal",
					"Texto"=>"No se ha podido iniciar sesion por problemas técnicos. ¡Ups!",
					"Tipo"=>"error"
				];
				return mainModel::sweet_alert($alerta);

			}

		
	}
}