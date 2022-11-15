<?php 
	class loginController extends controller{

		public function index()
		{	

			$this->loadTemplate('login');
			$usuario = new Usuarios();
			if(isset($_POST['submit']) && !empty($_POST['submit'])){
				$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
				$senha = filter_var($_POST['senha'],FILTER_DEFAULT);

				if(empty($email) || empty($senha)){
					return false;
				}else{
					// fazer login
					if($usuario->logar($email,$senha)){
						// redirecionar para index
						header("location:".BASE_URL);
						die();

					}else{
						return false;
					}
				}
			}

			
		}

		public function sair(){

			session_destroy();

			header("location:".BASE_URL);
			die;

		}





	}
	

 ?>
