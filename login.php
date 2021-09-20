<?php
    include "php/connection.php";

    session_start();

    if (!isset($_SESSION["loggedin"])) {
        $_SESSION["loggedin"] = FALSE ;
    }

    if (!isset($_SESSION["new_account"])) {
        $_SESSION["new_account"] = FALSE;
    }
    
    if (!isset($_SESSION["login_error"])) {
        $_SESSION["login_error"] = FALSE;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>
	<link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

	<link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>

<body>
	<!--<div class="se-pre-con"></div>-->
	<div class="theme-layout">
		<div class="container-fluid pdng0">
			<div class="row merged">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="land-featurearea">
					<a href="index.php">
						<div class="land-meta">
							<h1>Winku</h1>
							<p>
								Join Winku to connect with Users from around the globe!
							</p>
							<div class="friend-logo">
								<span><img src="images/wink.png" alt=""></span>
							</div>
						</div>

					</a>					
				</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="login-reg-bg">
						<div class="log-reg-area sign">

						<?php if ($_SESSION["new_account"]) {?>

							<div class="alert alert-success alert-dismissible fade show" role="alert">
							Your Account is successfull created!
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>

							<?php $_SESSION["new_account"] = false;} else if ($_SESSION["login_error"]) {?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Wrong email or/and password!
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>

						<?php $_SESSION["login_error"] = false;}?>


							<h2 class="log-title">Login</h2>

							<form method="POST" id="login-form" action="php/login.php">
								<div class="form-group">
									<input type="text" id="email" name = "email" required="required" />
									<label class="control-label" for="email" id="vemail">Username</label><i class="mtrl-select"></i>
								</div>
								<div class="form-group">
									<input type="password" id="password" name = "password" required="required" />
									<label class="control-label" for="password">Password</label><i class="mtrl-select"></i>
								</div>

								<div class="submit-btns">
									<button class="btn btn-primary" type="button" id = "submit-button">Login</button>
								</div>

								<div class="submit-btns">
								<span class="txt2 p-b-10"> Don’t have an account? </span>
								<a href="signup.php" class="txt3 bo1 hov1"> Sign up now </a>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

	<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

	<script src="js/login.js"></script>
</body>

</html>