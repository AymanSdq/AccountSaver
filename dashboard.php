<?php 
    include "templates/header.php";

    session_start();
    
    if(!isset($_SESSION["username_sess"])){
        header("Location: index.php?");
        exit();
    }else{
        //fetching full name from 
        $usr_sess = $_SESSION["username_sess"];
        $userinfo_fetch = $conn->prepare("SELECT * FROM users WHERE Username = ?");
        $userinfo_fetch->execute([$usr_sess]);
        $userinfo = $userinfo_fetch->fetch();
        // Adding account into databse
        if(isset($_POST["addacc"])){
            //User  from session
            $usr = $_SESSION["username_sess"];
            // Fetching the UserId from the users table
            $get_userid = $conn->prepare("SELECT UserID from users WHERE Username = ?");
            $userid = $get_userid->execute([$usr]);
            // After Clicking the button we call the input value
            $webname = $_POST["webname"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            // Checking if the inputs are empty or not 
            if(empty($webname) or empty($username) or empty($email) or empty($password)){
                header("Location: dashboard.php?msg=sorry-inputs-empty");
                exit();
            } else {
                // Inserting Accounts Data
                $ins_account = $conn->prepare("INSERT INTO savedacc (UserID,Websitename,Usernameacc,Emailacc,Passwordacc) VALUES (?,?,?,?,?)");
                $ins_account->execute([$userid,$webname,$username,$email,$password]);
                header("Location: dashboard.php?msg=added-success");
                exit();
            }

        }
        // Logout code 
        if(isset($_POST["logout"])){
            // Delete the Session to logout
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
        ?>
                    <body id="page-top">

                        <!-- Page Wrapper -->
                        <div id="wrapper">


                            <!-- Content Wrapper -->
                            <div id="content-wrapper" class="d-flex flex-column">

                                <!-- Main Content -->
                                <div id="content">

                                    <!-- Topbar -->
                                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                                        <h4 class="logo text-dark" >AccountSaver</h4>

                                    
                                    

                                        <!-- Topbar Navbar -->
                                        <ul class="navbar-nav ml-auto">

                                            <!-- Nav Item - User Information -->
                                            <li class="nav-item dropdown no-arrow">
                                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userinfo["Fullname"] ?></span>
                                                    <img class="img-profile rounded-circle"
                                                        src="img/undraw_profile.svg">
                                                </a>
                                                <!-- Dropdown - User Information -->
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                                    aria-labelledby="userDropdown">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Profile
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Settings
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Activity Log
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Logout
                                                    </a>
                                                </div>
                                            </li>

                                        </ul>

                                    </nav>
                                    <!-- End of Topbar -->
                                    <!-- Information about accounts -->
                                    

                                    <!-- The form that will help you to add accounts -->
                                    <div class="container-fluid">
                                        <div class="card">
                                        <div class="card-header text-center bg-primary text-white">
                                            Add Accounts
                                        </div>
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Save your account information</h5>
                                            <p class="card-text fst-italic">(Click on this button it will show you a form that you can use to add or save your accounts)</p>
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Accounts</button>
                                            <!-- The modal showin on clicking on the button -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">Insert your account information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="">
                                                        <!-- Website Name -->
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="float-left">Website Name :</label>
                                                            <input type="text" name="webname" class="form-control" id="recipient-name" required>
                                                        </div>
                                                        <!-- Username of Account  -->
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="float-left">Username :</label>
                                                            <input type="text" name="username" class="form-control" id="recipient-name" required>
                                                        </div>
                                                        <!-- Email of Account  -->
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="float-left">Email :</label>
                                                            <input type="text" name="email" class="form-control" id="recipient-name" required>
                                                        </div>
                                                        <!-- Password of Account  -->
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="float-left">Password :</label>
                                                            <input type="password" name="password" class="form-control" id="recipient-name" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="addacc" class="btn btn-success">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- End of cadr body  -->
                                        
                                        </div>
                                        <hr>
                                        <!-- indormation -->
                                        <div class="card text-center">
                                            <div class="card-header bg-success text-white">
                                                Show Accounts
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Special title treatment</h5>
                                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                            <div class="card-footer text-muted border border-secondary">
                                                PIN Needed <a href="#">Forgot Pin</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- warning & policy  -->
                                        <div class="card-deck">
                                            <div class="card">
                                                <img class="card-img-top" src="img/dashboard/stff.jpg" alt="Card image cap">
                                                <div class="card-body">
                                                <h5 class="card-title text-center">Staff Help</h5>
                                                <p class="card-text">Staff is available 24/7 just to help you and make sure that you are having a really good experience.</p>
                                                <button class="btn btn-primary btn-block">View Page</button>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <img class="card-img-top" src="img/dashboard/datacenter.jpg" alt="Card image cap">
                                                <div class="card-body">
                                                <h5 class="card-title text-center">Data Center</h5>
                                                <p class="card-text">Our Data center is one of the biggest data center in the world. Just to give you the best exoerience.</p>
                                                <button class="btn btn-primary btn-block">View Page</button>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <img class="card-img-top" src="img/dashboard/story.jpg" alt="Card image cap">
                                                <div class="card-body">
                                                <h5 class="card-title text-center">Story</h5>
                                                <p class="card-text">Read our story how did we get the idea and how did we begin . our project Idea since the day one .</p>
                                                <button class="btn btn-primary btn-block">View Page</button>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <!-- footer  -->
                                    <!-- /.container-fluid -->
                                </div>
                                <!-- End of Main Content -->
                            </div>
                            <!-- End of Content Wrapper -->

                        </div>
                        <!-- End of Page Wrapper -->

                        <!-- Scroll to Top Button-->
                        <a class="scroll-to-top rounded" href="#page-top">
                            <i class="fas fa-angle-up"></i>
                        </a>

                        <!-- Logout Modal-->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                    <form action="" method="POST">
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger" name="logout" >Logout</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php include "templates/footer.php";
                    
}
