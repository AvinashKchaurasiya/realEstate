<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <?php require_once('cssLink.php'); ?>
</head>

<body>
    <?php
    include('includes/header2.php');
    ?>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header" style="font-weight:bold;">Login</div>
                    <div class="row m-5 g-0">
                        <div class="col-md-6 icon">
                            <img src="img/login/login_img.gif" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['sms'])) {
                                    if ($_SESSION['sms'] === '1') {
                                ?>
                                        <div class="alert alert-success">Successfully Register Verification Mail send to your email...</div>
                                    <?php
                                        unset($_SESSION['sms']);
                                    } else if ($_SESSION['sms'] === '2') {
                                    ?>
                                        <div class="alert alert-danger">Invalid Password...</div>
                                    <?php
                                        unset($_SESSION['sms']);
                                    } else if ($_SESSION['sms'] === '3') {
                                    ?>
                                        <div class="alert alert-danger">Please wait until admin is not aproved you...</div>
                                    <?php
                                        unset($_SESSION['sms']);
                                    } else if ($_SESSION['sms'] === '4') {
                                    ?>
                                        <div class="alert alert-danger ">Invalid User Type Or UserId...</div>
                                <?php
                                        unset($_SESSION['sms']);
                                    }
                                }
                                ?>
                                <form id="f_login" action="authentication/Login_proccess.php" method="post">
                                    <label class="mb-2">User Type</label>
                                    <select class="form-control mb-3" name="login_type">
                                        <option hidden>Choose Your Role...</option>
                                        <!-- <option value="admin">Admin</option> -->
                                        <option value="agent">Agent</option>
                                        <option value="user">User</option>
                                    </select>
                                    <label class="mb-2">Email</label>
                                    <input class="form-control mb-3" type="email" name="email" placeholder="Enter Your Email..." />
                                    <label class="mb-2">Password <span id="err"></span></label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" name="password" id="password" minlength="6" placeholder="Enter Password..." onkeyup="validatePassword(this.value)" />
                                        <button class="btn btn-outline-secondary" type="button" id="show_btn"><i class="bi bi-eye"></i></button>
                                    </div>
                                    <label class="mb-2">Forget Password ? <a href="forget_password.php">Click here</a></label><br />
                                    <input type="submit" class="btn btn-success mb-2" name="login" value="Login" /><br />
                                    <div class="input-group">
                                        <label class="mb-2 mt-2">Don't have an account? <a href="registration.php">Register Now</a></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <?php require_once('includes/footer.php'); ?>
    </div>
    <?php require_once('jsLink.php') ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const showButton = document.getElementById("show_btn");
            let passwordVisible = false;

            showButton.addEventListener("click", function() {
                if (passwordVisible) {
                    passwordInput.type = "password";
                    showButton.innerHTML = '<i class="bi bi-eye"></i>';
                    passwordVisible = false;
                } else {
                    // If password is currently hidden, show it
                    passwordInput.type = "text";
                    showButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    passwordVisible = true;
                }
            });

        });
    </script>
</body>

</html>