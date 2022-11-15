<?php 
	
	class anunciosController extends controller{


	public function index(){

		if(!isset($_SESSION['logado']) || empty($_SESSION['logado'])){
	  	header("location:".BASE_URL);
	  	die();
	  }	
	  
	  $anuncios = new Anuncios();
	  $meusAnuncios = $anuncios->getMeusAnuncios();
	  $dados = array();

	  $dados['meusAnuncios'] = $meusAnuncios;


	  $this->loadTemplate("anuncios",$dados);

	}


	public function editar($id){

	  $categoria = new Categorias();
	  $anuncio = new Anuncios();
	  $listaCategorias = $categoria->getCategorias();	
	  $id_usuario = $_SESSION['logado'];
	  // PROCESSO DE VALIDAR O GET
	  if(isset($id) && !empty($id)){
	  	$id_editarAnuncio = $id;

	  	if($anuncio->getUmAnuncio($id_editarAnuncio)){
	  		if($anuncio->pertenceUsuario($id_editarAnuncio,$id_usuario)){
	  			$anuncioEditar = $anuncio->getUmAnuncio($id_editarAnuncio);
	  			$dados['anuncioEditar'] = $anuncioEditar;
	  			$dados['listaCategorias'] = $listaCategorias;
	  			$this->loadTemplate("editarAnuncio",$dados);


			if(isset($_POST['submit']) && !empty($_POST['submit'])){
			
			$titulo = addslashes($_POST['titulo']);
			$descricao =  filter_var($_POST['descricao'],FILTER_DEFAULT);

			$categoria = addslashes($_POST['categoria']);
			if(isset($_POST['conservacao'])){
				$est_conservacao = addslashes($_POST['conservacao']);
			}else{
				$est_conservacao = -1;
			}
			$valor = addslashes( $_POST['valor']);
			$id_usuario = $_SESSION['logado'];

			if(isset($_FILES['img']) && !empty($_FILES['img'])){
				$imagens = $_FILES['img'];
				
			}else{
				$imagens = array();
			}

			
			if($titulo && $descricao && $categoria && $valor && ($est_conservacao == 0 || $est_conservacao == 1)){

				if($anuncio->editarAnuncio($id_editarAnuncio,$id_usuario,$categoria,$titulo,$descricao,$est_conservacao,$valor,$imagens)){
					echo '<div class="container">
							<div class="alert alert-success">
								Anuncio alterado com sucesso.
						 	</div>
						  </div>';
						
				// header("location:meus-anuncios.php");
				}else{
					echo '<div class="container">
							<div class="alert alert-danger">
								Falha ao editar o anúncio.
						 	</div>
						  </div>';
				}

			}else{
					echo '<div class="container">
							<div class="alert alert-warning">
								Preencha todos os campos.
						 	</div>
						  </div>';
			}
		}

				}else{
					echo '<div class="container">
							<div class="alert alert-warning">
								Pagina não encontrada1.
			 				</div>
					 	 </div>';
						 die;	
				}
	  	}else{
	  		echo '<div class="container">
				<div class="alert alert-warning">
					Pagina não encontrada2.
			 	</div>
			 </div>';
			 die;	
	  	}
	  }else{
	  	echo '<div class="container">
				<div class="alert alert-warning">
					Pagina não encontrada3.
			 	</div>
			 </div>';
			 die;				  
	  }

	}



	public function deletarImagem($id){
	
	$anuncio = new Anuncios();


	 if(isset($id) && !empty($id)){
	 	$id=$id;
	 	// id_anuncio vai recer o id do anuncio onde a imagem foi apagada
	 	$id_anuncio = $anuncio->deletarImagem($id);
	 	if(isset($id_anuncio) && !empty($id_anuncio)){
	 		header("location:".BASE_URL."anuncios/".$id_anuncio);
	 		die;
	 	}else{
	 		header("location:".BASE_URL."anuncios");
	 		die;
	 	}

	 }
	}

	public function deletar($id){
		
		if(!isset($_SESSION['logado']) || empty($_SESSION['logado'])){
			header("location:".BASE_URL);
			die;
		}
		$anuncio = new Anuncios();
		$id_usuario = $_SESSION['logado'];
	  // PROCESSO DE VALIDAR O GET
	  if(isset($id) && !empty($id))	{
		  	$id_anuncio = $id;
		  	$id_usuario = $_SESSION['logado'];

		  	if($anuncio->getUmAnuncio($id_anuncio)){
		  		if($anuncio->pertenceUsuario($id_anuncio,$id_usuario)){
		  			if($anuncio->detelarAnuncio($id_anuncio)){
		  				header("location:".BASE_URL."anuncios");
						}else{
							echo '<div class="container">
									<div class="alert alert-warning">
										Falha ao deletar.
			 						</div>
					 			 </div>';
						 die;	

						}
		  			}else{
					echo '<div class="container">
							<div class="alert alert-warning">
								Pagina não encontrada.
			 				</div>
					 	 </div>';
						 die;	
				}
	  	}else{
	  		echo '<div class="container">
				<div class="alert alert-warning">
					Pagina não encontrada.
			 	</div>
			 </div>';
			 die;	
	  	}
	  }else{
	  	echo '<div class="container">
				<div class="alert alert-warning">
					Pagina não encontrada.
			 	</div>
			 </div>';
			 die;				  
	  }


	}

	public function adicionar(){

	  if(!isset($_SESSION['logado']) || empty($_SESSION['logado'])){
	  	header("location:".BASE_URL);
	  	die;
	  }

	  $categoria = new Categorias();
	  $anuncio = new Anuncios();
	  $listaCategorias = $categoria->getCategorias();	
	  $dados['listaCategorias'] = $listaCategorias;

	  $this->loadTemplate("adicionar",$dados);

	  if(isset($_POST['submit']) && !empty($_POST['submit'])){

			$titulo = addslashes($_POST['titulo']);
			$descricao = filter_var($_POST['descricao'],FILTER_DEFAULT);
			$categoria = addslashes( $_POST['categoria']);
			if(isset($_POST['conservacao'])){
				$est_conservacao = addslashes($_POST['conservacao']);
			}else{
				$est_conservacao = -1;
			}
			$valor = addslashes( $_POST['valor']);
			$id_usuario = $_SESSION['logado'];

			
			if($titulo && $descricao && $categoria && $valor && ($est_conservacao == 0 || $est_conservacao == 1)){

				if($anuncio->addAnuncio($id_usuario,$categoria,$titulo,$descricao,$est_conservacao,$valor)){
					echo '<div class="container">
							<div class="alert alert-success">
								Anuncio cadastrado.
						 	</div>
						  </div>';
						  
						  // header("location:meus-anuncios.php");
				}else{
					echo '<div class="container">
							<div class="alert alert-danger">
								Falha ao criar o anúncio.
						 	</div>
						  </div>';
				}

			}else{
					echo '<div class="container">
							<div class="alert alert-warning">
								Preencha todos os campos.
						 	</div>
						  </div>';
			}
		}



	}



	public function categoria($id_categoria){
		

		$a = new Anuncios();
		$dados = array();
		$anunciosCategoria = $a->anunciosPorCategoria($id_categoria);
		$dados['listaAnuncios'] = $anunciosCategoria;
		$this->loadTemplate("anunciosCategoria",$dados);

		
	}

	}
 ?>

