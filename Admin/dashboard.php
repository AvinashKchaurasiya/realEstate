<?php
session_start();
require('../database/connection.php');
if (isset($_SESSION['name']) and isset($_SESSION['email'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    require('cssLink.php');
    ?>
  </head>

  <body>
    <?php
    require('includes/header.php');
    ?>
    <main style="margin-top: 90px">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $sel = "SELECT * from register_a_u where user_type='user'";
                $count = mysqli_num_rows(mysqli_query($con, $sel));
                ?>
                <h3><?= $count ?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="bi bi-people-fill"></i>
              </div>
              <a href="user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $sel = "SELECT * from register_a_u where user_type='agent'";
                $count = mysqli_num_rows(mysqli_query($con, $sel));
                ?>
                <h3><?= $count ?></h3>

                <p>Agents</p>
              </div>
              <div class="icon">
                <i class="bi bi-people-fill"></i>
              </div>
              <a href="agent.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                $sel = "SELECT * from properties";
                $count = mysqli_num_rows(mysqli_query($con, $sel));
                ?>
                <h3><?= $count ?></h3>
                <p>Properties</p>
              </div>
              <div class="icon">
                <i class="bi bi-houses-fill"></i>
              </div>
              <a href="properties.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $sel = "SELECT * from property_types";
                $count = mysqli_num_rows(mysqli_query($con, $sel));
                ?>
                <h3><?= $count ?></h3>
                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="bi bi-tags"></i>
              </div>
              <a href="property_type.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User Name</th>
                      <th>Image</th>
                      <th>Email</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sn = 1;
                    $sel = "SELECT * FROM register_a_u where user_type='user'";
                    $query = mysqli_query($con, $sel);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                          <td><?= $sn; ?></td>
                          <td><?= $row['name']; ?></td>
                          <td>
                            <?php
                            if ($row['image'] != NULL) {
                            ?>
                              <img src="../img/user/<?= $row['image']; ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                            <?php
                            } else {
                              echo "<span>No Image</span>";
                            }
                            ?>
                          </td>
                          <td><?= $row['email']; ?></td>
                          <td>
                            <?php
                            if ($row['number'] != null) {
                              echo $row['number'];
                            } else {
                            ?>
                              ---
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($row['isVerify'] == 1) {
                            ?>
                              <span class="btn-sm bg-success text-light">Verified</span>
                            <?php
                            } else {
                            ?>
                              <span class="btn-sm bg-danger text-light">Not Verified</span>
                            <?php
                            }
                            ?>
                          </td>
                        </tr>
                    <?php
                        $sn++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-sm-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Agents Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Agent Name</th>
                      <th>Image</th>
                      <th>Email</th>
                      <th>Number</th>
                      <th>Verified</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sn = 1;
                    $sel = "SELECT * FROM register_a_u where user_type='agent'";
                    $query = mysqli_query($con, $sel);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                          <td><?= $sn; ?></td>
                          <td><?= $row['name']; ?> </td>
                          <td>
                            <?php
                            if ($row['image'] != NULL) {
                            ?>
                              <img src="../Agent/Images/profiles/<?= $row['image']; ?>" alt="" style=" width: 45px; height: 45px" class="rounded-circle" />
                            <?php
                            } else {
                              echo "<span>No Image</span>";
                            }
                            ?>
                          </td>
                          <td><?= $row['email']; ?></td>
                          <td>
                            <?php
                            if ($row['number'] != null) {
                              echo $row['number'];
                            } else {
                            ?>
                              ---
                            <?php
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($row['isVerify'] == 1) {
                            ?>
                              <span class="btn-sm bg-success text-light">Verified</span>
                            <?php
                            } else {
                            ?>
                              <span class="btn-sm bg-danger text-light">Not Verified</span>
                            <?php
                            }
                            ?>
                          </td>
                        </tr>
                    <?php
                        $sn++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Properties Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Property Name</th>
                      <th>Price</th>
                      <th>Category</th>
                      <th>Owner Name</th>
                      <th>Owner Contact</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sn = 1;
                    $sel = "SELECT * FROM properties";
                    $query = mysqli_query($con, $sel);
                    if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                          <td><?= $sn; ?></td>
                          <td><?= $row['title']; ?></td>
                          <td><?= $row['price']; ?></td>
                          <td><?= $row['prop_name']; ?></td>
                          <td><?= $row['owner_name']; ?></td>
                          <td><?= $row['owner_contact']; ?></td>
                          <td>
                            <?php
                            if ($row['status'] == 1) {
                            ?>
                              <span class="btn-sm bg-success text-light">Approved</span>
                            <?php
                            } else if ($row['status'] == 0) {
                            ?>
                              <span class="btn-sm bg-warning text-light">Not Approved</span>
                            <?php
                            } else {
                            ?>
                              <span class="btn-sm bg-danger text-light">Rejected</span>
                            <?php
                            }
                            ?>
                          </td>
                        </tr>
                    <?php
                        $sn++;
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <?php
      require('includes/footer.php');
      require('jsLink.php');
      ?>

    </main>
  </body>

  </html>
<?php
} else {
  header('Location:index.php');
}
?>