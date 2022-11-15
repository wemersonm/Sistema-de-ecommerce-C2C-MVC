<div class="container mt-5">
<?php if(empty($listaAnuncios)): ?>
	<p class="alert alert-warning">Não existe anuncios para essa categoria.</p>
	<?php die(); ?>
<?php endif;
	
 ?>

	<div class="row">
	    <p class="display-5 text-center pb-3" style="color:  #041E42;"><?php echo $listaAnuncios[0]['nome_categoria']; ?></p>
	    <?php foreach($listaAnuncios as $anuncio): ?>
	    
	    <div class="col-4 p-3 borda" style="background-color:  #041E42;">
	        <a href="<?php echo BASE_URL; ?>produto/abrir/<?php echo $anuncio['id']; ?>" class="an" style="text-decoration: none;">
	        <div class="card">
	        <img src="<?php echo BASE_URL; ?>assets/images/anuncios/<?php echo $anuncio['url']; ?>" class="card-img-top" alt="FotoAnuncio" style=" width: 150px;height: 150px; align-self: center;">
	        <div class="card-body">
	            <p class="card-text"><?php echo $anuncio['titulo']; ?></p>
	            <h4 class="card-title">R$ <?php echo $anuncio['valor'] ?></h4>
	            <p class="card-text"><small class="text-muted">Localização</small></p>
	          </div>
	          
	        </div>  
	        </a>
	      </div>

	   <?php endforeach; ?>

	</div>
</div>