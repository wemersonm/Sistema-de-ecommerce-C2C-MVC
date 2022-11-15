<?php 

	class Anuncios extends model{


		public function getMeusAnuncios(){

			$array = array();
			$id = $_SESSION['logado'];
			
			$stmt = $this->db->prepare("SELECT *,(select anuncio_imagem.url from anuncio_imagem where anuncio_imagem.id_anuncio = anuncios.id limit 1) as url,(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as nome_categoria FROM anuncios WHERE id_usuario =?");
			$stmt->execute(array($id));

			if($stmt->rowCount() > 0){
				$array = $stmt->fetchAll();
			}

			return $array;
		}

		 public function addAnuncio($id_usuario,$categoria,$titulo,$descricao,$est_conservacao,$valor){

	   		
	   		$id = $_SESSION['logado'];
	   		$stmt=$this->db->prepare("INSERT INTO anuncios(id_usuario,id_categoria,titulo,descricao,valor,estado) VALUES(?,?,?,?,?,?)");
	   		if($stmt->execute(array($id,$categoria,$titulo,$descricao,$valor,$est_conservacao))){
	   			return true;
	   		}
	   		return false;
	   }



		public function getUltimosAnuncios($page,$perPage,$filtros){

			global $pdo;
			$offset = ($page-1) * $perPage;
			$array = array();

			$filtrostring = array("1=1");

			if(isset($filtros['categoria']) && !empty($filtros['categoria'])){
				$filtrostring[]='anuncios.id_categoria = :id_categoria';
			};
			if(isset($filtros['preco']) && !empty($filtros['preco'])){
				$filtrostring[]='anuncios.valor BETWEEN :preco1 AND :preco2';
			}
			if(isset($filtros['pesquisa']) && !empty($filtros['pesquisa'])){
				$filtrostring[]="anuncios.titulo LIKE '%".$filtros['pesquisa']."%' OR anuncios.descricao LIKE '%".$filtros['pesquisa']."%' ";
			}
			if(is_numeric($filtros['estado']) && ($filtros['estado'] == 0 || $filtros['estado'] == 1)){
				$filtrostring[]='anuncios.estado = :estado';
			}




			$stmt = $this->db->prepare("SELECT *,(select url from anuncio_imagem where anuncio_imagem.id_anuncio = anuncios.id limit 1) as url FROM anuncios WHERE ".implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $offset,$perPage");

			if(isset($filtros['categoria']) && !empty($filtros['categoria'])){
				$stmt->bindValue(":id_categoria",$filtros['categoria']);
			};
			if(isset($filtros['preco']) && !empty($filtros['preco'])){
				$preco = explode("-",$filtros['preco']);
				
				$stmt->bindValue(":preco1",$preco[0]);
				$stmt->bindValue(":preco2",$preco[1]);

			}
			// if(isset($filtros['pesquisa']) && !empty($filtros['pesquisa'])){
			
			// }
			if(is_numeric($filtros['estado']) && ($filtros['estado'] == 0 || $filtros['estado'] == 1)){
				$stmt->bindValue(":estado",$filtros['estado']);
			}

            $stmt->execute();
			if($stmt->rowCount() > 0 ){
				$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}



			return $array;
		}



		public function totalDeAnuncios(){


			$stmt=$this->db->query("SELECT COUNT(*) as c FROM anuncios");
			$data = $stmt->fetch();
			return $data['c'];
		}




		public function getUmAnuncio($id_anuncio)
		{	
			
			$array = array();
			$stmt = $this->db->prepare("SELECT *,
			(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as nome_categoria,(select usuarios.telefone from usuarios where anuncios.id_usuario = usuarios.id ) as telefone
			 FROM anuncios WHERE id=?");
			$stmt->execute(array($id_anuncio));
			if($stmt->rowCount() == 1){
				$array = $stmt->fetch();
				$array['fotos'] = array();

				$stmt = $this->db->prepare("SELECT id,url FROM anuncio_imagem WHERE id_anuncio=?");
				$stmt->execute(array($id_anuncio));
				if($stmt->rowCount() > 0){
					$array['fotos'] = $stmt->fetchAll();
				}
			}
			return $array;
		}

		public function pertenceUsuario($id_anuncio,$id_usuario)
		{
			
			$array = array();
			$stmt = $this->db->prepare("SELECT * FROM anuncios WHERE id=? AND id_usuario=?");
			$stmt->execute(array($id_anuncio,$id_usuario));
			if($stmt->rowCount() == 1){
				return true;
			}
			return false;
			}

		

		 public function editarAnuncio($id_editarAnuncio,$id_usuario,$categoria,$titulo,$descricao,$est_conservacao,$valor,$imagens){

			
			$stmt = $this->db->prepare("UPDATE anuncios SET titulo=?,descricao=?,valor=?,estado=?,id_categoria=? WHERE id=?");
			$stmt->execute(array($titulo,$descricao,$valor,$est_conservacao,$categoria,$id_editarAnuncio));	
				
			
				// processo imagem
			if(!empty($imagens['tmp_name'][0])){
				for ($i=0; $i < count($imagens['tmp_name']); $i++) { 
					$tipo = $imagens['type'][$i];
					if(in_array($tipo, array('image/jpeg','image/png'))){
						$name = 'imagem-'.rand(1000000,99999990).'.jpg';

						move_uploaded_file($imagens['tmp_name'][$i],'assets/images/anuncios/'.$name);

						list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/'.$name);

						$width = 500;
						$height = 500;
					   // Calculando a proporção
					   $ratio_orig = $width_orig/$height_orig;

					   if ($width/$height > $ratio_orig) {
					      $width = $height*$ratio_orig;
					   } else {
					      $height = $width/$ratio_orig;
					   }

					   // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
					   $image_p = imagecreatetruecolor($width, $height);
					   if($tipo == 'image/jpeg'){
					   		 $image = imagecreatefromjpeg('assets/images/anuncios/'.$name);
					   }else if($tipo == 'image/png'){
					   		$image = imagecreatefrompng('assets/images/anuncios/'.$name);
					   }
					  
					   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					   // Gerando a imagem de saída para ver no browser, qualidade 75%:
					   

					   // Ou, se preferir, Salvando a imagem em arquivo:
					   imagejpeg($image_p, 'assets/images/anuncios/'.$name, 100);


					   $stmt = $this->db->prepare("INSERT INTO anuncio_imagem SET id_anuncio=?,url=?");
					   $stmt->execute(array($id_editarAnuncio,$name));
					

					}else{ // else do tipo de img != png,jpeg
						
					}

				}//fim for

		}else{ // else do se não enviar imgs
			
		}
		return true;


}


	public function deletarImagem($id_imagem){

		$id_anuncio = 0;

		$stmt=$this->db->prepare("SELECT id_anuncio FROM anuncio_imagem WHERE id=?");
		$stmt->execute(array($id_imagem));
		if($stmt->rowCount() > 0){
			$img = $stmt->fetch();
			$id_anuncio = $img['id_anuncio'];
		}
		$stmt= $this->db->prepare("DELETE FROM anuncio_imagem WHERE id=?");
		$stmt->execute(array($id_imagem));
		return $id_anuncio;
	}

	public function detelarAnuncio($id_anuncio){

			
			$stmt = $this->db->prepare("DELETE FROM anuncios WHERE id=?");
			if($stmt->execute(array($id_anuncio))){
				return true;
			}
			return false;
		}


	public function anunciosPorCategoria($id_categoria){

		$array = array();
		$stmt = $this->db->prepare("SELECT *,(select anuncio_imagem.url from anuncio_imagem where anuncio_imagem.id_anuncio = anuncios.id limit 1) as url,(select categorias.nome from categorias where categorias.id = anuncios.id_categoria) as nome_categoria FROM anuncios WHERE id_categoria =?");
		$stmt->execute(array($id_categoria));
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}else{
			return false;
		}
		return $array;

	}

	}

 ?>