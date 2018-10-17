<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "read";
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
            include_once "../../nav.php";
            include '../../confi/database.php';

            try {
                $query = "SELECT SupplierID, SupplierName, ContactName, Address, City, PostalCode, Country, Phone FROM Suppliers WHERE SupplierID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //mapping each data into variable
                $supplierName = utf8_encode($row['SupplierName']);
                $contactName = utf8_encode($row['ContactName']);
                $address = utf8_encode($row['Address']);
                $city = utf8_encode($row['City']);
                $postalCode = utf8_encode($row['PostalCode']);
                $country = utf8_encode($row['Country']);
                $phone = $row['Phone'];
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }

            include_once "./breadcrumb.php.inc";
        ?> 
        <div class="offset-md-5 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="supplierName">Supplier Name</label>
                    <input type="text" name="supplierName" class="form-control" value="<?php echo $supplierName ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="contactName">Contact Name</label>
                    <input type="text" name="contactName" class="form-control" value="<?php echo $contactName ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $address ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" value="<?php echo $city ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="postalCode">PostalCode</label>
                    <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="country">Country</label>
                    <input type="text" name="country" class="form-control" value="<?php echo $country ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control" value="<?php echo $phone ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="btn btn-outline-secondary btn-sm" href="./index.php">List</a>
                </div>
            </div>
        </div>
        <?php include_once "../../bottom.php"; ?>
    </body>
</html>