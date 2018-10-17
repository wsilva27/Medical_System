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
                $query = "SELECT ProductID, ProductName, SupplierID, CategoryID, Unit, Price FROM Products WHERE ProductID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //mapping each data into variable
                $productName = utf8_encode($row['ProductName']);
                $supplierID = utf8_encode($row['SupplierID']);
                $categoryID = utf8_encode($row['CategoryID']);
                $unit = utf8_encode($row['Unit']);
                $price = utf8_encode($row['Price']);
                
                $query = "SELECT SupplierID, SupplierName FROM Suppliers ORDER BY SupplierName ASC";
                $stmt_suppliers = $con->prepare($query);
                $stmt_suppliers->execute();

                $query = "SELECT CategoryID, CategoryName FROM Categories ORDER BY CategoryName ASC";
                $stmt_categories = $con->prepare($query);
                $stmt_categories->execute();
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }              

            if ($_POST) {
                try {
                    $query = "UPDATE Products 
                              SET ProductName = :ProductName, SupplierID = :SupplierID, CategoryID = :CategoryID, Unit = :Unit, Price = :Price
                              WHERE ProductID = :ProductID";
                    $stmt = $con->prepare($query);

                    // posted values
                    $productName = htmlspecialchars(strip_tags($_POST['productName']));
                    $supplierID = htmlspecialchars(strip_tags($_POST['supplierID']));
                    $categoryID = htmlspecialchars(strip_tags($_POST['categoryID']));
                    $unit = htmlspecialchars(strip_tags($_POST['unit']));
                    $price = htmlspecialchars(strip_tags($_POST['price']));

                    $stmt->bindParam(':ProductName', $productName);
                    $stmt->bindParam(':SupplierID', $supplierID);
                    $stmt->bindParam(':CategoryID', $categoryID);
                    $stmt->bindParam(':Unit', $unit);
                    $stmt->bindParam(':Price', $price);
                    $stmt->bindParam(':ProductID', $id);

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
                        <label for="productName">Product Name</label>
                        <input type="text" name="productName" class="form-control" value="<?php echo $productName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="supplierID">Supplier</label>
                        <select name="supplierID" class="form-control">
                            <?php
                                while($row = $stmt_suppliers->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    echo "<option value='{$SupplierID}'".($supplierID == $SupplierID ? 'selected' : '').">".utf8_encode($SupplierName)."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="categoryID">Category</label>
                        <select name="categoryID" class="form-control">
                            <?php
                                while($row = $stmt_categories->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    echo "<option value='{$CategoryID}'".($categoryID == $CategoryID ? 'selected' : '').">".utf8_encode($CategoryName)."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="unit">Unit</label>
                        <input type="text" name="unit" class="form-control" value="<?php echo $unit ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" value="<?php echo number_format($price, 2, '.', ',') ?>" />
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