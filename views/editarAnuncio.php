<div class="container">
		<h1>Editar Anúncio</h1>

		 <form method="POST" enctype="multipart/form-data">
		 	
		 	<div class="form-group">
		 		<label for="Título">Título</label>
		 		<input type="text" name="titulo" class="form-control" value="<?php echo trim($anuncioEditar['titulo']); ?>">
		 	</div>
		 	<div class="form-group">
		 		<label for="descricao">Descrição</label>
		 		<textarea class="form-control" name="descricao" rows="15"><?php echo trim($anuncioEditar['descricao']); ?> </textarea>
		 	</div>
		 	<div class="form-group">
		 		<label for="valor">Valor</label>
		 		<input type="text" name="valor" class="form-control" value="<?php echo trim($anuncioEditar['valor']); ?>">
		 	</div>
		 	<div class="form-group">
		 		<label for="categoria"></label>
		 		<select name="categoria" class="form-control">
		 			<option value="">Selecione uma categoria</option>
		 			<?php 
		 				foreach ($listaCategorias as $categoria): ?>
		 					<option value="<?php echo $categoria['id']; ?>" <?php echo ($anuncioEditar['id_categoria'] == $categoria['id'] )?"selected":''?>><?php echo $categoria['nome']; ?></option>

		 			<?php endforeach; ?>		
		 		</select>
		 	</div><br>
		 	<div class="form-check">
			  <input class="form-check-input" type="radio" name="conservacao" value="0" <?php echo ($anuncioEditar['estado'] == 0)?"checked":'' ?>>
			  <label class="form-check-label" for="conservacao">
			    Usado
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="conservacao" value="1" <?php echo ($anuncioEditar['estado'] == 1)?"checked":'' ?>>
			  <label class="form-check-label" for="conservacao">
			    Novo
			  </label>
			</div>
			<div class="form-group">
		 		<label for="img">Incluir imagens</label>
		 		<input type="file" name="img[]" class="form-control" multiple>
		 	</div><br>
		 	<div class="image-container">
	 			<?php foreach($anuncioEditar['fotos'] as $foto): ?>
					<div class="foto-item">
						<img class="img-thumbnail" src="<?php echo BASE_URL; ?>assets/images/anuncios/<?php echo $foto['url']; ?>" alt="fotoAnuncio">
						<a  href="<?php echo BASE_URL; ?>anuncios/deletarImagem/<?php echo $foto['id']; ?>" class="btn btn-danger">Remover imagem</a>
					</div>			
	 			<?php endforeach; ?>
	 		</div>
			<br>
			<div class="d-grid col-12">
				<input type="submit" name="submit" class="btn btn-dark btn-lg" value="Editar">
			</div>
			
		 </form><br>
</div>