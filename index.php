<?php 
    include "templates/header.php";

    session_start();
    
    if(isset($_SESSION["username_sess"])){
        header("Location: dashboard.php");
        exit();
    }else {
        // If login has been checked
        if(isset($_POST["loginin"])){
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            // cheking inputs
            if(empty($username) or empty($password) ){
                header("Location: index.php?msg=sorry-inputs-empty");
                exit();
            } else {
                // Fetching information for row where username is the same in the input
                $checking_user = $conn->prepare("SELECT * FROM users WHERE Username = ? ");
                $checking_user->execute([$username]);
                $user_fetch = $checking_user->fetch();
                $checking_user_row = $checking_user->rowCount();

                if($checking_user_row > 0){
                    // If the username exist now verifying password
                    $check_password = password_verify($password,$user_fetch['Password']);
                    if($check_password == false){
                        header("Location: index.php?msg=Username-Password-Incorrect");
                        exit();
                    }else{
                        $_SESSION["username_sess"] = $username;
                        header("Location: dashboard.php");
                        exit();
                    }
                }else{
                    header("Location: index.php?msg=Username-Password-Incorrect");
                    exit();
                }
            }
        }



                ?>
                <body class="bg-gradient-primary">

                    <div class="container">

                        <!-- Outer Row -->
                        <div class="row justify-content-center">

                            <div class="col-xl-10 col-lg-12 col-md-9">

                                <div class="card o-hidden border-0 shadow-lg my-5">
                                    <div class="card-body p-0">
                                        <!-- Nested Row within Card Body -->
                                        <div class="row">
                                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                            <div class="col-lg-6">
                                                <div class="p-5">
                                                    <div class="text-center">
                                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                                    </div>
                                                    <form class="user" method="POST" action="">
                                                        <div class="form-group">
                                                            <input type="text" name="username" class="form-control form-control-user"
                                                                id="exampleInputEmail"
                                                                placeholder="Enter Username...">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control form-control-user"
                                                                id="exampleInputPassword" placeholder="Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox small">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                                <label class="custom-control-label" for="customCheck">Remember
                                                                    Me</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" name="loginin" class="btn btn-primary btn-user btn-block">
                                                            Login
                                                        </button>
                                                    </form>
                                                    <hr>
                                                    <div class="text-center">
                                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                                    </div>
                                                    <div class="text-center">
                                                        <a class="small" href="register.php">Create an Account!</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <?php 
                    include "templates/footer.php";
                }
