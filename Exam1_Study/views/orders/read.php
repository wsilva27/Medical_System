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
                $query = "SELECT c.CustomerName, c.ContactName, c.Address, c.City, c.PostalCode, c.Country,
                                 CONCAT(e.FirstName, ' ', e.LastName) as EmployeeName, 
                                 s.ShipperName, s.Phone AS ShipperPhone, 
                                 o.OrderDate, od.Qts, od.TotalPrice
                          FROM Orders o, Customers c, Employees e, Shippers s, 
                                (SELECT sod.OrderID, SUM(sod.Quantity) AS Qts, SUM(sod.Quantity * sp.Price) AS TotalPrice
                                    FROM Orderdetails sod, Products sp
                                    WHERE sod.ProductID = sp.ProductID
                                    GROUP BY sod.OrderID) od
                          WHERE o.CustomerID = c.CustomerID AND o.EmployeeID = e.EmployeeID AND o.ShipperID = s.ShipperID AND o.OrderID = od.OrderID AND o.OrderID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //Mapping
                $customerName = utf8_encode($row['CustomerName']);
                $contactName = utf8_encode($row['ContactName']);
                $address = utf8_encode($row['Address']);
                $city = utf8_encode($row['City']);
                $postalCode = $row['PostalCode'];
                $country = $row['Country'];                
                $employeeName = utf8_encode($row['EmployeeName']);
                $shipperName = utf8_encode($row['ShipperName']);
                $shipperPhone = $row['ShipperPhone'];
                $orderDate = $row['OrderDate'];                
                $qts = $row['Qts'];                
                $totalPrice = $row['TotalPrice']; 
                
                $query = "SELECT od.OrderDetailID, od.Quantity, p.ProductName, s.SupplierName, c.CategoryName, p.Unit, p.Price, (od.Quantity * p.Price) AS SubTotal
                          FROM Orderdetails od, Products p, Suppliers s, Categories c
                          WHERE od.ProductID = p.ProductID AND p.SupplierID = s.SupplierID AND p.CategoryID = c.CategoryID AND od.OrderID = ?";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $num = $stmt->rowCount();
                
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }

            include_once "./breadcrumb.php.inc";
        ?> 
        <div class="offset-md-2 col-md-10">
            <div class="card">
                <div class="card-header">
                    Order Information
                </div>
                <div class="card-body">
                    <div class="row order">
                        <div class="col-md-3">
                            <label for="orderDate">Order Date</label>
                            <input type="text" name="orderDate" class="form-control" value="<?php echo date_format(date_create($orderDate), "M.d.Y") ?>" disabled />
                        </div>
                        <div class="col-md-2">
                            <label for="qts">Total Quantities</label>
                            <input type="text" name="qts" class="form-control" value="<?php echo $qts ?>" disabled />
                        </div>
                        <div class="col-md-3">
                            <label for="totalPrice">Total Price</label>
                            <input type="text" name="totalPrice" class="form-control" value="<?php echo number_format($totalPrice, 2, '.', ',') ?>" disabled />
                        </div>
                        <div class="col-md-4">
                            <label for="employeeName">Employee Name</label>
                            <input type="text" name="employeeName" class="form-control" value="<?php echo $employeeName ?>" disabled />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Customer Information
                </div>
                <div class="card-body">
                    <div class="row order">
                        <div class="col-md-4">
                            <label for="customerName">Customer Name</label>
                            <input type="text" name="customerName" class="form-control" value="<?php echo $customerName ?>" disabled />
                        </div>
                        <div class="col-md-4">
                            <label for="contactName">Contact Name</label>
                            <input type="text" name="contactName" class="form-control" value="<?php echo $contactName ?>" disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address ?>" disabled />
                        </div>
                        <div class="col-md-3">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $city ?>" disabled />
                        </div>
                        <div class="col-md-2">
                            <label for="postalCode">PostalCode</label>
                            <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode ?>" disabled />
                        </div>
                        <div class="col-md-3">
                            <label for="country">Country</label>
                            <input type="text" name="country" class="form-control" value="<?php echo $country ?>" disabled />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Shipper Information
                </div>
                <div class="card-body">
                    <div class="row order">
                        <div class="col-md-4">
                            <label for="shipperName">Shipper Name</label>
                            <input type="text" name="shipperName" class="form-control" value="<?php echo $shipperName ?>" disabled />
                        </div>
                        <div class="col-md-4">
                            <label for="shipperPhone">Shipper Phone</label>
                            <input type="text" name="shipperPhone" class="form-control" value="<?php echo $shipperPhone ?>" disabled />
                        </div>
                    </div>
                </div>
            </div>       
            <?php
                if($num > 0){
                    echo "<table class='table table-hover table-striped table-bordered'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";
                    echo "<th>Product Name</th>";
                    echo "<th>Category Name</th>";
                    echo "<th>Supplier Name</th>";
                    echo "<th>Unit</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Unit Price</th>";
                    echo "<th>Sub Total</th>";
                    echo "<th>Action</th>";
                    echo "</thead>";
                    echo "</tr>";
                    echo "<tbody>";
                                            
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        echo "<tr>";
                        echo "<td>".utf8_encode($ProductName)."</td>";
                        echo "<td>".utf8_encode($CategoryName)."</td>";
                        echo "<td>".utf8_encode($SupplierName)."</td>";
                        echo "<td>".utf8_encode($Unit)."</td>";
                        echo "<td>".number_format($Quantity, 0, '.', ',')."</td>";
                        echo "<td>".number_format($Price, 2, '.', ',')."</td>";
                        echo "<td>".number_format($SubTotal, 2, '.', ',')."</td>";
                        echo "<td>";
                        echo "<i class='material-icons md-light md-inactive btn' title='view'>dvr</i>";
                        echo "<i class='material-icons md-light md-inactive btn' title='update'>edit</i>";
                        echo "<i class='material-icons md-light md-inactive btn' title='delete'>delete</i>";
                        echo "</td>";
                        echo "</tr>";                        
                    }
                    echo "</tbody>";
                    echo "</table>";
                }else{
                    echo "<div class='alert alert-danger'>No records found.</div>";
                }            
            ?>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a class="btn btn-outline-secondary btn-sm" href="./index.php">List</a>
                </div>
            </div>
        </div>
        <?php include_once "../../bottom.php"; ?>
    </body>
</html>