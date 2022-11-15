<?php 	
	class cadastroController extends controller{


		public function index(){

			$this->loadTemplate("cadastro");

			$usuario = new Usuarios();
			if(isset($_POST['submit']) && !empty($_POST['submit'])){

				$nome = filter_var($_POST['nome'],FILTER_SANITIZE_SPECIAL_CHARS);
				$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
				$senha = filter_var($_POST['senha'],FILTER_DEFAULT);
				$senha = password_hash($senha, PASSWORD_DEFAULT);
				$telefone = filter_var($_POST['telefone'],FILTER_SANITIZE_NUMBER_INT);

				if(empty($nome) || empty($email) || empty($senha)){
					return false;
				}else{

					// inserir no banco
					if($usuario->cadastrar($nome,$email,$senha,$telefone)){
						header("location:http://localhost/PHP/classificados_mvc/home");
						die();
					}else{
						return false;
					}



				}
			}

		}


	}

 ?>