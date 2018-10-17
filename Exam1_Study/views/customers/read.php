<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "read";
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
            include_once "../../nav.php";
            include_once "../../confi/database.php";
            try {
                $query = "SELECT CustomerID, CustomerName, ContactName,Address,City,PostalCode,Country FROM Customers WHERE CustomerID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //mapping each data into variable
                $customerID = utf8_encode($row['CustomerID']);
                $customerName = utf8_encode($row['CustomerName']);
                $contactName = utf8_encode($row['ContactName']);
                $address = utf8_encode($row['Address']);
                $city = utf8_encode($row['City']);
                $postalCode = $row['PostalCode'];
                $country = $row['Country'];
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
            include_once "./breadcrumb.php.inc";
        ?> 
        <div class="offset-md-5 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="customerName">Customer Name</label>
                    <input type="text" id="customerName" class="form-control" value="<?php echo utf8_encode($customerName) ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="contactName">Contact Name</label>
                    <input type="text" id="contactName" class="form-control" value="<?php echo utf8_encode($contactName) ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" value="<?php echo utf8_encode($address) ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="city">City</label>
                    <input type="text" id="city" class="form-control" value="<?php echo utf8_encode($city) ?>" disabled />
                </div>
                <div class="col-md-6">
                    <label for="postalCode">Zip</label>
                    <input type="text" id="postalCode" class="form-control" value="<?php echo $postalCode ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="country">Country</label>
                    <input type="text" id="country" class="form-control" value="<?php echo $country ?>" disabled />
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