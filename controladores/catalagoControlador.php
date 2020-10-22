<?php 
if ($peticionAjax) {
	require_once "../modelos/catalagoModelo.php";
}else{
	require_once "./modelos/catalagoModelo.php";
}

class catalagoControlador extends catalagoModelo{

	public function agregar_catalago_controlador(){
		$nombre_proyecto=mainModel::limpiar_cadena($_POST['nombre-proyecto-reg']);
		$cliente=mainModel::limpiar_cadena($_POST['cliente-reg']);
		$comentario=mainModel::limpiar_cadena($_POST['comentario-reg']);
		$id_sector=mainModel::limpiar_cadena($_POST['id_sector']);

		$consulta1=mainModel::ejecutar_consulta_simple("SELECT id_catalago FROM catalago ");
							//numero para guardar el total de registros que hay en la bd,  que lo contamos en la consulta 4
		$numero=($consulta1->rowCount()+1);

							//generar codigo para cada cuenta
		$codigo=mainModel::generar_codigo_aleatorio("CA", 7 , $numero);



		if ($nombre_proyecto!="" && $cliente!="") {
			$dataPRO=[
				"id_catalago"=>$codigo,
				"nombre_proyecto"=>$nombre_proyecto,
				"comentario"=>$comentario,
				"id_sector"=>$id_sector,
				"cliente"=>$cliente
			];
			$guardar=catalagoModelo::agregar_catalago_modelo($dataPRO);
			if ($guardar->rowCount()>=1) {




				if (isset($_FILES["imagen-reg"]) ) {
						//GUARDAR SOLO IMAGEN

				$cantidad= count($_FILES["imagen-reg"]["tmp_name"]);

				echo $cantidad;


					if($_FILES["imagen-reg"]["error"]==0 ){

						$alerta=[
							"Alerta"=>"redireccionar",
							"Titulo"=>"Datos guardados",
							"Texto"=>"La imagen no fue guardado correctamente ",
							"Tipo"=>"success",
							"Contenido"=>"property",
							"Variable"=>""
						];
					} else {

						$permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
						$limite_kb = 10000;


						for ($i=0; $i<$cantidad; $i++){
	


						if(in_array($_FILES["imagen-reg"]["type"][$i], $permitidos) && $_FILES["imagen-reg"]["size"][$i] <= $limite_kb * 1024 ){
							$server=SERVERURL;
							
						$codigo=substr($codigo, 0, 10);
							$ruta_img ='../vistas/img/catalago/'.$codigo.'/';

							$nombreImagen=str_replace("-", "", $_FILES["imagen-reg"]["name"][$i]);
								$nombreImagen=str_replace(" ", "", $nombreImagen);
								$nombreImagen=str_replace("(", "", $nombreImagen);
								$nombreImagen=str_replace(")", "", $nombreImagen);	

							$archivo_img[$i] = $ruta_img.$nombreImagen;

							if(!file_exists($ruta_img)){

								mkdir($ruta_img,0777,true);
							}

							if(!file_exists($archivo_img[$i]) ){

								$resultado_img = move_uploaded_file($_FILES["imagen-reg"]["tmp_name"][$i], $archivo_img[$i]);

								if($resultado_img == true ){
									$alerta=[
										"Alerta"=>"recargar",
										"Titulo"=>"Datos guardados",
										"Texto"=>"El proyecto fue guardado correctamente ",
										"Tipo"=>"success"
									];
								} else {
									$alerta=[
										"Alerta"=>"simple",
										"Titulo"=>"Algo salió mal",
										"Texto"=>"No se pudo archivar el documento. ¡Ups!",
										"Tipo"=>"error"
									];
								}

							} else {
								$alerta=[
									"Alerta"=>"simple",
									"Titulo"=>"Algo salió mal",
									"Texto"=>"El archivo ya existe. ¡Ups!",
									"Tipo"=>"error"
								];
							}

						} else {

							$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Algo salió mal",
								"Texto"=>"El archivo no es compatible ó excede el limite de tamaño. ¡Ups!",
								"Tipo"=>"error"
							];

						}







	}

						

					}

						//FIN DE GUARDAR SOLO IMANE
				}



			}else{
				$alerta=["Alerta"=>"simple",
				"Titulo"=>"Algo salió mal",
				"Texto"=>"No se pudo registrar el proyecto. ¡Ups!",
				"Tipo"=>"error"
			];
		}

	}
	return mainModel::sweet_alert($alerta);
}


	public function actualizar_proyecto_controlador(){
		$nombre_proyecto=mainModel::limpiar_cadena($_POST['nombrePRO']);
		$cliente=mainModel::limpiar_cadena($_POST['clientePRO']);
		$comentario=mainModel::limpiar_cadena($_POST['comentarioPRO']);
		$id_sector=mainModel::limpiar_cadena($_POST['id_sectorPRO']);
		$id_catalago=mainModel::limpiar_cadena($_POST['upProyect']);
		$dataPRO=[
			"id_sector"=>$id_sector,
			"nombre_proyecto"=>$nombre_proyecto." ",
			"cliente"=>$cliente,
			"comentario"=>$comentario,
			"id_catalago"=>$id_catalago
		];
		$upProyect=catalagoModelo::actualizar_proyecto_modelo($dataPRO);


		if($upProyect->rowCount()>=1){



				if (isset($_FILES["imagen-reg"]) ) {
						//GUARDAR SOLO IMAGEN

				$cantidad= count($_FILES["imagen-reg"]["tmp_name"]);

				


					if($_FILES["imagen-reg"]["error"]==0 ){

						$alerta=[
							"Alerta"=>"redireccionar",
							"Titulo"=>"Datos guardados",
							"Texto"=>"La imagen no fue guardado correctamente ",
							"Tipo"=>"success",
							"Contenido"=>"property",
							"Variable"=>""
						];
					} else {

						$permitidos = array("image/jpg","image/jpeg","image/gif","image/png");
						$limite_kb = 10000;


						for ($i=0; $i<$cantidad; $i++){
	


						if(in_array($_FILES["imagen-reg"]["type"][$i], $permitidos) && $_FILES["imagen-reg"]["size"][$i] <= $limite_kb * 1024 ){
							$server=SERVERURL;
							
						$codigo=substr($id_catalago, 0, 10);
							$ruta_img ='../vistas/img/catalago/'.$codigo.'/';

							$nombreImagen=str_replace("-", "", $_FILES["imagen-reg"]["name"][$i]);
								$nombreImagen=str_replace(" ", "", $nombreImagen);
								$nombreImagen=str_replace("(", "", $nombreImagen);
								$nombreImagen=str_replace(")", "", $nombreImagen);	

							$archivo_img[$i] = $ruta_img.$nombreImagen;

							if(!file_exists($ruta_img)){

								mkdir($ruta_img,0777,true);
							}

							if(!file_exists($archivo_img[$i]) ){

								$resultado_img = move_uploaded_file($_FILES["imagen-reg"]["tmp_name"][$i], $archivo_img[$i]);

								if($resultado_img == true ){
									$alerta=[
				"Alerta"=>"redireccionar",
				"Titulo"=>"Datos Actualizados",
				"Texto"=>"El documento fue actualizado correctamente ",
				"Tipo"=>"success",
				"Contenido"=>"listado",
				"Variable"=>""
			];
								} else {
									$alerta=[
										"Alerta"=>"simple",
										"Titulo"=>"Algo salió mal",
										"Texto"=>"No se pudo archivar el documento. ¡Ups!",
										"Tipo"=>"error"
									];
								}

							} else {
								$alerta=[
									"Alerta"=>"simple",
									"Titulo"=>"Algo salió mal",
									"Texto"=>"El archivo ya existe. ¡Ups!",
									"Tipo"=>"error"
								];
							}

						} else {

										$alerta=[
				"Alerta"=>"redireccionar",
				"Titulo"=>"Datos Actualizados",
				"Texto"=>"El documento fue actualizado correctamente ",
				"Tipo"=>"success",
				"Contenido"=>"listado",
				"Variable"=>""
			];

						}







	}

						

					}

						//FIN DE GUARDAR SOLO IMANE
				}

			
			
		}else{
			$alerta=["Alerta"=>"simple",
			"Titulo"=>"Algo salió mal",
			"Texto"=>"Por favor actualiza algun campo",
			"Tipo"=>"error"
		];
	}
	return mainModel::sweet_alert($alerta);

}



