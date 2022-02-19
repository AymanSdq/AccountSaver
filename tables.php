<?php
    $pageTitle = 'AccountSaver - DataAccounts';
    include "templates/header.php";

    session_start();
    if(!isset($_SESSION["username_sess"])){
        header("Location: index.php?");
        exit();
    }else{
        // Getting the session name
        $usr_sess = $_SESSION["username_sess"];
        // Fetchin the User data 
        $userinfo_fetch = $conn->prepare("SELECT * FROM users WHERE Username = ?");
        $userinfo_fetch->execute([$usr_sess]);
        $userinfo = $userinfo_fetch->fetch();
        // User ID 
        $userID = $userinfo["UserID"];

        // Fetching the User Data table
        $tb_Userdata = $conn->prepare("SELECT * FROM savedacc WHERE UserID = ?");
        $tb_Userdata->execute([$userID]);
        // Count rows
        $tbl_rows = $tb_Userdata->rowCount();
        // Fetch rows
        $tbl_data_fetch = $tb_Userdata->fetchall();


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

                            <a style="text-decoration:none"  href="dashboard.php"><h4 class="logo text-dark" >AccountSaver</h4></a>

                        
                        

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
                        

                        
                            
                    
                        
                            <!-- indormation -->
                            <div class="card text-center mx-3">
                            <div class="card shadow ">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables For <?php echo $userinfo["Fullname"] ?></h6>
                            </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Website</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if($tbl_rows > 0){
                                                        foreach($tbl_data_fetch as $tbl_data_fetching){?>
                                                            <tr>
                                                                <td><?php echo $tbl_data_fetching["Websitename"]?></td>
                                                                <td><?php echo $tbl_data_fetching["Usernameacc"]?></td>
                                                                <td><?php echo $tbl_data_fetching["Emailacc"]?></td>
                                                                <td><?php echo $tbl_data_fetching["Passwordacc"]?></td>
                                                                <td>Manage</td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }else{?>
                                                        <tr>
                                                            <td class="text-center" colspan="5">There is not Account Yet <a href="dashboard.php"><i class="fa-solid fa-plus"></i> Add New Account</a></td>
                                                        </tr>
                                                    <?php
                                                    }

                                                ?>
                                            </tbody>
                                        </table>
                            </div>
                            <hr>
                            
                            

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


