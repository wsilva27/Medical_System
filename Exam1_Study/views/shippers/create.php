<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "create";
            $message = [];
            $shipperName = "";
            $phone = "";

            include_once "../../nav.php";
            include '../../confi/database.php';
        
            if ($_POST) {
                try {
                    $query = "INSERT INTO Shippers 
                              SET ShipperName = :ShipperName, Phone = :Phone";
                    $stmt = $con->prepare($query);

                    // posted values
                    $shipperName = htmlspecialchars(strip_tags($_POST['shipperName']));
                    $phone = htmlspecialchars(strip_tags($_POST['phone']));

                    $stmt->bindParam(':ShipperName', $shipperName);
                    $stmt->bindParam(':Phone', $phone);

                    if ($stmt->execute())
                        $message = (object)['type' => 'alert-success', 'desc' => 'Record was saved.'];
                    else
                        $message = (object)['type' => 'alert-danger', 'desc' => 'Unable to save record.'];
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            include_once "./breadcrumb.php.inc";
        ?> 
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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
