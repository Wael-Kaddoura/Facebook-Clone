<?php
    include "php/connection.php";

    session_start();

    if (!isset($_SESSION["loggedin"])) {
        $_SESSION["loggedin"] = false ;
    }

    if (!isset($_SESSION["email_used"])) {
    $_SESSION["email_used"] = false ;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">


</head>

<body>
    <!--<div class="se-pre-con"></div>-->
    <div class="theme-layout">
        <div class="container-fluid pdng0">
            <div class="row merged">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="land-featurearea">
                        <div class="land-meta">
                            <h1>Winku</h1>
                            <p>
                                Join Winku to connect with Users from around the globe!
                            </p>
                            <div class="friend-logo">
                                <span><img src="images/wink.png" alt=""></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="login-reg-bg">
                        <div class="log-reg-area sign">
                            <h2 class="log-title">Register Now</h2>

                            <?php if($_SESSION["email_used"]){?>
            
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                This email is already used!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            <?php } $_SESSION["email_used"] = false; ?>



                            <form method="POST" id="signup-form" action="php/signup.php">
                                <div class="form-group">
                                    <input type="text" name = "first_name" id = "first-name" required="required" />
                                    <label class="control-label" for="first-name" id = "vfirst-name">First Name</label><i
                                        class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" name = "last_name" id = "last-name" required="required" />
                                    <label class="control-label" for="last-name" id = "vlast-name">Last Name</label><i
                                        class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name = "password" id = "password" required="required" />
                                    <label class="control-label" for="password">Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name = "confirmPassword" id = "confirm-password" required="required" />
                                    <label class="control-label" for="confirmPassword" id = "vconfirm-password">Confirm Password</label><i class="mtrl-select"></i>
                                </div>
                                <div class="form-radio">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" checked="checked" id="male" value="0"/><i
                                                class="check-box"></i>Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" id="female" value="1"/><i class="check-box"></i>Female
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" required="required" name = "email" id = "email" />
                                    <label class="control-label" for="email" id = "vemail">Email</label><i
                                        class="mtrl-select"></i>
                                </div>

                                <a href="login.php" style="color: blue;">Already have an account?</a>

								<div class="submit-btns">
									<button class="btn btn-primary" type="button" id = "submit-button">Create Account</button>
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

    <script src="js/signup.js"></script>

</body>

</html>