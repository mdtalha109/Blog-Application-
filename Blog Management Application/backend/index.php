<?php require_once('./includes/header.php');?>
<?php require_once('../includes/db.php');?>

    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
            <a class="navbar-brand d-none d-sm-block" href="index.php">Admin Panel</a><button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
            <ul class="navbar-nav align-items-center ml-auto">
                
                <!--User Registration + New Comment Notification-->
                <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell"></i>
                        <span class="badge badge-red">2</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                        <h6 class="dropdown-header dropdown-notifications-header">
                            <i class="mr-2" data-feather="bell"></i>
                            Notification
                        </h6>

                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                            <div class="dropdown-notifications-item-content">

                                <div class="dropdown-notifications-item-content-details">
                                    December 29, 2019
                                </div>
                                <div class="dropdown-notifications-item-content-text">
                                    This is an alert message. It&apos;s nothing serious, but it requires your attention.
                                </div>
                            </div>
                        </a>

                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                            <div class="dropdown-notifications-item-content">

                                <div class="dropdown-notifications-item-content-details">
                                    December 29, 2019
                                </div>
                                <div class="dropdown-notifications-item-content-text">
                                    This is an alert message. It&apos;s nothing serious, but it requires your attention.
                                </div>
                            </div>
                        </a>

                        <a class="dropdown-item dropdown-notifications-footer" href="#">
                            View All Alerts
                        </a>
                    </div>
                </li>
                <!--User Registration + New Comment Notification-->

                <!--Message Notification-->
                <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="mail"></i>
                        <span class="badge badge-red">1</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                        <h6 class="dropdown-header dropdown-notifications-header">
                            <i class="mr-2" data-feather="mail"></i>
                            Message Notification
                        </h6>

                        <a class="dropdown-item dropdown-notifications-item" href="#"
                            ><img class="dropdown-notifications-item-img" src="./assets/img/mdabarik.jpg" />
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-text">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing.
                                </div>
                                <div class="dropdown-notifications-item-content-details">
                                    Md. A. Barik &#xB7; 58m
                                </div>
                            </div>
                        </a>

                        <a class="dropdown-item dropdown-notifications-footer" href="messages">
                            Read All Messages
                        </a>
                    </div>
                </li>
                <!--Message Notification-->

                <li class="nav-item dropdown no-caret mr-3 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="./assets/img/mdabarik.jpg"/></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="./assets/img/mdabarik.jpg" alt="Photo" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name">
                                    Md. A. Barik
                                </div>
                                <div class="dropdown-user-details-email">
                                    mdabarik@gmail.com
                                </div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="profile.php">
                            <div class="dropdown-item-icon">
                                <i data-feather="settings"></i>
                            </div>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#"
                            ><div class="dropdown-item-icon">
                                <i data-feather="log-out"></i>
                            </div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>


        <?php 
          $sql= "SELECT * FROM post where post_status= :status";
          $stmt= $pdo->prepare($sql);
          $stmt->execute([
              ':status' => 'published',
          ]);

          $count = $stmt->rowCount();
        
         ?>
        

        <!--Side Nav-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <a class="nav-link collapsed pt-4" href="index.php">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"><div class="nav-link-icon"><i data-feather="layout"></i></div>
                                Posts
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                                    <a class="nav-link" href="all-post.php">All Posts</a>
                                    <a class="nav-link" href="add-new.php">Add New Post</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="categories.php" ><div class="nav-link-icon"><i data-feather="chevrons-up"></i></div>
                                Categories
                            </a>

                            <a class="nav-link" href="pages.php" ><div class="nav-link-icon"><i data-feather="book-open"></i></div>
                                Pages
                            </a>

                            <a class="nav-link" href="users.php" ><div class="nav-link-icon"><i data-feather="users"></i></div>
                                Users
                            </a>

                            <a class="nav-link" href="comments.php" ><div class="nav-link-icon"><i data-feather="package"></i></div>
                                Comments
                            </a>

                            <a class="nav-link" href="messages.php" ><div class="nav-link-icon"><i data-feather="mail"></i></div>
                                Messages
                            </a>

                            <a class="nav-link" href="profile.php" ><div class="nav-link-icon"><i data-feather="user"></i></div>
                                Profile
                            </a>
                        </div>
                    </div>

                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title">Md. A. Barik</div>
                        </div>
                    </div>

                </nav>
            </div>


            <div id="layoutSidenav_content">
                <main>
                    <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
                        <div class="container-fluid">
                            <div class="page-header-content">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                                    <span>Dashboard</span>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <!--Table-->
                    <div class="container-fluid mt-n10">

                    <!--Card Primary-->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <p>All Posts</p>
                                    <p><?php  echo $count; ?></p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <p>Comments</p>
                                    <p>32</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <p>Categories</p>
                                    <p>32</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <p>Pages</p>
                                    <p>32</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Card Primary-->

                        <div class="card mb-4">
                            <div class="card-header">Most Popular Posts:</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Post Title</th>
                                                <th>Post Category</th>
                                                <th>Total Views</th>
                                                <th>Photo</th>
                                                <th>Author</th>
                                                <th>Posted On</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                                        <?php 
                                                            $sql= "SELECT * FROM post where post_status= :status";
                                                            $stmt= $pdo->prepare($sql);
                                                            $stmt->execute([
                                                                ':status' => 'published',
                                                            ]);

                                                            $count = $stmt->rowCount();

                                                            while($posts = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                $post_id= $posts['post_id'];
                                                                $post_title= $posts['post_title'];
                                                                $post_category= $posts['post_category'];
                                                                $post_views= $posts['post_views'];
                                                                $post_author= $posts['post_author'];
                                                                $post_date= $posts['post_date']; ?>

                                                    <tr>
                                                        <td><?php echo $post_id; ?></td>
                                                        <td>
                                                            <a href="../single.php?post_id=<?php echo $post_id; ?>">
                                                              <?php echo $post_title; ?>
                                                            </a>
                                                        </td>
                                                        <td> <?php echo $post_category; ?></td>
                                                        <td> <?php echo $post_views; ?></td>
                                                        <td>Photo</td>
                                                        <td> <?php echo $post_author; ?></td>
                                                        <td> <?php echo $post_date; ?></td>
                                                    </tr>




                                                                
                                                        <?php   }
                                                            
                                                        ?>
                                          
                                              
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->

                </main>
               
                <!--start footer-->
 <?php require_once('./includes/footer.php');?>
            