public function eliminar_proyecto_controlador(){

	$idCatalago=mainModel::decryption($_POST['id_catalago']);
	$path=mainModel::decryption($_POST['path']);
	$idCatalago=mainModel::limpiar_cadena($idCatalago);
	$carpeta=mainModel::limpiar_cadena($path);
	$eliminar=catalagoModelo::eliminar_catalago_modelo($idCatalago);
	if ($eliminar->rowCount()>=1) {
		

		foreach(glob($carpeta . "/*") as $archivos_carpeta){             
			if (is_dir($archivos_carpeta)){
			  rmDir_rf($archivos_carpeta);
			} else {
			unlink($archivos_carpeta);
			}
		  }
		  rmdir($carpeta);


		$alerta=[
										"Alerta"=>"recargar",
										"Titulo"=>"Proyecto Eliminado",
										"Texto"=>"El proyecto fue eliminado correctamente $carpeta",
										"Tipo"=>"success"
									];
	}else{
		$alerta=["Alerta"=>"simple",
				"Titulo"=>"Algo salió mal",
				"Texto"=>"No se pudo registrar el proyecto. ¡Ups!",
				"Tipo"=>"error"
			];
	}
	return mainModel::sweet_alert($alerta);

}
public function eliminar_imagen_controlador(){

	$path=mainModel::decryption($_POST['parche']);
	$archivo=mainModel::decryption($_POST['archivo']);
	$path=mainModel::limpiar_cadena($path);
	$archivo=mainModel::limpiar_cadena($archivo);

	
	$file= "../vistas/img/catalago/".$path."/".$archivo;
	

				chmod($file,0777);
				if(!unlink($file)){
					$alerta=["Alerta"=>"simple",
				"Titulo"=>"Algo salió mal",
				"Texto"=>"No se pudo eliminar la imagen. ¡Ups!",
				"Tipo"=>"error"
			];
				}else{
					$alerta=[
										"Alerta"=>"recargar",
										"Titulo"=>"Imagen Eliminada",
										"Texto"=>"La imagen fue eliminada correctamente ",
										"Tipo"=>"success"
									];
				}
			
	

	
	
	return mainModel::sweet_alert($alerta);

}






