<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class catalagoModelo extends mainModel{

		protected function agregar_catalago_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO catalago(id_catalago,id_sector,nombre_proyecto,cliente,fecha_proyecto,estado,comentario) VALUES (:id_catalago,:id_sector,:nombre_proyecto,:cliente,now(),'Activo',:comentario)");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->bindParam(":id_catalago",$datos['id_catalago']);
			$sql->bindParam(":nombre_proyecto",$datos['nombre_proyecto']);
			$sql->bindParam(":cliente",$datos['cliente']);
			$sql->bindParam(":comentario",$datos['comentario']);
			$sql->bindParam(":id_sector",$datos['id_sector']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_catalago_modelo($id_catalago){
			$query=mainModel::conectar()->prepare("DELETE FROM catalago WHERE id_catalago = :id_catalago");
			$query->bindParam(":id_catalago",$id_catalago);
			$query->execute();
			return $query;
		}

		protected function datos_catalago_modelo($id_catalago){
				$query=mainModel::conectar()->prepare("SELECT * FROM catalago WHERE id_catalago=:id_catalago");
				$query->bindParam(":id_catalago",$id_catalago);
				$query->execute();
				return $query;
		}


		protected function actualizar_proyecto_modelo($datos){
			$query=mainModel::conectar()->prepare("UPDATE catalago SET id_sector=:id_sector,nombre_proyecto=:nombre_proyecto,cliente=:cliente,comentario=:comentario WHERE id_catalago=:id_catalago");
			$query->bindParam("id_sector",$datos['id_sector']);
			$query->bindParam("nombre_proyecto",$datos['nombre_proyecto']);
			$query->bindParam("cliente",$datos['cliente']);
			$query->bindParam("comentario",$datos['comentario']);
			$query->bindParam("id_catalago",$datos['id_catalago']);
			$query->execute();
			return $query;
		}
	}