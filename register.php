<?php
    include "templates/header.php";
    session_start();

    if(isset($_SESSION["username_sess"])){
        header("Location: dashboard.php");
        exit();
    }else{
                if(isset($_POST["register"])){
                    // Caling Every Inputs
                    $username = trim($_POST["username"]);
                    $email = trim($_POST["email"]);
                    $pass = trim($_POST["passw"]);
                    $fullname = trim($_POST["fullname"]);
                    $rpass = trim($_POST["reppass"]);
                    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);;
                    
                    // Checking if it's empty
                    if(empty($username) or empty($email) or empty($pass) or empty($rpass) or empty($fullname)){
                        header("Location: register.php?msg=sorry-inputs-empty");
                        exit();
                    }else if($pass!=$rpass){
                        header("Location: register.php?msg=password-repatpass-incorrect");
                        exit();
                    } else {
                        // Checking if the user exit
                        $check_account = $conn->prepare("SELECT * FROM users WHERE Username = ? or Email = ?");
                        $check_account->execute([$username,$email]);
                        $check_row = $check_account->rowCount();
                        // If user existe
                        if($check_row > 0 ){
                            header("Location: register.php?msg=user-already-existe");
                            exit();
                        } else {
                            // Adding user into database
                            $add_account = $conn->prepare("INSERT INTO users (Username,Email,Password,Fullname) VALUES (?,?,?,?)");
                            $add_account->execute([$username,$email,$hashed_pass,$fullname]);
                            if($add_account){
                                header("Location: index.php");
                                exit();
                            }
                        }
                    }
                }
            ?>
            <body class="bg-gradient-primary">
            
                <div class="container">
            
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                        </div>
                                        <!-- Form for register -->
                                        <form class="user" method="POST" action="">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" name="username" id="exampleInputEmail"
                                                    placeholder="Enter Username" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"  name="email" id="exampleInputEmail"
                                                    placeholder="Email Address" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" name="fullname" id="exampleInputEmail"
                                                    placeholder="Enter Fullname" required>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0" required>
                                                    <input type="password" class="form-control form-control-user"
                                                        id="exampleInputPassword"  name="passw" placeholder="Password">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="password" class="form-control form-control-user"
                                                        id="exampleRepeatPassword"  name="reppass" placeholder="Repeat Password" required>
                                                </div>
                                            </div>
                                            <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                                Register Account
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="index.php">Already have an account? Login!</a>
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
    