public function paginador_proyectos_controlador($pagina,$registros,$busqueda){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$busqueda=mainModel::limpiar_cadena($busqueda);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;

	if (isset($busqueda) && $busqueda!="") {
		$consulta="SELECT SQL_CALC_FOUND_ROWS inv.estado_investigacion, inv.id_investigacion, doc.id_documento,au.id_autor, SUBSTRING(doc.titulo, 1, 60) AS titulo,td.nombre_tipo_doc,li.nombre_linea,au.nombre,au.apellido,au.especialidad FROM investigacion inv INNER JOIN documento doc on inv.id_documento=doc.id_documento INNER JOIN autor au ON inv.id_autor=au.id_autor INNER JOIN tipo_doc td ON doc.id_tipo_doc=td.id_tipo_doc INNER JOIN lineasinvestigacion li ON doc.id_lineas=li.id_lineas  WHERE inv.estado_investigacion='Activo' and (doc.titulo LIKE '%$busqueda%' or nombre_tipo_doc LIKE '%$busqueda%' or nombre LIKE '%$busqueda%' or apellido LIKE '%$busqueda%' or especialidad LIKE '%$busqueda%' or carrera LIKE '%$busqueda%') ORDER BY inv.fecha DESC LIMIT $inicio,$registros";
		$paginaurl="listado";
	}else{
		$consulta="SELECT SQL_CALC_FOUND_ROWS id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo' ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="listado";
	}

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);

	$tabla.='

	<thead class="thead-dark">
	<tr>
	<th scope="col">#</th>
	<th scope="col">NOMBRE DE PROYECTO</th>
	<th scope="col">CLIENTE</th>
	<th scope="col">COMENTARIO</th>
	<th scope="col">FECHA</th>
	<th scope="col">IMAGEN</th>
	<th scope="col">ACTUALIZAR</th>
	<th scope="col">ELIMINAR</th>
	</tr>
	</thead>
	<tbody>
	';

	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {
			$tabla.='
			<tbody>
			<tr >
			<th scope="row">'.$contador.'</th>
			<td>'.$rows['nombre_proyecto'].'</td>
			<td>'.$rows['cliente'].'</td>
			<td>'.$rows['comentario'].'</td>
			<td>'.$rows['fecha_proyecto'].'</td>
			<td>
			';
			$path ="././vistas/img/catalago/".$rows['id_catalago'];
			$pathDelete =".././vistas/img/catalago/".$rows['id_catalago'];
			if(file_exists($path)){
				$directorio = opendir($path);
				while ($archivo = readdir($directorio))
				{
					$data=mainModel::encryption($path."/".$archivo);
					if (!is_dir($archivo)){
						$tabla.='
						<a href="'.SERVERURL.'vistas/img/catalago/'.$rows['id_catalago'].'/'.$archivo.'" class="img-pop-up">
						<img src="'.SERVERURL.'vistas/img/catalago/'.$rows['id_catalago'].'/'.$archivo.'" width="40">
						</a>';


					}
				}
			}



			$tabla.='
			</td>
			<td>
			<a  class="btn btn-warning" href="'.SERVERURL.'proyectoup/'.mainModel::encryption($rows['id_catalago']).'" >Actualizar</a>
			</td>
			<td>
			<form action="'.SERVERURL.'/ajax/catalagoAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
			<input type="hidden" value="'.mainModel::encryption($rows['id_catalago']).'" name="id_catalago">
			<input type="hidden" value="'.mainModel::encryption($pathDelete).'" name="path">
			<input type="submit" class="btn btn-danger" value="Eliminar">
			<div class="RespuestaAjax"></div>
			</form>
			</td>
			</tr>

			</tbody>';



			$contador++;
		}
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			Haga click para recargar el listado
			</a>
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}

	$tabla.='</tbody></table></div>';



	if ($total>=1 && $pagina<=$Npaginas) {
		$tabla.='


    <section class="blog_area ">
		<nav class="blog-pagination justify-content-center d-flex">
		<ul class="pagination">';
		if ($pagina==1) {
			$tabla.='<li class="page-item disabled">
			<a href="#" class="page-link" aria-label="Previous">
			<i class="ti-angle-left"></i>
			</a>
			</li>';
		}
		else{
			$tabla.='<li class="page-item">
			<a href="'.SERVERURL.$paginaurl.'/'.($pagina-1).'" class="page-link" aria-label="Previous">
			<i class="ti-angle-left"></i>
			</a>
			</li>';
		}


		for ($i=1; $i < $Npaginas+1; $i++) { 
			if ($pagina==$i) {
				$tabla.='</li>
				<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($i).'"><span>'.$i.'</span></a></li>';
			}else{
				$tabla.='</li>
				<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($i).'"><span>'.$i.'<span></a></li>';

			}
		}


		if ($pagina==$Npaginas) {
			$tabla.='<li class="page-item disabled">
			<a href="#" class="page-link" aria-label="Next">
			<i class="ti-angle-right"></i>
			</a>
			</li>';
		}else{
			$tabla.='
			<li class="page-item ">
			<a href="'.SERVERURL.$paginaurl.'/'.($pagina+1).'" class="page-link" aria-label="Next">
			<i class="ti-angle-right"></i>
			</a>
			</li>';
		}

		$tabla.='</ul>
		</nav>
		</div>
		</section>';

		


		return $tabla;
	}

}


