<?php 

	class Categorias extends model{


		   public function getCategorias(){
			
			$array = array();
			$stmt=$this->db->query("SELECT * FROM categorias");
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return $array = $stmt->fetchAll();
			}
			return $array;
		}
	}

 ?>