<main> 
    <div class="container-fluid"  style="color: white; height: 100vh;">
      
        <div class="container mt-5" style="background-color: #860038;">

           <div class="row p-5">
        	<div class="col-5">

        		<div id="meuCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
				  <div class="carousel-inner" >
				  	<?php foreach ($anuncio['fotos'] as $key => $an): ?>
				    <div class="carousel-item <?php echo ($key=='0')? 'active':'';?>">
				      <img src="<?php echo BASE_URL; ?>assets/images/anuncios/<?php echo $an['url']; ?>" class="d-block" style="height: 50vh;">
				    </div>
				<?php endforeach; ?>
				  <button class="carousel-control-prev" type="button" data-bs-target="#meuCarousel" data-bs-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Previous</span>
				 	 </button>
				 	 <button class="carousel-control-next" type="button" data-bs-target="#meuCarousel" data-bs-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="visually-hidden">Next</span>
				  	</button>
				   </div>
        		</div>
 		    </div>
        	<div class="col-7 text-center">
    			<h1 style="background-color: #041E42;"><?php echo $anuncio['titulo']; ?></h1>
    			<h5><small><?php echo $anuncio['nome_categoria']; ?></small></h5>
    			<p ><?php echo $anuncio['descricao']; ?></p>
    			<h3>R$ <?php echo $anuncio['valor']; ?></h3>  
    			<h4 class="text-ligth"><?php echo $anuncio['telefone']; ?></h4>      
    			<a href="" class="btn btn-warning">Mesagem para o vendedor(Em breve)</a> 
    			<h2><a href="" class="btn btn-outline-light">Comprar(em breve )</a></h2>
        	</div>
         
        </div>
	</div>
   
</main>