public function paginador_catalago_controlador($pagina,$registros,$numero,$sector){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$sector=mainModel::limpiar_cadena($sector);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;

	if (isset($sector) && $sector!="") {
		$consulta="SELECT SQL_CALC_FOUND_ROWS id_sector,id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo' and id_sector='$sector' ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="property/".$sector."";
	}else{
		$consulta="SELECT SQL_CALC_FOUND_ROWS id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo' ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="property";
	}

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);



	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {
		
	$tabla.='

<div class="col-lg-4 col-md-6">

                           ';
			$path ="././vistas/img/catalago/".$rows['id_catalago'];
			$i = 0;
			if(file_exists($path)){
				$directorio = opendir($path);

    			$ffs = scandir($path);
				foreach ($ffs as $archivo)
				{
					$data=mainModel::encryption($path."-".$rows['id_catalago']);
					$idcat=$rows['id_catalago'];
					$data=str_replace("=", "", $data);
					if (!is_dir($archivo) && $i++ == 0){
						$tabla.='
                        
                        <div class="single_appertment mb-30">
                        <div class="thumb">
                            <img width="200" height="280" src="'.SERVERURL.'vistas/img/catalago/'.$rows['id_catalago'].'/'.$archivo.'" alt="">
                        </div>
						';


					}
				}
			}



			$tabla.='
                        <div class="appertment_info">
                        	<a href="'.SERVERURL.'detalle/'.$rows['id_catalago'].'">
                            <span>Nombre de Proyecto: '.$rows['nombre_proyecto'].'</span>
                            </a>
                            
                        	<a href="'.SERVERURL.'detalle/'.$rows['id_catalago'].'">
                                <h5>Nombre de Cliente: '.$rows['cliente'].'</h5>
                            </a>
                            <ul>
                                <li>Fecha: '.$rows['fecha_proyecto'].'</li>
                            </ul>
                        </div>
                    </div>
                </div>';
            }
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			Haga click para recargar el listado
			</a>
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}







	$tabla.='</tbody></table></div>';



	if ($total>=1 && $pagina<=$Npaginas) {
		$tabla.='


    <section class="blog_area ">
		<nav class="blog-pagination justify-content-center d-flex">
		<ul class="pagination">';
		if ($pagina==1) {
			$tabla.='<li class="page-item disabled">
			<a href="#" class="page-link" aria-label="Previous">
			<i class="ti-angle-left"></i>
			</a>
			</li>';
		}
		else{
			$tabla.='<li class="page-item">
			<a href="'.SERVERURL.$paginaurl.'/'.($pagina-1).'" class="page-link" aria-label="Previous">
			<i class="ti-angle-left"></i>
			</a>
			</li>';
		}


		for ($i=1; $i < $Npaginas+1; $i++) { 
			if ($pagina==$i) {
				$tabla.='</li>
				<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($i).'"><span>'.$i.'</span></a></li>';
			}else{
				$tabla.='</li>
				<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($i).'"><span>'.$i.'<span></a></li>';

			}
		}


		if ($pagina==$Npaginas) {
			$tabla.='<li class="page-item disabled">
			<a href="#" class="page-link" aria-label="Next">
			<i class="ti-angle-right"></i>
			</a>
			</li>';
		}else{
			$tabla.='
			<li class="page-item ">
			<a href="'.SERVERURL.$paginaurl.'/'.($pagina+1).'" class="page-link" aria-label="Next">
			<i class="ti-angle-right"></i>
			</a>
			</li>';
		}

		$tabla.='</ul>
		</nav>
		</div>
		</section>';

		


		return $tabla;
	}
}



