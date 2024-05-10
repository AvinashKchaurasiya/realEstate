<?php
session_start();
if (isset($_GET['email'])) {
    $email = $_GET['email'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php require_once('cssLink.php'); ?>
    </head>

    <body>
        <div class="container-fluid">
            <?php include('includes/header2.php') ?>
            <div class="row mt-5">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header" style="font-weight:bold;">Reset Password</div>
                        <div class="row m-5 g-0">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <span id="msms"></span>
                                    <form id="reset_form" method="post">
                                        <label class="mb-2">Email</label>
                                        <input class="form-control mb-3" value="<?= $email; ?>" type="email" id="email" name="email" placeholder="Enter Your Registered mail address" required />
                                        <label class="mb-2">New Password</label>
                                        <input class="form-control mb-3" type="password" id="password" name="password" placeholder="Enter New Password" required />
                                        <label class="mb-2">Confirm Password : <span id="pass_sms"></span></label>
                                        <input class="form-control mb-3" type="password" id="cpassword" name="cpassword" placeholder="Enter Password Again" required onkeyup="return checkPassword()" />
                                        <input id="reset_btn" type="submit" class="btn btn-success" value="Reset Password" />
                                        <button id="spinner_btn" class="btn btn-primary" type="button" style="display: none;" disabled>
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <span role="status">Reseting...</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <?php require_once('includes/footer.php'); ?>
        </div>
        <?php require_once('jsLink.php') ?>
        <script>
            function checkPassword() {
                let password = document.getElementById('password').value;
                let cpassword = document.getElementById('cpassword').value;
                let sms = document.getElementById('pass_sms');
                if (password === cpassword) {
                    sms.textContent = "Passwords are Matched";
                    sms.style.color = "green";
                    return true;
                } else {
                    sms.textContent = "Password and Confirm Password Not Matched";
                    sms.style.color = "red";
                    return false;
                }
            }
            $(document).on('submit', '#reset_form', function(e) {
                e.preventDefault();
                $('#reset_btn').hide();
                $('#spinner_btn').show();
                $.ajax({
                    method: "POST",
                    url: "code/reset-password-code.php",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data == 'sent') {
                            $('#reset_btn').show();
                            $('#spinner_btn').hide();
                            document.getElementById('msms').innerHTML = 'Password successfully reseted and send to you registerd email';
                            document.getElementById('msms').style.color = 'green';
                        } else if (data == 'n_sent') {
                            $('#reset_btn').show();
                            $('#spinner_btn').hide();
                            document.getElementById('msms').innerHTML = 'Somthing Error';
                            document.getElementById('msms').style.color = 'red';
                        } else {
                            $('#reset_btn').show();
                            $('#spinner_btn').hide();
                            document.getElementById('msms').innerHTML = data;
                            document.getElementById('msms').style.color = 'red';
                        }
                    }
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    echo "<script>alert('Invalid Request');
    window.location.href='login';
    </script>";
}
?>