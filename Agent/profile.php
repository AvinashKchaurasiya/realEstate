<?php
session_start();
require('../database/connection.php');
if (isset($_SESSION['name']) and isset($_SESSION['email'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php require('cssLink.php'); ?>

        <style>
            .custom-file-upload {
                display: inline-block;
                border-radius: 5px;
                padding-left: 1.3rem;
                cursor: pointer;
                font-weight: bold;
            }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.2.0/mdb.min.js"></script>
    </head>

    <body>
        <?php
        require('includes/header.php');
        ?>
        <main style="margin-top: 90px">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php
                        if (isset($_POST['save'])) {
                            $email = $_SESSION['email'];
                            $image = $_FILES['profile']['name'];
                            $tempname = $_FILES["profile"]["tmp_name"];
                            $path = "Images/profiles/";
                            $allowTypes = array('jpg', 'png', 'jpeg');
                            $currentTime = date('YmdHis');
                            $fileName = $currentTime . '-' . basename($_FILES['profile']['name']);
                            $targetFilePath = $path . $fileName;
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                            if (in_array($fileType, $allowTypes)) {
                                if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFilePath)) {
                                    $update = "UPDATE register_a_u SET image='$fileName' where email='$email'";
                                    $query = mysqli_query($con, $update);
                                    if ($query) {
                        ?>
                                        <span class="text-success">Profile added</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger">Profile not added</span>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <span class="text-danger">Profile not moved in folder</span>
                                <?php
                                }
                            } else {
                                ?>
                                <span class="text-danger">Profile type not allowed</span>
                        <?php
                            }
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header">
                                    <?php
                                    $email = $_SESSION['email'];
                                    $sel = "SELECT * FROM register_a_u where email = '$email'";
                                    $query = mysqli_query($con, $sel);
                                    if ($query) {
                                        $row = mysqli_fetch_assoc($query);
                                    ?>
                                        <img src="Images/profiles/<?= $row['image']; ?>" class="card-img-top img-fluid" style="width:100vw; height:30vh; border-radius:50%;" alt="" id="previewImage" />
                                    <?php
                                    }
                                    ?>
                                    <label for="profile" class="custom-file-upload pt-2">
                                        <i class="fas fa-upload"></i> Choose Profile Picture
                                    </label>
                                    <input type="file" name="profile" id="profile" style="display: none;">
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-light list-group-small mb-3">
                                        <li class="list-group-item px-3">Name : <?= $_SESSION['name']; ?></li>
                                        <li class="list-group-item px-3">Email : <?= $_SESSION['email']; ?></li>
                                        <li class="list-group-item px-3">Number : <?= $row['number']; ?></li>
                                    </ul>
                                    <input type="submit" class="btn btn-success btn-sm w-100" name="save" value="Save" id="save" />
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-9">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Update Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-header">
                                    <span id="sms"></span>
                                </div>
                                <?php
                                $email = $_SESSION['email'];
                                $select = "SELECT * FROM register_a_u where email='$email'";
                                $query = mysqli_query($con, $select);
                                if ($query) {
                                    $data = mysqli_fetch_assoc($query);
                                ?>

                                    <div class="card-body">
                                        <form action="code/profile/update_profile.php" method="post">
                                            <input type="hidden" name="id" value="<?= $data['id']; ?>" />
                                            <label class="mb-2">Name</label>
                                            <input type="text" class="form-control mb-3" name="name" value="<?= $data['name']; ?>" required />
                                            <lebel class="mb-2">Email</lebel>
                                            <input type="email" class="form-control mb-3" name="email" value="<?= $data['email']; ?>" required />
                                            <lebel class="mb-2">Mobile Number : <span id="nsms"></span></lebel>
                                            <input type="text" maxlength="10" class="form-control mb-3" name="number" id="number" onkeyup="return validateNumber()" value="<?= $data['number']; ?>" required />
                                            <input type="submit" class="btn btn-success" value="Save" name="saves" />
                                        </form>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="card">
                                <div class="card-header">
                                    <span id="sms-pass"></span>
                                </div>

                                <div class="card-body">
                                    <form id="change_pass" action="code/profile/change-password.php" method="post">
                                        <label class="mb-2">Email</label>
                                        <input type="email" class="form-control mb-3" id="email" name="email" value="" required />
                                        <lebel class="mb-2">New Password</lebel>
                                        <input type="password" class="form-control mb-3" id="npassword" name="npassword" value="" required />
                                        <lebel class="mb-2">Confirm Password</lebel>
                                        <input type="password" class="form-control mb-3" id="cpassword" name="cpassword" value="" required />
                                        <input type="submit" class="btn btn-success" value="Change Password" id="change" name="chanage" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </main>
        <?php
        require('jsLink.php');
        ?>
        <script>
            // profile image
            document.getElementById('profile').addEventListener('change', function() {
                var file = this.files[0];
                var img = document.getElementById('previewImage');
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(file);
            });

            // number validation
            function validateNumber() {
                let number = document.getElementById('number').value;
                let sms = document.getElementById('nsms');
                let numberRex = /^[6-9]\d{9}$/;
                if (numberRex.test(number)) {
                    sms.textContent = "";
                    return true;
                } else {
                    sms.textContent = "Enter your valid mobile number";
                    sms.style.color = "red";
                    return false;
                }
            }

            // change password
            $(document).ready(function() {
                $('#change').click(function(e) {
                    e.preventDefault();
                    var formData = $('#change_pass').serialize();

                    $.ajax({
                        type: 'POST',
                        url: 'code/profile/change-password.php',
                        data: formData,
                        success: function(response) {
                            $('#sms-pass')
                                .html(response)
                                .css('color', 'green');
                            $('#change_pass')[0].reset();
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
<?php
} else {
    header('Location:index');
}
?>