public function paginador_detalle_controlador($pagina,$registros,$idCatalago){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$idCatalago=mainModel::limpiar_cadena($idCatalago);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;


		$consulta="SELECT SQL_CALC_FOUND_ROWS id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo' and id_catalago='$idCatalago' ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="detalle";
	

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);



	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {
		
	

			$path ="././vistas/img/catalago/".$idCatalago;
			if(file_exists($path)){
				$directorio = opendir($path);
				while ($archivo = readdir($directorio))
				{
					$data=mainModel::encryption($path."/".$archivo);
					if (!is_dir($archivo)){
						$tabla.='

                       

        		     <div class="col-md-4">
                  <div class="feature-img">
                  <a href="'.SERVERURL.'vistas/img/catalago/'.$idCatalago.'/'.$archivo.'" class="img-pop-up">
                     <div class="single-gallery-image" style="background: url('.SERVERURL.'vistas/img/catalago/'.$idCatalago.'/'.$archivo.');"></div>
                  </a>
                  </div>
               </div>
						';

					}
				}
			}


			$tabla.='     
                  <div style="padding-left: 20px" class="blog_details">
                     <h2>'.$rows['nombre_proyecto'].'
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i>CLIENTE:'.$rows['cliente'].'</a></li>
                        <li><a href="#"><i class="fa fa-comments"></i>FECHA: '.$rows['fecha_proyecto'].'</a></li>
                     </ul>
                     <p class="excert">
                       '.$rows['comentario'].'
                     </p>
                    
                  </div>';
            }
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			Haga click para recargar el listado
			</a>
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}






		return $tabla;
	}


	public function clientes_imagenes(){

		$html="";

            $path ="././vistas/img/clientes";
                 if(file_exists($path)){
                $directorio = opendir($path);
                while ($archivo = readdir($directorio))
                {
                    $data=mainModel::encryption($path."/".$archivo);
                    if (!is_dir($archivo)){
                       
                       $html.='

                            <div class="row justify-content-center">
                        <div class="single_appertment">
                        <div class="single_list">
                            <div class="thumb single_list">
                               <img style="display: block; max-width:230px; max-height:170px; width: auto; height: auto;" src="'. SERVERURL.'vistas/img/clientes/'.$archivo.'" alt="">
                            </div>
                        </div>
                        </div>
                        </div>';
                    }
                }
            }
            return $html;
	}



