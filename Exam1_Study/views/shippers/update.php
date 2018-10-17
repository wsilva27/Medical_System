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

            if ($_POST) {
                try {
                    $query = "UPDATE Shippers 
                              SET ShipperName = :ShipperName, Phone = :Phone
                              WHERE ShipperID = :ShipperID";
                    $stmt = $con->prepare($query);

                    // posted values
                    $shipperName = htmlspecialchars(strip_tags($_POST['shipperName']));
                    $phone = htmlspecialchars(strip_tags($_POST['phone']));

                    $stmt->bindParam(':ShipperName', $shipperName);
                    $stmt->bindParam(':Phone', $phone);
                    $stmt->bindParam(':ShipperID', $id);

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
                        <label for="shipperName">Shipper Name</label>
                        <input type="text" name="shipperName" class="form-control" value="<?php echo $shipperName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" class="form-control" value="<?php echo $phone ?>" />
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