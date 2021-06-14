
<?php require_once("./includes/header.php");  ?>

        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                        <div class="container">
                            <a class="navbar-brand text-dark" href="index.php">TechBarik</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><img src="img/menu.png" style="height:20px;width:25px" /><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-5">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home </a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                </ul>
                                <?php
                                  if(isset($_SESSION['login'])){  ?>
                                      <form action="logout.php">
                                      <button class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signin.php">Sign out(<?php echo $_SESSION['user_name']?>)</button>
                                      </form>
                                <?php  } else{
                                       echo "<a class='btn-teal btn rounded-pill px-4 ml-lg-4' href='backend/signin.php'>Sign in</a>" ;
                                       echo "<a class='btn-teal btn rounded-pill px-4 ml-lg-4' href='backend/signin.php'>Sign in</a>";    
                                        
                                }
                                ?>
                               

                            </div>
                        </div>
                    </nav>
               <?php


                                   
                                    if(isset($_GET['post_id']))
                                    {
                                            $number =  $_GET['post_id'];
                                            
                                            $sql = "SELECT * FROM post WHERE post_id = :id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute([
                                                ':id' => $number
                                            ]);
                                            $count = $stmt->rowCount();
                                            if($count){
                                                 $detail = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $post_title =  $detail['post_title'];
                                            $post_detail =  $detail['post_detail'];
                                            $post_category= $detail['post_category'];
                                            $post_date= $detail['post_date'];
                                            $post_author= $detail['post_author'];
                                            

                                            $sql1= "UPDATE post SET post_views = post_views + 1 WHERE post_id= :id";
                                            $stmt = $pdo ->prepare($sql1);
                                            $stmt->execute([
                                                ':id' => $number
                                            ]);
                                            } else {
                                                header("Location: index.php");
                                            }   
                                    }
                            
 $current_page = $post_title;  ?>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                                        <div class="page-header-content pt-10">
                                            <div class="container text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-8">
                                                        <h1 class="page-header-title mb-3"> <?php echo $post_title; ?> </h1>
                                                        <p class="page-header-text"><?php echo $post_date; ?>, <?php echo $post_category; ?>  <?php echo $post_author; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="svg-border-rounded text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                                        </div>
                                    </header>
                        <?php 
                                ?>
                    <section class="bg-white py-10">
                        <div class="container">
                            <!--start post content-->
                            <div>
                                
                                <h1> <?php echo $post_title;  ?></h1>
                                <p><?php  echo $post_detail; ?></p>
                            </div>
                            <!--end post content-->

                            <!--start comment section-->
                           



                            <div class="pt-5 col-lg-8 col-xl-9">
                                <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                                    <h2 class="mb-0">Comments</h2>
                                </div>


                                <hr class="mb-4" />

                                <?php
                                $sql1= "SELECT * FROM comments where com_status=:comment_status AND com_post_id= :post_id";
                                $stmt= $pdo->prepare($sql1);

                                $stmt->execute([
                                    ':comment_status' =>'approved',
                                    ':post_id' => $_GET['post_id']
                                ]);

                                $count= $stmt->rowCount();
                                if($count==0)
                                 echo "No comment found";
                                
                              
                                    while($comments= $stmt->fetch(PDO::FETCH_ASSOC)){
                                        $user_name= $comments['com_user_name'];
                                        $com_date= $comments['com_date'];
                                        $com_detail= $comments['com_detail'];
                                        $com_status = $comments['com_status'];

                                        
                                        ?>


                                <div class="card mb-5">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="mr-2 text-dark">
                                            <?php echo $user_name;  ?>
                                            <div class="text-xs text-muted"> <?php echo  $com_date;  ?> </div>
                                        </div>
                                        <div class="h5"><span class="badge badge-warning-soft text-warning font-weight-normal">Awaiting Response</span></div>
                                    </div>
                                    <div class="card-body">
                                    <?php echo $com_detail;  ?>
                                    </div>
                                </div>
                                <?php    }
                            ?>
                                <?php
                                if(isset($_COOKIE['_uid_']) || isset($_COOKIE['_uiid_']) || isset($_SESSION['login']) ) {?>
                                 <div class="card">
                                    <div class="card-header">Add Comment</div>
                                    <div class="card-body">
                                   <?php if(isset($_POST['submit']))
                                   {
                                       $comments= trim($_POST['comments']);
                                       $sql= "INSERT INTO comments (com_post_id, com_detail, com_user_id, com_user_name, com_date, com_status) VALUES (:post_id, :com_detail, :com_user_id, :com_user_name, :com_date, :com_status)";
                                       $stmt= $pdo->prepare($sql);
                                       $stmt->execute([
                                           ':post_id' => $_GET['post_id'],
                                           ':com_detail' => $_POST['comments'],
                                           ':com_user_id' => base64_decode($_COOKIE['_uid_']),
                                           ':com_user_name' => $_SESSION['user_name'],
                                           ':com_date' =>  date("M, n, Y") .' at '. date("h:i A"),
                                           ':com_status' => 'unapproved'
                                       ]);
                                   }
                                   ?>

                                        <form action="single.php?post_id= <?php echo $_GET['post_id']; ?>" method= "POST">
                                            <textarea name="comments" placeholder="Type here..." class="form-control mb-2" rows="4"></textarea>
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm mr-2">Post Comment</button>
                                        </form>
                                    </div>
                                </div>

                                <?php } else {
                                    echo "<a href='backend/signin.php'> sign in to comment</a>";
                                }
                                
                                ?>
                              
                                
                               
                            </div>
                            <!--end comment section end-->
                        </div>

                        <!--Rounded style-->
                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                        <!--Rounded style-->
                    </section>
                </main>
            </div>

            <!--Footer start-->
            <div id="layoutDefault_footer">
                <footer class="footer pt-4 pb-4 mt-auto bg-dark footer-dark">
                    <div class="container">
                        <hr class="my-1" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &#xA9; Your Website 2020</div>
                            <div class="col-md-6 text-md-right small">
                            <a href="privacy-policy.php">Privacy Policy</a>
                                &#xB7;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!--Footer end-->

<?php require_once("./includes/footer.php"); ?>