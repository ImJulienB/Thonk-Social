<?php
session_start();
include "php/database_connection.php";
?>
<html>
	<head>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" href="css/loginsignin.min.css">
		
	</head>
	<body>
		<section class="login-block">
		    <div class="container">
				<div class="row">
					<div class="col-md-4 login-sec">
					    <h2 class="text-center">Log in</h2>
					    <form action="./php/login.php" method="post" class="login-form">
							<div class="form-group">
			    				<label for="exampleInputEmail1" class="text-uppercase">Email</label>
			    				<input type="email" class="form-control" name="email" required>
			  				</div>

			  				<div class="form-group">
			    				<label for="exampleInputPassword1" class="text-uppercase">Password</label>
			    				<input id="pass1" type="password" class="form-control" name="password" required>
			  				</div>
			  
			    			<div class="form-check">
			    				<span id="confirmMessage"></span>
			    				<button id="submit" type="submit" name="submit" class="btn btn-login float-right">Submit</button>
			  				</div>
						</form>
							<?php
								if(isset($_SESSION["err"])) {
									echo $_SESSION["err"];
									unset($_SESSION["err"]);
								}
							?>
					</div>
					<div class="col-md-8 banner-sec">
		    			<div class="carousel-item active">
		      				<img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
		      				<div class="carousel-caption d-none d-md-block">
		        				<div class="banner-text">
		            				<h2>Let's thonk together</h2>
		        				</div>	
		  					</div>
		  				</div>
		            </div>	       
				</div>
			</div>
		</section>
	</body>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>