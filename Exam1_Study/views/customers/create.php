<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "create";
            $message = [];
            $customerName = "";
            $contactName = "";
            $address = "";
            $city = "";
            $postalCode = "";
            $country = "";
            include_once "../../nav.php";
            include '../../confi/database.php';
            include_once "./breadcrumb.php.inc";
            if ($_POST) {
                try {
                    $query = "INSERT INTO Customers 
                              SET CustomerName = :CustomerName, ContactName = :ContactName, Address = :Address, City = :City, PostalCode = :PostalCode, Country = :Country";
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

                    if ($stmt->execute())
                        $message = (object)['type' => 'alert-success', 'desc' => 'Record was saved.'];
                    else
                        $message = (object)['type' => 'alert-danger', 'desc' => 'Unable to save record.'];
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
        ?> 
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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
