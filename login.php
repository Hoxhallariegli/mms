<?php 
session_start();
include_once 'classes/loginclass.php';

if(isset($_SESSION["login"])){

  if($_SESSION["login"] && $_SESSION["Access"] === 'User'){
  header("location: index.php");
  exit;
}else{
  "error";
}
}


$check = new Login();

if (isset($_POST['submit'])) { 
		extract($_POST);   
	    $login = $check->check_login($emailusername, $password);	 
		echo $login;   
	//    $level = $user->check_level($emailusername);
	    if ($login == true && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin') || $_SESSION['Access']=='User') {
	       header("location:index.php");
      }else{
	    	echo 'Wrong username or password';
	    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
  	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">Username</label>
									<input id="email" type="text" class="form-control" name="emailusername" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password
										
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-sm" name="submit" value="Login">
										Login
									</button>
								</div>
								
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; <?php echo date("Y"); ?> &mdash; Key Service 
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/my-login.js"></script>
</body>
</html>
