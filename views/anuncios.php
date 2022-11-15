
	<div class="container">
		<h1>Meus anúncios</h1><br>
	<?php if(!empty($meusAnuncios)): ?>
		<a href="<?php echo BASE_URL; ?>/anuncios/adicionar" class="btn btn-dark">Fazer anuncio agora mesmo</a>
		<br><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Foto</th>
					<th>Titulo</th>
					<th>Preço</th>
					<th>Categoria</th>
					<th>Estado de conservação</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
		<?php 
				foreach($meusAnuncios as $anuncio): ?>
					<tr>
						<td> <?php if(!empty($anuncio['url'])): ?> 
							<img src="<?php echo BASE_URL; ?>assets/images/anuncios/<?php echo $anuncio['url'];?>" alt="imagemAnuncio" height="50"> 
						<?php else: ?>
							Sem IMG
							<?php endif; ?>
						</td>
						<td> <?php echo $anuncio['titulo']; ?> </td>
						<td> <?php echo number_format($anuncio['valor'],2); ?> </td>
						<td> <?php echo $anuncio['nome_categoria'] ?> </td>
						<td> <?php echo ($anuncio == 0)?"Usado":"Novo" ?> </td>
						<td>	
							<a class="btn btn-warning" href="<?php echo BASE_URL; ?>anuncios/editar/<?php echo $anuncio['id'];?>"> Editar</a>
							<a class="btn btn-danger" href="<?php echo BASE_URL ?>anuncios/deletar/<?php echo $anuncio['id'];?>"> Deletar</a>
						</td>
					</tr>
		<?php   endforeach; ?>
			 

			</tbody>
		</table>
	<?php else: ?>
		<div >
			<p class="alert alert-warning">Você não possui anúncios.</p>
			<a href="<?php echo BASE_URL; ?>anuncios/adicionar" class="btn btn-dark">Anuncie agora mesmo</a>
			
		</div>
	<?php endif ?>
	</div>

