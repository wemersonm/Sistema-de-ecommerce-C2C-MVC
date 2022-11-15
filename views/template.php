<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Classificados</title>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
          <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="logoBrand" width="60px" height="65px">
          <strong>Class</strong>icados
      </a>
      <ul class="nav">
          <?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])):  
          $id = $_SESSION['logado'];
          $user = new Usuarios();
          $currentUser = $user->getUsuario($id);
           ?>
            <li class="nav-item">
                <a class="nav-link fs-5 text-light"  href="<?php echo BASE_URL; ?>anuncios" >Meus anuncios</a>  
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5 text-light" href="<?php echo BASE_URL; ?>login/sair">Sair</a>
            </li>
              <li class="nav-item">
                <a class="nav-link fs-5 text-light" href="#" >Olá <?php echo '<span class="text-warning">'.$currentUser['nome'].'</span>';?></a>
              </li>
          <?php else: ?>
            <li class="nav-item">
                <a class="nav-link fs-5 text-light"  href="<?php echo BASE_URL ?>login">Login</a>  
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5 text-light" href="<?php echo BASE_URL; ?>cadastro" >Cadastro</a>
            </li>
          <?php endif; ?>
      </ul>

  </div>
</nav> 

<?php $this->loadViewInTemplate($viewName,$viewData); ?>