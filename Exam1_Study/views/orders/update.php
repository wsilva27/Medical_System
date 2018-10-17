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
                                 e.EmployeeID, 
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
                $employeeID = utf8_encode($row['EmployeeID']);
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
                
                //employee information
                $query = "select 
                            EmployeeID, CONCAT(FirstName, ' ', LastName) AS EmployeeName 
                          from Employees order by EmployeeName desc";
                $stmt_employee = $con->prepare($query);
                $stmt_employee->execute();
                
                //customer information
                $query = "select 
                            CustomerID, CustomerName, ContactName, Address,City,PostalCode,Country 
                          from Customers order by CustomerID desc";
                $stmt_customer = $con->prepare($query);
                $stmt_customer->execute();
                $num_customer = $stmt_customer->rowCount();
                
                //shipper information
                $query = "select 
                            ShipperID, ShipperName, Phone
                          from Shippers order by ShipperID desc";
                $stmt_shipper = $con->prepare($query);
                $stmt_shipper->execute();
                $num_shipper = $stmt_shipper->rowCount();   
                
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
                            <input type="date" name="orderDate" class="form-control" value="<?php echo $orderDate ?>" />
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
                            <select name="employeeID" class="form-control">
                                <?php
                                    while($row = $stmt_employee->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        echo "<option value='{$EmployeeID}'".($employeeID == $EmployeeID ? 'selected' : '').">".utf8_encode($EmployeeName)."</option>";
                                    }    
                                ?>
                            </select>
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
                            <div class="input-group">
                                <input type="text" name="customerName" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" disabled value="<?php echo $customerName ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalCustomerInfo"><i class="material-icons">search</i></button>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <label for="contactName">Contact Name</label>
                            <input type="text" name="contactName" class="form-control" value="<?php echo $contactName ?>" disabled />
                            <input type="text" name="customerID" hidden />
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
                            <div class="input-group">
                                <input type="text" name="shipperName" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" disabled value="<?php echo $shipperName ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalShipperInfo"><i class="material-icons">search</i></button>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <label for="shipperPhone">Shipper Phone</label>
                            <input type="text" name="shipperPhone" class="form-control" value="<?php echo $shipperPhone ?>" disabled />
                            <input type="text" name="shipperID" hidden />
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
//                        echo "<a href='read.php?id={$OrderDetailID}' class='btn-img-info'><i class='material-icons btn' title='view'>dvr</i></a>";
//                        echo "<a href='update.php?id={$OrderDetailID}' class='btn-img-info'><i class='material-icons btn' title='update'>edit</i></a>";
//                        echo "<a href='#' onclick='delete_order({$OrderDetailID});' class='btn-img-info'><i class='material-icons btn' title='delete'>delete</i></a>";
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
        
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modalCustomerInfo" tabindex="-1" role="dialog" aria-labelledby="modalCustomerInfo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCustomerInfoTitle">Select Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                            if($num_customer > 0){
                                echo "<table class='table table-hover table-striped table-bordered'>";
                                echo "<thead class='thead-dark'>";
                                echo "<tr>";
                                echo "<th>Customer Name</th>";
                                echo "<th>Contact Name</th>";
                                echo "<th>Address</th>";
                                echo "<th>City</th>";
                                echo "<th>PostalCode</th>";
                                echo "<th>Country</th>";
                                echo "<th>Select</th>";
                                echo "</thead>";
                                echo "</tr>";
                                echo "<tbody>";
                                while($row = $stmt_customer->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    echo "<tr>";
                                    echo "<td>".utf8_encode($CustomerName)."</td>";
                                    echo "<td>".utf8_encode($ContactName)."</td>";
                                    echo "<td>".utf8_encode($Address)."</td>";
                                    echo "<td>".utf8_encode($City)."</td>";
                                    echo "<td>".utf8_encode($PostalCode)."</td>";
                                    echo "<td>".utf8_encode($Country)."</td>";
                                    echo "<td>";
                                    echo "<a href='javascript:selectCustomer(\"".$CustomerID."\", \"".utf8_encode($CustomerName)."\", \"".utf8_encode($ContactName)."\", \"".utf8_encode($Address)."\", \"".utf8_encode($City)."\", \"".utf8_encode($PostalCode)."\", \"".utf8_encode($Country)."\");' class='btn-img-info'><i class='material-icons btn' title='select'>check_box_outline_blank</i></a>";
                                    echo "</td>";
                                    echo "</tr>";                        
                                }
                                echo "</tbody>";
                                echo "</table>";
                            }else{
                                echo "<div class='alert alert-danger'>No records found.</div>";
                            }            
                        ?>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>  
        
        <!-- Modal -->
        <div class="modal fade" id="modalShipperInfo" tabindex="-1" role="dialog" aria-labelledby="modalShipperInfo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalShipperInfoTitle">Select Shipper</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                            if($num_shipper > 0){
                                echo "<table class='table table-hover table-striped table-bordered'>";
                                echo "<thead class='thead-dark'>";
                                echo "<tr>";
                                echo "<th>Shipper Name</th>";
                                echo "<th>Phone</th>";
                                echo "<th>Select</th>";
                                echo "</thead>";
                                echo "</tr>";
                                echo "<tbody>";
                                while($row = $stmt_shipper->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    echo "<tr>";
                                    echo "<td>".utf8_encode($ShipperName)."</td>";
                                    echo "<td>".utf8_encode($Phone)."</td>";
                                    echo "<td>";
                                    echo "<a href='javascript:selectShipper(\"".$ShipperID."\", \"".utf8_encode($ShipperName)."\", \"".utf8_encode($Phone)."\");' class='btn-img-info'><i class='material-icons btn' title='select'>check_box_outline_blank</i></a>";
                                    echo "</td>";
                                    echo "</tr>";                        
                                }
                                echo "</tbody>";
                                echo "</table>";
                            }else{
                                echo "<div class='alert alert-danger'>No records found.</div>";
                            }            
                        ?>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>        
             
        <script>
            function selectCustomer(customerID, customerName, contactName, address, city, postalCode, country){
                document.getElementsByName('customerID')[0].value = customerID;
                document.getElementsByName('customerName')[0].value = customerName;
                document.getElementsByName('contactName')[0].value = contactName;
                document.getElementsByName('address')[0].value = address;
                document.getElementsByName('city')[0].value = city;
                document.getElementsByName('postalCode')[0].value = postalCode;
                document.getElementsByName('country')[0].value = country;
                $('#modalCustomerInfo').modal('hide')
            }

            function selectShipper(shipperID, shipperName, shipperPhone){
                document.getElementsByName('shipperID')[0].value = shipperID;
                document.getElementsByName('shipperName')[0].value = shipperName;
                document.getElementsByName('shipperPhone')[0].value = shipperPhone;
                $('#modalShipperInfo').modal('hide');
            }
        </script>
        
    </body>
</html>