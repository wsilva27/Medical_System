<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "update";
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
            $message = [];
            include_once "../../nav.php";
            include_once '../../confi/database.php';
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

            if ($_POST) {
                try {
                    $query = "UPDATE Customers 
                              SET CustomerName = :CustomerName, ContactName = :ContactName, Address = :Address, City = :City, PostalCode = :PostalCode, Country = :Country
                              WHERE CustomerID = :CustomerID";
                    $stmt = $con->prepare($query);

                    // posted values
                    $customerName = htmlspecialchars(strip_tags($_POST['customerName']));
                    $contactName = htmlspecialchars(strip_tags($_POST['contactName']));
                    $address = htmlspecialchars(strip_tags($_POST['address']));
                    $city = htmlspecialchars(strip_tags($_POST['city']));
                    $postalCode = htmlspecialchars(strip_tags($_POST['postalCode']));
                    $country = htmlspecialchars(strip_tags($_POST['country']));

                    $stmt->bindParam(':CustomerName', $customerName);
                    $stmt->bindParam(':ContactName', $contactName);
                    $stmt->bindParam(':Address', $address);
                    $stmt->bindParam(':City', $city);
                    $stmt->bindParam(':PostalCode', $postalCode);
                    $stmt->bindParam(':Country', $country);
                    $stmt->bindParam(':CustomerID', $id);

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
                        <label for="customerName">Customer Name</label>
                        <input type="text" name="customerName" class="form-control" value="<?php echo $customerName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="contactName">Contact Name</label>
                        <input type="text" name="contactName" class="form-control" value="<?php echo $contactName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" value="<?php echo $city ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="postalCode">Zip</label>
                        <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" value="<?php echo $country ?>" />
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