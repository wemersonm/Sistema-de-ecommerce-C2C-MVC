<main>

    <div class="container-fluid">
      
        <div class="container" style="height: 100vh;">
        <form method="GET" style="background-color: #041E42;" class="p-4 mt-3 borda text-light">
         <div class="row">
          <div class="col-8 d-flex">
             <input class="form-control me-2" type="text" placeholder="Search" name="filtros[pesquisa]">
             <input  class="btn btn-warning" type="submit" name="submit" value="Procurar">
          </div>
          
         </div>
          <div class="row">
            <div class="col-4">
               <div class="form-group">
                <label for="estado">Condição</label>
                    <select name="filtros[estado]" class="form-select" id="estado">
                      <option value=""></option>
                      <option value="0" <?php echo ($filtros['estado']=='0')?'selected':''; ?> >Usado</option>
                      <option value="1" <?php echo ($filtros['estado']=='1')?'selected':''; ?> >Novo</option>
                    </select>
               </div>
            </div>

            <div class="col-4"> 
               <div class="form-group">
                <label for="preco">Preço</label>
                    <select name="filtros[preco]" class="form-select" id="estado">
                      <option value=""></option>
                      <option value="0-200" <?php echo ($filtros['preco']=='0-200')?'selected="selected"':''; ?>>Até R$200</option>
                      <option value="201-400" <?php echo ($filtros['preco']=='201-400')?'selected="selected"':''; ?>>R$201 - R$400</option>
                      <option value="401-600" <?php echo ($filtros['preco']=='401-600')?'selected="selected"':''; ?>>R$401 - R$600</option>
                    </select>
               </div>
            </div>

             <div class="col-4">
               <div class="form-group">
                <label for="cat">Categoria</label>
                    <select name="filtros[categoria]" class="form-select" id="cat">
                      <option value=""></option>
                    <?php foreach ($listaCategorias as $key => $categoria): ?>
                       <option value="<?php echo $categoria['id']; ?>" <?php echo ($categoria['id'] == $filtros['categoria'])?'selected':''; ?>><?php echo $categoria['nome']; ?></option>
                    <?php endforeach ?>
                    </select>
               </div>
            </div>

          </div>
      </form> 
      <!-- anuncios por categoria -->
          <div class="row m-3 borda" style="background-color: #041E42;">
            <ul class="list-group list-group-horizontal d-flex justify-content-around m-3 ">
            <?php foreach ($listaCategorias as $key => $categoria): ?>        
                <li class="list-group-item m-3 ">            
                  <a href="<?php echo BASE_URL; ?>anuncios/categoria/<?php echo $categoria['id']; ?>" style="text-decoration: none;">
                  <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $arrayIncons[$key]; ?>" alt="imagem_categoria" height="50" >
                   <p class="card-text"><small class="text-muted"><?php echo $categoria['nome']; ?></small></p>
                 </a>
                
                </li>       
            <?php endforeach; ?>
            </ul>
          </div>
             <!-- anuncios -->
          <div class="row">
            <p class="display-5 text-center" style="color:  #041E42;">Ultimos anúncios</p>
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
  <br>
      <ul class="pagination">
       <?php for ($i=1; $i <= $total_paginas ; $i++): ?>
          <li class="page-item <?php echo ($p==$i)?"active":''; ?>"><a class="page-link" href="<?php echo BASE_URL; ?>?<?php 
          $w =$_GET;
          $w['p'] = $i; 
          echo http_build_query($w);
          ?>"><?php echo $i; ?></a></li>
       <?php endfor; ?>
      </ul>
     


        </div>

        </div>

      
    
   

   
</main>