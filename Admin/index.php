<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require('cssLink.php');
    ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card mb-3 p-5 rounded" style="box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;">
                    <div class="row g-0  justify-content-center align-items-center">
                        <div class="col-md-4">
                            <img src="Images/icon/admin-login.png" alt="Admin Login" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-8">
                            <?php
                            if (isset($_SESSION['sms'])) {
                                if ($_SESSION['sms'] === '1') {
                            ?>
                                    <span class="text-danger">Incorrect Password...</span>
                                <?php
                                    unset($_SESSION['sms']);
                                } else if ($_SESSION['sms'] === '2') {
                                ?>
                                    <span class="text-danger">Invalid Email Address...</span>
                            <?php
                                    unset($_SESSION['sms']);
                                }
                            }
                            ?>
                            <div class="card-body">
                                <form action="auth/login_proccess.php" method="post">
                                    <label class="mb-2">Email</label>
                                    <input type="email" class="form-control mb-3" name="email" placeholder="Enter your email address..." require />
                                    <label class="mb-2">Password</label>
                                    <input type="password" class="form-control mb-4" name="password" placeholder="Enter your password..." required />
                                    <input type="submit" class="btn btn-block" name="login" value="Login" style="background-color: #00B98E; color:white; font-size:16px;" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</body>

</html>