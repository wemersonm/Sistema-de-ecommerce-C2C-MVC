<?php 

	class Usuarios extends model{

		public function getUsuario($id){

			
			$stmt= $this->db->prepare("SELECT * FROM usuarios WHERE id=:id");
			$stmt->bindValue(":id",$id);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				return $array = $stmt->fetch();
			}
			
		}

		public function logar($email,$senha){
			
			$stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email=:email");
			$stmt->bindValue(":email",$email);
			$stmt->execute();
			if($stmt->rowCount() == 1){
				$currentUser = $stmt->fetch();
				$senha_verificar = $currentUser['senha'];
				if(password_verify($senha,$senha_verificar)){
					$_SESSION['logado'] = $currentUser['id'];
					return true;
				}
			}
			return false;
		}


		public function cadastrar($nome,$email,$senha,$telefone){
			
			$stmt=$this->db->prepare("SELECT * FROM usuarios WHERE email=?");
			$stmt->execute(array($email));
			if($stmt->rowCount() > 0){
				return false;
			}
			$stmt=$this->db->prepare("INSERT INTO usuarios(nome,email,senha,telefone)
								VALUES(?,?,?,?)");
			$stmt->execute(array($nome,$email,$senha,$telefone));
			return true;

		}

	}

 ?>