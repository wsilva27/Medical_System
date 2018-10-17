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

            include_once "./breadcrumb.php.inc";
        ?> 
        <div class="offset-md-5 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="productName">Product Name</label>
                    <input type="text" name="productName" class="form-control" value="<?php echo $productName ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="supplierID">Supplier</label>
                    <select name="supplierID" class="form-control" disabled>
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
                    <select name="categoryID" class="form-control" disabled>
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
                    <input type="text" name="unit" class="form-control" value="<?php echo $unit ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" value="<?php echo number_format($price, 2, '.', ',') ?>" disabled />
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