<?php 
	
	class produtoController extends controller{
		// controller e um ajudador para chamar as views
		
		public function index(){

			
		}

		

		public function abrir($id){ //ao colocar parametro fica obrigadorio colocar na url

					
					$a = new Anuncios();

					$anuncios = $a->getUmAnuncio($id);
					
					$dados['anuncio'] = $anuncios;
					$this->loadTemplate("produto",$dados);

				}




		}

		



	
 ?>