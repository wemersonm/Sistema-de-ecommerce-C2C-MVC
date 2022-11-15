<?php 

	class homeController extends controller{
		/*
			aqui ficara as actions == abrir, esquecisenha, salvarcadastro
			sempre cria o index em cada controller 
		*/	
	   



		public function index(){
			// aqui fica as  informações que vai ter na tela, dados
			
		if(!isset($_SESSION['logado']) || empty($_SESSION['logado'])){
        header("location:http://localhost/PHP/classificados_mvc/login");
        die();
      }

	    $categoria = new Categorias();
	    $anuncio = new Anuncios();
	    $dados = array();
	    $p=1;
	    $por_pagina = 3;
	    if (isset($_GET['p']) && !empty($_GET['p'])) {
	      $p=$_GET['p'];
	    }
	    $filtros = [
	        'categoria' => '',
	        'preco' => '',
	        'estado' => '',
	        'pesquisa' => ''

	    ];

	    if(isset($_GET['submit'])){
	     $filtros=$_GET['filtros'];

	    }
	    
	    $listaCategorias = $categoria->getCategorias();
	    $listaAnuncios = $anuncio->getUltimosAnuncios($p,$por_pagina,$filtros);
	    $total_anuncios = $anuncio->totalDeAnuncios();
	    $total_paginas = ceil($total_anuncios / $por_pagina);

	    $arrayIncons = ["eletronicos.png","imoveis.png","automoveis.png","moda.png","para-casa.png"];



	   	$dados['listaCategorias'] = $listaCategorias;
	   	$dados['listaAnuncios'] = $listaAnuncios;
	   	$dados['total_paginas'] = $total_paginas;
	   	$dados['total_anuncios'] = $total_anuncios;
	   	$dados['p'] = $p;
	   	$dados['por_pagina'] = $por_pagina;
	   	$dados['arrayIncons'] = $arrayIncons;
	   	$dados['filtros'] = $filtros;



		// chama a view que vai renderizar na index, que e a view home
		$this->loadTemplate("home",$dados);
				
			}

			
















	}
 ?>