public function proyectos_general_controlador($pagina,$registros){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;


		$consulta="SELECT SQL_CALC_FOUND_ROWS id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo'  ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="detalle";
	

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);



	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {
		
			$tabla.='<div class="single_appertment">';

			$path ="././vistas/img/catalago/".$rows['id_catalago'];
			$i = 0;
			if(file_exists($path)){
				$directorio = opendir($path);
				while ($archivo = readdir($directorio))
				{
					$data=mainModel::encryption($path."/".$archivo);
					if (!is_dir($archivo) && $i++==0){
						$tabla.='

                <div class="thumb">
                    <img style=" object-fit: cover; width: 100%; height: 500px; " src="'.SERVERURL.'vistas/img/catalago/'.$rows['id_catalago'].'/'.$archivo.'" alt="">
                </div>';

					}
				}
			}


			$tabla.=' <div class="appertment_info">
					  <a href="'.SERVERURL.'detalle/'.$rows['id_catalago'].'">
                    <span>Proyecto: '.$rows['nombre_proyecto'].'</span>
                    </a>
                    <a href="'.SERVERURL.'detalle/'.$rows['id_catalago'].'">
                        <h5>Cliente: '.$rows['cliente'].'</h5>
                    </a>
                    <ul>
                        <li>Fecha: '.$rows['fecha_proyecto'].'</li>
                        
                    </ul>
                </div>
            </div>';
            }
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			</a>
			Haga click para recargar el listado
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}






		return $tabla;
	}
	public function datos_proyecto_controlador($id_catalago){
		$id_catalago=mainModel::decryption($id_catalago);
		return catalagoModelo::datos_catalago_modelo($id_catalago);

	}

	public function imagenes_up_controlador($pagina,$registros,$idCatalago){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$idCatalago=mainModel::limpiar_cadena($idCatalago);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;


		$consulta="SELECT SQL_CALC_FOUND_ROWS id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo' and id_catalago='$idCatalago' ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="detalle";
	

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);



	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {
		
	

			$path ="././vistas/img/catalago/".$idCatalago;
			if(file_exists($path)){
				$directorio = opendir($path);
				while ($archivo = readdir($directorio))
				{
					$data=mainModel::encryption($path."/".$archivo);
					if (!is_dir($archivo)){
						$tabla.='

                       

        		     <div class="col-md-4 img-thumbnail" >
                  <div class="feature-img ">
                  <a style="position: relative;" href="'.SERVERURL.'vistas/img/catalago/'.$idCatalago.'/'.$archivo.'" class="img-pop-up">
                     <div class="single-gallery-image" style="background: url('.SERVERURL.'vistas/img/catalago/'.$idCatalago.'/'.$archivo.');"></div>
                  </a>
                 

			<form action="'.SERVERURL.'/ajax/catalagoAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
			<input type=submit style="border: 0; position: absolute; right: 5px; top: 5px;" value="x">
			<input type="hidden" value="'.mainModel::encryption($idCatalago).'" name="parche">
			<input type="hidden" value="'.mainModel::encryption($archivo).'" name="archivo">
			<div class="RespuestaAjax"></div>
			</form>

                  </div>
               </div>
						';

					}
				}
			}


            }
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			Haga click para recargar el listado
			</a>
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}






		return $tabla;
	}
