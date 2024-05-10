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
                <div class="row ">
                    <div class="col-sm-12">
                        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3>Add Property</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $sel = "SELECT A.*,B.prop_name FROM properties A,property_types B where A.prop_id = B.prop_id";
                                    $query = mysqli_query($con, $sel);
                                    if (mysqli_num_rows($query) > 0) {
                                        $row = mysqli_fetch_assoc($query);
                                ?>
                                        <form action="code/properties/update_prop_code.php" class="p-3" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $id; ?>" />
                                            <div class="form-row row">
                                                <div class="form-group col-md-6">
                                                    <label for="title">Title:</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="<?= $row['title']; ?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="property_type">Property Type:</label>
                                                    <select class="form-control" id="property_type" name="prop_t_id" required>
                                                        <option value="<?= $row['prop_id']; ?>" hidden><?= $row['prop_name']; ?></option>
                                                        <?php
                                                        $propSel = "SELECT * from property_types";
                                                        $proQuery = mysqli_query($con, $propSel);
                                                        if (mysqli_num_rows($proQuery) > 0) {
                                                            while ($data = mysqli_fetch_assoc($proQuery)) {
                                                        ?>
                                                                <option value="<?= $data['prop_id']; ?>"><?= $data['prop_name']; ?></option>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option class="text-danger">Not a single property_type available.</option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-sm-6">
                                                    <label for="description">Description:</label>
                                                    <textarea class="form-control" id="description" name="description" rows="3" required>
                                                        <?= $row['description']; ?>
                                                    </textarea>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="description">Amenities:</label>
                                                    <textarea class="form-control" id="amenities" name="amenities" rows="3" required>
                                                        <?= $row['amenities']; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-md-6">
                                                    <label for="price">Price:</label>
                                                    <input type="number" class="form-control" id="price" name="price" value="<?= $row['price']; ?>" step="0.01" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="location">Location:</label>
                                                    <input type="text" class="form-control" id="location" name="location" value="<?= $row['location']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-md-4">
                                                    <label for="city">City:</label>
                                                    <input type="text" class="form-control" id="city" name="city" value="<?= $row['city']; ?>" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="state">State:</label>
                                                    <input type="text" class="form-control" id="state" name="state" value="<?= $row['state']; ?>" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="zip_code">Country:</label>
                                                    <input type="text" class="form-control" id="zip_code" name="country" value="<?= $row['country']; ?>" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="zip_code">ZIP Code:</label>
                                                    <input type="number" class="form-control" maxlength="6" id="zip_code" name="zip_code" value="<?= $row['zip_code'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-md-4">
                                                    <label for="bedrooms">Bedrooms:</label>
                                                    <input type="number" value="<?= $row['bedrooms'] ?>" class="form-control" id="bedrooms" name="bedrooms">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="bathrooms">Bathrooms:</label>
                                                    <input type="number" value="<?= $row['bathrooms'] ?>" class="form-control" id="bathrooms" name="bathrooms">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="area">Area (sq ft):</label>
                                                    <input type="number" value="<?= $row['area'] ?>" class="form-control" id="area" name="area" step="0.001">
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-md-12">
                                                    <label for="status">Status:</label>
                                                    <select class="form-control" id="availability" name="availability">
                                                        <option value="<?= $row['availability']; ?>" hidden><?= $row['availability']; ?></option>
                                                        <option value="Available">Available</option>
                                                        <option value="Sold">Sold</option>
                                                        <option value="Under contract">Under Contract</option>
                                                        <option value="Off-market">Off Market</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-md-6">
                                                    <label for="owner_name">Owner Name:</label>
                                                    <input type="text" value="<?= $row['owner_name']; ?>" class="form-control" id="owner_name" name="owner_name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="owner_contact">Owner Contact:</label>
                                                    <input type="number" value="<?= $row['owner_contact']; ?>" maxlength="10" class="form-control" id="owner_contact" name="owner_contact">
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Submit" name="update" />
                                        </form>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <a href="properties" class="btn btn-primary btn-sm text-center w-100">Click Here</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer></footer>
        <?php
        require('jsLink.php');
        ?>
    </body>

    </html>
<?php
} else {
    header('Location:index');
}
?>