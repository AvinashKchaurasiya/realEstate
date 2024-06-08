<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

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
                    <div class="card-header" style="font-weight:bold;">Registration Form</div>
                    <div class="row m-5 g-0">
                        <div class="col-md-6 icon">
                            <img src="img/login/login_img.gif" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['err'])) {
                                    if ($_SESSION['err'] === '0') {
                                ?>
                                        <div class="alert alert-danger">Registration Failed</div>
                                <?php
                                    }
                                    unset($_SESSION['err']);
                                }
                                ?>
                                <form id="f_login" action="Authentication/registration_proccess.php" method="post">
                                    <label class="mb-2">User Type</label>
                                    <select class="form-control mb-3" name="login_type" required>
                                        <option hidden>Choose Your Role...</option>
                                        <option value="agent">Agent</option>
                                        <option value="user">User</option>
                                    </select>
                                    <label class="mb-2">Name</label>
                                    <input class="form-control mb-3" type="name" name="name" placeholder="Enter Your Name..." required />
                                    <label class="mb-2">Email</label>
                                    <input class="form-control mb-3" type="email" name="email" placeholder="Enter Your Email..." required />
                                    <label class="mb-2">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password..." required />
                                        <button class="btn btn-outline-secondary" type="button" id="show_btn"><i class="bi bi-eye"></i></button>
                                    </div>
                                    <label class="mb-2">Confirm Password <span id="err"></span></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Enter Password..." required />
                                        <button class="btn btn-outline-secondary" type="button" id="show_btn1"><i class="bi bi-eye"></i></button>
                                    </div>
                                    <input type="submit" class="btn btn-success mb-2" name="signup" value="Register" /><br />
                                    <div class="input-group text-center">
                                        <label class="mb-2 mt-2">Have an account? <a href="login.php">Login</a></label>
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
            const cpasswordInput = document.getElementById("cpassword");
            const showButton = document.getElementById("show_btn");
            const showButton1 = document.getElementById("show_btn1");
            const errSms = document.getElementById("err");
            let passwordVisible = false;

            showButton.addEventListener("click", function() {
                if (passwordVisible) {
                    passwordInput.type = "password";
                    showButton.innerHTML = '<i class="bi bi-eye"></i>';
                    passwordVisible = false;
                } else {
                    passwordInput.type = "text";
                    showButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    passwordVisible = true;
                }
            });
            showButton1.addEventListener("click", function() {
                if (passwordVisible) {
                    cpasswordInput.type = "password";
                    showButton1.innerHTML = '<i class="bi bi-eye"></i>';
                    passwordVisible = false;
                } else {
                    cpasswordInput.type = "text";
                    showButton1.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    passwordVisible = true;
                }
            });
            cpasswordInput.addEventListener("blur", function() {
                if (passwordInput.value !== cpasswordInput.value) {
                    errSms.textContent = ': Password not matched';
                    errSms.style.color = 'red';
                    errSms.style.fontSize = '16px';
                    casswordInput.focus();
                } else {
                    errSms.textContent = '';
                }
            });

        });
    </script>
</body>

</html>