public function sectores_categoria($pagina,$registros){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;


		$consulta="SELECT nombre_sector from sector ORDER BY nombre_sector DESC LIMIT $inicio,$registros";
		$paginaurl="property/";
	

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);



	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {

			$tabla.='
                        <li>
                           <a href="#" class="d-flex">
                              <p>'.$rows['nombre_sector'].'</p>';
            $fila=$rows['nombre_sector'];
            $consulta=mainModel::ejecutar_consulta_simple("SELECT * FROM catalago ca INNER JOIN sector se ON ca.id_sector=se.id_sector  where nombre_sector='$fila'");
            
              		$numero=$consulta->rowCount();
             
              $tabla.='<p>...('.$numero.')</p>
                           </a>
                        </li>';
					

			}


            
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			Haga click para recargar el listado
			</a>
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}






		return $tabla;
	}

public function minicatalago_categoria($pagina,$registros){

	$pagina=mainModel::limpiar_cadena($pagina);
	$registros=mainModel::limpiar_cadena($registros);
	$tabla="";

	$pagina=(isset($pagina) && $pagina>0) ? (int) $pagina :1;
	$inicio=($pagina>0) ? (($pagina*$registros)-$registros) : 0;



		$consulta="SELECT SQL_CALC_FOUND_ROWS id_catalago, nombre_proyecto,cliente,fecha_proyecto,estado,comentario from catalago WHERE estado='Activo'  ORDER BY fecha_proyecto DESC LIMIT $inicio,$registros";
		$paginaurl="property/";
	

	$conexion=mainModel::conectar();

	$datos=$conexion->query($consulta);
	$datos=$datos->fetchAll();

	$total=$conexion->query("SELECT FOUND_ROWS()");
	$total=(int) $total->fetchColumn();

	$Npaginas=ceil($total/$registros);



	if ($total>=1 && $pagina<=$Npaginas) {
		$contador=$inicio+1;
		foreach ($datos as $rows) {

			
			

			$path ="././vistas/img/catalago/".$rows['id_catalago'];
			$i = 0;
			if(file_exists($path)){
				$directorio = opendir($path);
				while ($archivo = readdir($directorio))
				{
					$data=mainModel::encryption($path."/".$archivo);
					if (!is_dir($archivo) && $i++==0){
						$tabla.=' <div class="media post_item">
                        <img width="60" height="60" src="'.SERVERURL.'vistas/img/catalago/'.$rows['id_catalago'].'/'.$archivo.'" alt="post">';

					}
				}
			}


			$tabla.='



			 
                        <div class="media-body">
                           <a href="single-blog.html">
                              <h3>'.$rows['nombre_proyecto'].'</h3>
                           </a>
                           <p>'.$rows['fecha_proyecto'].'</p>
                        </div>
                     </div>';

            }
	}else{

		if ($total>=1) {
			$tabla.='
			<tr>
			<td colspan="5">
			<a href="'.SERVERURL.''.$paginaurl.'/" class="btn btn-sm btn-info btn-raised"> 
			Haga click para recargar el listado
			</a>
			</td>
			</tr>
			';
		}else{
			$tabla.='
			<tr>
			<td colspan="5">No hay registros</td>
			</tr>
			';
		}


	}






		return $tabla;
	}

}

