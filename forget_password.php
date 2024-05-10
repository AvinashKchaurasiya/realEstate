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
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header" style="font-weight:bold;">Forget Password</div>
                    <div class="row m-5 g-0">
                        <div class="col-md-12">
                            <div class="card-body">
                                <span id="msms"></span>
                                <form id="forget_form" method="post">
                                    <label class="mb-2">Email</label>
                                    <input class="form-control mb-3" type="email" id="email" name="email" placeholder="Enter Your Registered mail address" required />
                                    <input id="reset_btn" type="submit" class="btn btn-success" value="Forgot Password" />
                                    <button id="spinner_btn" class="btn btn-primary" type="button" style="display: none;" disabled>
                                        <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <span role="status">Sending...</span>
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
        $(document).on('submit', '#forget_form', function(e) {
            e.preventDefault();
            $('#reset_btn').hide();
            $('#spinner_btn').show();
            $.ajax({
                method: "POST",
                url: "code/forget-password-code.php",
                data: $(this).serialize(),
                success: function(data) {
                    if (data == 'sent') {
                        $('#reset_btn').show();
                        $('#spinner_btn').hide();
                        document.getElementById('msms').innerHTML = 'Reset link sent on your regitered email address please check';
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