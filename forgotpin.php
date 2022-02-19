<?php include "templates/header.php";

session_start();

if(!isset($_SESSION["username_sess"])){
    header('Location: index.php');
    exit();
}else if(!isset( $_SERVER['HTTP_REFERER'])){
    header('Location: dashboard.php');
    exit();
}else{
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
                                    <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-2">Forgot Your PIN?</h1>
                                                <p class="mb-4">We get it, stuff happens. Just enter your accountpassword below
                                                    and we will help you to change your password</p>
                                            </div>
                                            <form class="user">
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-user"
                                                        id="exampleInputEmail" 
                                                        placeholder="Enter Password" required>
                                                </div>
                                                <button class="btn btn-primary btn-user btn-block">
                                                    Reset PIN
                                                </button>
                                            </form>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <?php include "templates/footer.php";
            }


?>



