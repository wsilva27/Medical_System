<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "update";
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
            $message = [];
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

            if ($_POST) {
                try {
                    $query = "UPDATE Suppliers 
                              SET SupplierName = :SupplierName, ContactName = :ContactName, Address = :Address, City = :City, PostalCode = :PostalCode, Country = :Country, Phone = :Phone
                              WHERE SupplierID = :SupplierID";
                    $stmt = $con->prepare($query);

                    // posted values
                    $supplierName = htmlspecialchars(strip_tags($_POST['supplierName']));
                    $contactName = htmlspecialchars(strip_tags($_POST['contactName']));
                    $address = htmlspecialchars(strip_tags($_POST['address']));
                    $city = htmlspecialchars(strip_tags($_POST['city']));
                    $postalCode = htmlspecialchars(strip_tags($_POST['postalCode']));
                    $country = htmlspecialchars(strip_tags($_POST['country']));
                    $phone = htmlspecialchars(strip_tags($_POST['phone']));

                    $stmt->bindParam(':SupplierName', $supplierName);
                    $stmt->bindParam(':ContactName', $contactName);
                    $stmt->bindParam(':Address', $address);
                    $stmt->bindParam(':City', $city);
                    $stmt->bindParam(':PostalCode', $postalCode);
                    $stmt->bindParam(':Country', $country);
                    $stmt->bindParam(':Phone', $phone);
                    $stmt->bindParam(':SupplierID', $id);

                    if ($stmt->execute())
                        $message = (object)['type' => 'alert-success', 'desc' => 'Record was updated.'];
                    else
                        $message = (object)['type' => 'alert-danger', 'desc' => 'Unable to update record. Please try again.'];
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
          
            include_once "./breadcrumb.php.inc";
        ?> 
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?id='.$id); ?>" method="post">
            <div class="offset-md-5 col-md-4">
                <?php
                    if($message != null)
                        echo "<div class='alert {$message->type}'>{$message->desc}</div>";
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <label for="supplierName">Supplier Name</label>
                        <input type="text" name="supplierName" class="form-control" value="<?php echo $supplierName ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="contactName">Contact Name</label>
                        <input type="text" name="contactName" class="form-control" value="<?php echo $contactName ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" value="<?php echo $city ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="postalCode">PostalCode</label>
                        <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" value="<?php echo $country ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $phone ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="submit" value="Submit" class="btn btn-outline-secondary btn-sm" />
                        <a class="btn btn-outline-secondary btn-sm" href="./index.php">List</a>
                    </div>
                </div>
            </div>
        </form>
        <?php include_once "../../bottom.php"; ?>
    </body>
</html>