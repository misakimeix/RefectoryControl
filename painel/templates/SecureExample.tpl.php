<!doctype html>

<?php 

#echo var_dump($_SESSION);
@$_SESSION['user'] = $_POST['username'];
@$_SESSION['pass'] = $_POST['password'];


?>

<html lang="en">
  <head>
	<title>Login</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="images/logo.png"/>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
    		font-family: "Lato", sans-serif;
		}
		.main-head{
			height: 150px;
			background: #FFF;
		
		}

		.sidenav {
			height: 100%;
			background-color: #000;
			overflow-x: hidden;
			padding-top: 20px;
		}


		.main {
			padding: 0px 10px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
		}

		@media screen and (max-width: 450px) {
			.login-form{
				margin-top: 10%;
			}

			.register-form{
				margin-top: 10%;
			}
		}

		@media screen and (min-width: 768px){
			.main{
				margin-left: 40%; 
			}

			.sidenav{
				width: 30%;
				position: fixed;
				z-index: 1;
				top: 0;
				left: 0;
			}

			.login-form{
				margin-top: 40%;
			}

			.register-form{
				margin-top: 20%;
			}
		}


		.login-main-text{
			margin-top: 20%;
			padding: 60px;
			color: #fff;
		}

		.login-main-text h2{
			font-weight: 300;
		}

		.btn-black{
			background-color: #000 !important;
			color: #fff;
		}
	</style>
  </head>
  <body style="background-color:#fffedb;">
	<div class="sidenav">
         <div class="login-main-text">
		 	
            <h2>REFECONTROL<br> IFPI</h2>
            <p>Faça login com sua matricula e senha</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
			<img src="images/ifpilogo.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
               <form method="POST" action="login">
                  <div class="form-group">
                     <label>Matricula</label>
                     <input type="text" class="form-control" placeholder="Matricula" name="username">
                  </div>
                  <div class="form-group">
                     <label>Senha</label>
                     <input type="password" class="form-control" placeholder="Senha" name="password">
                  </div>
                  <button type="submit" class="btn btn-black">Entrar</button>
                  <a href="Registro">
				  <button type="button" class="btn btn-secondary" >Registrar</button>
				  </a>
               </form>
            </div>
         </div>
      </div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>