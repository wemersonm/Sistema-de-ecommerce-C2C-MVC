<div class="container">
		<h1>Criar Anúncio</h1>

		 <form method="POST" enctype="multipart/form-data">
		 	
		 	<!-- <div class="form-group">
		 		<label for="img">Imagem</label>
		 		<input type="file" name="img" class="form-control">
		 	</div> -->
		 	<div class="form-group">
		 		<label for="Título">Título</label>
		 		<input type="text" name="titulo" class="form-control">
		 	</div>
		 	<div class="form-group">
		 		<label for="descricao">Descrição</label>
		 		<textarea class="form-control" name="descricao" rows="15"></textarea>
		 	</div>
		 	<div class="form-group">
		 		<label for="valor">Valor</label>
		 		<input type="text" name="valor" class="form-control">
		 	</div>
		 	<div class="form-group">
		 		<label for="categoria"></label>
		 		<select name="categoria" class="form-control">
		 			<option value="">Selecione uma categoria</option>
		 			<?php 
		 				foreach ($listaCategorias as $categoria): ?>
		 					<option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>

		 			<?php endforeach; ?>		
		 		</select>
		 	</div><br>
		 	<div class="form-check">
			  <input class="form-check-input" type="radio" name="conservacao" value="0">
			  <label class="form-check-label" for="conservacao">
			    Usado
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input" type="radio" name="conservacao" value="1">
			  <label class="form-check-label" for="conservacao">
			    Novo
			  </label>
			</div>
			<br>
			<input type="submit" name="submit" class="btn btn-dark" value="Publicar">
		 </form><br>
	</div>