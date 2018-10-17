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
                $query = "SELECT ShipperID, ShipperName, Phone FROM Shippers WHERE ShipperID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //mapping each data into variable
                $shipperName = utf8_encode($row['ShipperName']);
                $phone = $row['Phone'];
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }

            include_once "./breadcrumb.php.inc";
        ?> 
        <div class="offset-md-5 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="shipperName">Shipper Name</label>
                    <input type="text" name="shipperName" class="form-control" value="<?php echo $shipperName ?>" disabled />
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