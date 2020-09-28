<?php 
	class vistasModelo{
		protected function obtener_vistas_modelo($vistas){
			$listaBlanca=["home","about","facilities","property","elements","blog","singleblog","contact","register","listado","detalle","proyectoup"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenidos/".$vistas."-view.php")){
					$contenido="./vistas/contenidos/".$vistas."-view.php";
				}else{
					$contenido="home";
				}
			
			}else{
				$contenido="home";
			}
			return $contenido;
		}
	}