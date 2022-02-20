
<?php 
$pageTitle = 'AccountSaver - PinReset';
include "templates/header.php";

session_start();

if(!isset($_SESSION["username_sess"])){
    header('Location: index.php');
    exit();
}else if(!isset( $_SERVER['HTTP_REFERER'])){
    header('Location: dashboard.php');
    exit();
}else{
    $user_sess = $_SESSION["username_sess"];
    // Checking for condition
    if(isset($_POST["cancelpin"])){
        header("Location: dashboard.php");
        exit();
    }
    if(isset($_POST["changepin"])){
        // Checkin new pin
        $newpin = trim($_POST["pincd"]);
        $renewpin = trim($_POST["repincd"]);

        if($newpin != $renewpin){
            header("Location: resetpin.php?msg=newpin-and-repeatpin-are-different");
            exit();
        }else{
            // Hashing PIN 
            $hash_pin = password_hash($newpin, PASSWORD_DEFAULT);

            $change_pin = $conn->prepare("UPDATE users SET PIN = ? WHERE Username = ?");
            $change_pin->execute([$hash_pin,$user_sess]);
            if($change_pin){
                header("Location: dashboard.php?msg=pinchangedsuccess");
                exit();
            }else{
                header("Location: resetpin.php?msg=tryagain");
                exit();
            }
        }
    }
    ?>
         <body class="d-flex justify-content-center bg-dark align-items-center">
            <form action="" method="POST">
                <div class="card" style="width: 30rem; justify-content:center;">
                    <div class="card-body ">
                            <h2 class="text-center"><i class="fa-solid fa-wrench"></i> Manage PIN CODE</h2>
                            <div class="form-group">
                                <label for="exampleInputEmail1">New PIN CODE</label>
                                <input type="text" class="form-control form-control-user" id="pin" placeholder="PIN CODE" name="pincd" aria-describedby="pinhelp" pattern="[0-9]{4}" maxlength="4"  autocomplete="off" required>
                                <small id="pinhelp" class="form-text text-danger">Enter your new pin code to change it (4 DIGITAL Numbers).</small>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputemail">Repeat PIN CODE</label>
                                <input type="text" class="form-control form-control-user" id="pin" placeholder="PIN CODE" name="repincd" aria-describedby="pinhelp" pattern="[0-9]{4}" maxlength="4"  autocomplete="off" required>

                            </div>
                            <hr>
                            <div class="form-group float-right">
                                
                                <button name="cancelpin" class="btn btn-primary">Cancel</button>
                                <button name="changepin" class="btn btn-success">Change PIN</button>
                            </div>
                            <div class="form-group d-flex justify-content-around">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </form>




    <?php
    include "templates/footer.php";
}