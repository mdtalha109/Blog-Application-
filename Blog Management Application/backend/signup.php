<?php require_once("../includes/db.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>SIGN UP || Admin Panel</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="js/all.min.js"></script>
        
        <script src="js/feather.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <?php
                        if(isset($_POST['submit'])) {
                            $first_name = trim($_POST['first-name']);
                            $last_name = trim($_POST['last-name']);
                            $full_name = $first_name . " " . $last_name;
                           
                            

                            $email = trim($_POST['email-address']);
                            $sql1= "SELECT * from users where user_email= :email";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute([
                                ':email' => $email
                            ]);
                            $countEmail = $stmt1->rowCount();
                             if($countEmail!=0){
                                 $error_email_exist= true;
                             }
                            $password = trim($_POST['password']);
                            $confirm_password = trim($_POST['confirm-password']);
                            if($password != $confirm_password) {
                                $password_match_error = "Password doesn't match";
                            } else {
                                
                                $hash= password_hash($password, PASSWORD_BCRYPT, ['cost'=>10]);
                                $sql = "INSERT INTO users (user_name, user_email, user_password, register_on) VALUES (:name, :email, :password, :date)";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute([
                                    ':name' => $full_name,
                                    ':email' => $email,
                                    
                                    ':password' => $hash,
                                    ':date' => date("M, n, Y") .' at '. date("h:i A"),
                                   
                                ]);
                                $account_created_success = true;
                            }

                        }
                    ?>

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form action="signup.php" method="POST">
                                            <?php 
                                                if(isset($password_match_error)) {
                                                    echo "<p class='alert alert-danger '>{$password_match_error}</p>";
                                                }
                                                if(isset($account_created_success)) {
                                                    echo "<p class='alert alert-success alert-dismissible'> Account created successfully. <a href='signin.php' class='btn'>LogIn Now</a>
                                                    
                                                    </p>";
                                                    if(isset($error_email_exist)) {
                                                        echo "<p class='alert alert-success alert-dismissible'> Email already exist. <a href='signin.php' class='btn'>LogIn Now</a></p>";
                                                    }

                                                   
                                                   
                                                }
                                            ?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input name="first-name" class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input name="last-name" class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" required="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">nick name</label>
                                                        <input name="nickname" class="form-control py-4" id="inputnickName" type="text" placeholder="Enter nick name" />
                                                    </div>
                                                
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input name="email-address" class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required="true" />
                                            </div>
                                           
                                            <?php 
                                                
                                                if(isset($error_email_exist)) {
                                                    echo "<p class='text-red'>Email already exist</p>";
                                                }
                                            ?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label>
                                                        <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" required="true" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input name="confirm-password" class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" required="true" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0">
                                                <button name="submit" class="btn btn-primary btn-block" type="submit">Create Account</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <a href="signin.php">Have an account? Go to signin</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!--Script JS-->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
