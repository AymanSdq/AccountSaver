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
        ?>
                    <body id="page-top">

                        <!-- Page Wrapper -->
                        <div id="wrapper">


                            <!-- Content Wrapper -->
                            <div id="content-wrapper" class="d-flex flex-column ">

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
                                                    <a class="dropdown-item" href="profilesett.php">
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
                                    <div class="card w-50 m-auto">
                                        <div class="card-body ">
                                            <form >
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Username</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Email</label>
                                                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Enter Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Fullname</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Fullname">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>

                                    
                                    <!-- If you havge any probleme please contact us-->
                                        

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












?>