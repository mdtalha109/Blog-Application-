<?php session_start();  ?>  
<?php require_once("../includes/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>SIGN IN || Admin Panel</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="js/all.min.js"></script>
        <script src="js/feather.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <?php
                                    if(isset($_POST['submit'])) {
                                        $email = trim($_POST['email']); 
                                        $password = trim($_POST['password']); 
                                        
                                        $sql = "SELECT * FROM users WHERE user_email= :email";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute([
                                            ':email' => $email
                                        ]);
                                        $count= $stmt->rowCount();
                                        if($count==0){
                                            $error= "WRONG CREDENTIAL";
                                        }  else if($count > 1) {
                                            $error = "WRONG CREDINTIALS!";
                                        } else if($count == 1) {
                                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $user_password_hash = $user['user_password'];
                                            $user_name= $user['user_name'];
                                            $user_role= $user['user_role'];
                                            $user_id= $user['user_id'];
                                            if(password_verify($password, $user_password_hash)) {
                                               $success= "sign in successful!";
                                               if(!empty($_POST['check'])) {
                                                $user_id = $user['user_id'];
                                                $user_nickname = $user['user_nickname'];
                                                $d_user_id = base64_encode($user_id);
                                                $d_user_nickname = base64_encode($user_nickname);
                                                // userid
                                                setcookie('_uid_', $user_id, time() + 60 * 60 * 24, '/', '', '', true);
                                                // user nickname
                                                setcookie('_uiid_', $user_nickname, time() + 60 * 60 * 24, '/', '', '', true);
                                            }


                                               $_SESSION['user_name'] = $user_name;
                                               $_SESSION['user_role'] = $user_role;
                                               $_SESSION['user_id']= 
                                               $_SESSION['login']= 'success';
                                               header("Refresh:1; url= ../index.php");

                                            } else {
                                                $error_password = "Wrong password!";
                                            }
                                        }
                                             

                                  
                              }
                             



                            ?>



                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">SIGN IN</h3></div>
                                    <div class="card-body">
                                        <form action="signin.php" method="POST">
                                        <?php
                                          if(isset($error)) {
                                            echo "<p class='alert alert-danger '>{$error}</p>";
                                        }
                                        if(isset($success)) {
                                            echo "<p class='alert alert-success '>{$success}</p>";
                                        }


                                        if(isset($error_password))
                                        {
                                            echo "<p class='alert alert-danger '>{$error_password}</p>";
                                        }

                                        ?>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input name="email" class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" required/>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input name= "check" class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label
                                                 ></div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                              <a class="small" href="#"></a>
                                               <button name="submit" class="btn btn-primary btn-block" href="index.php">SIGN IN</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
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
