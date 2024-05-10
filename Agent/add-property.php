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
                                <form action="code/add_property_code.php" class="p-3" method="POST" enctype="multipart/form-data">
                                    <div class="form-row row">
                                        <div class="form-group col-md-6">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="property_type">Property Type:</label>
                                            <select class="form-control" id="property_type" name="prop_name" required>
                                                <option hidden>Select Property Type</option>
                                                <?php
                                                $propSel = "SELECT * from property_types";
                                                $proQuery = mysqli_query($con, $propSel);
                                                if (mysqli_num_rows($proQuery) > 0) {
                                                    while ($data = mysqli_fetch_assoc($proQuery)) {
                                                ?>
                                                        <option value="<?= $data['prop_name']; ?>"><?= $data['prop_name']; ?></option>
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
                                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="description">Amenities:</label>
                                            <textarea class="form-control" id="amenities" name="amenities" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-md-6">
                                            <label for="price">Price:</label>
                                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="location">Location:</label>
                                            <input type="text" class="form-control" id="location" name="location" required>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-md-4">
                                            <label for="city">City:</label>
                                            <input type="text" class="form-control" id="city" name="city" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="state">State:</label>
                                            <input type="text" class="form-control" id="state" name="state" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="zip_code">Country:</label>
                                            <input type="text" class="form-control" id="zip_code" name="country" required>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="zip_code">ZIP Code:</label>
                                            <input type="text" class="form-control" maxlength="6" id="zip_code" name="zip_code" required>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-md-4">
                                            <label for="bedrooms">Bedrooms:</label>
                                            <input type="number" class="form-control" id="bedrooms" name="bedrooms">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bathrooms">Bathrooms:</label>
                                            <input type="number" class="form-control" id="bathrooms" name="bathrooms">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="area">Area (sq ft):</label>
                                            <input type="number" class="form-control" id="area" name="area" step="0.001">
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-md-12">
                                            <label for="status">Status:</label>
                                            <select class="form-control" id="availability" name="availability">
                                                <option hidden>Select Status of rooms</option>
                                                <option value="available">Available</option>
                                                <option value="sold">Sold</option>
                                                <option value="under contract">Under Contract</option>
                                                <option value="off-market">Off Market</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-md-6">
                                            <label for="owner_name">Owner Name:</label>
                                            <input type="text" class="form-control" id="owner_name" name="owner_name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="owner_contact">Owner Contact:</label>
                                            <input type="text" class="form-control" id="owner_contact" name="owner_contact">
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit" name="addProp" />
                                </form>
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