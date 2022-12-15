<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>School Visits - Effat University</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
		<link href="css/mystyle.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <?php include "sidebar.php" ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <h3 class="mt-2"> School Visits Management System </h3> 
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="#!">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#!">Action</a>
                                        <a class="dropdown-item" href="#!">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#!">Something else here</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
					<?php

						// connect to the database
						$connection = mysqli_connect("localhost","root","","schoolvisits");

						$error = mysqli_connect_error();
						if($error != null)
							echo("There is a problem".$error);
						
						$username = $_POST['username'];
						$password = $_POST['password'];
						$fullname = $_POST['fullname'];
						$email = $_POST['email'];
						
						// first check the database to make sure 
						// a user does not already exist with the same username and/or email
						$user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
						$result = mysqli_query($connection, $user_check_query);
						$user = mysqli_fetch_assoc($result);
						
						// form validation: ensure that the form is correctly filled ...
						// by adding (array_push()) corresponding error unto $errors array
						if (empty($username)) { exit("Error, username was left empty, please try again."); }
						if (empty($password)) { exit("Error, password was left empty, please try again."); }
						if (empty($fullname)) { exit("Error, fullname was left empty, please try again."); }
						if (empty($email)) { exit("Error, email was left empty, please try again."); }
						
						
						if ($user) { // if user exists
							if ($user['username'] === $username) {
								exit("Username already exists, please try again with a different username.");
								}

							if ($user['email'] === $email) {
								exit("Email already exists, please try again with a different email.");
								}
						}
						
						$sql = "insert into user(username, pass, fullname, email) values('".$username."','".$password."','".$fullname."','".$email."')";
						if( mysqli_query($connection,$sql) )
						{
							echo "<h4> The data has been saved. Thank you for registering! </h4>";
						}
						else
						{
							echo "<h4> We could not save the data. Please try again! </h4>";
						}

						?>
                   
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
