<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php 
            $currentPage = "index";
            include_once "../../nav.php";
            include_once "./breadcrumb.php.inc";
        ?>
        <div class="offset-md-2 col-md-10">
            <?php
                include "../../confi/database.php";
                $action = isset($_GET['action']) ? $_GET['action'] : "";
                if($action == 'deleted'){
                    echo "<div class='alert alert-success'>Record was deleted.</div>";
                }
                $query = "SELECT o.OrderID, c.CustomerName, CONCAT(e.FirstName, ' ', e.LastName) as EmployeeName, o.OrderDate, s.ShipperName, od.Qts, od.TotalPrice
                          FROM Orders o, Customers c, Employees e, Shippers s, 
                                (SELECT sod.OrderID, SUM(sod.Quantity) AS Qts, SUM(sod.Quantity * sp.Price) AS TotalPrice
                                    FROM Orderdetails sod, Products sp
                                    WHERE sod.ProductID = sp.ProductID
                                    GROUP BY sod.OrderID) od
                          WHERE o.CustomerID = c.CustomerID AND o.EmployeeID = e.EmployeeID AND o.ShipperID = s.ShipperID AND o.OrderID = od.OrderID";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                echo "<div class='row'>";
                echo "<div class='col-md-2' style='margin: 15px 0px 0px 0px;'>";
                echo "<h5><span class='badge badge-secondary'>Records: {$num}</span></h5>";
                echo "</div>";
                echo "<div class='col-md-10 text-right' style='margin: 10px 0px;'>";
                echo "<a href='./create.php' class='btn btn-outline-primary btn-sm'><i class='material-icons'>create</i> Add New Orders</a>";
                echo "</div>";
                echo "</div>";
            
                setlocale(LC_MONETARY, 'en_US');
            
                if($num > 0){
                    echo "<table class='table table-hover table-striped table-bordered'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";
                    echo "<th>Customer Name</th>";
                    echo "<th>Total Quantities</th>";
                    echo "<th>Total Price</th>";
                    echo "<th>Order Date</th>";
                    echo "<th>Employee Name</th>";
                    echo "<th>Shipper Name</th>";
                    echo "<th>Action</th>";
                    echo "</thead>";
                    echo "</tr>";
                    echo "<tbody>";
                                            
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        echo "<tr>";
                        echo "<td>".utf8_encode($CustomerName)."</td>";
                        echo "<td>".$Qts."</td>";
                        echo "<td>".number_format($TotalPrice, 2, '.', ',')."</td>";
                        echo "<td>".date_format(date_create($OrderDate), "M.d.Y")."</td>";
                        echo "<td>".utf8_encode($EmployeeName)."</td>";
                        echo "<td>".utf8_encode($ShipperName)."</td>";
                        echo "<td>";
                        echo "<a href='read.php?id={$OrderID}' class='btn-img-info'><i class='material-icons btn' title='view'>dvr</i></a>";
                        echo "<a href='update.php?id={$OrderID}' class='btn-img-info'><i class='material-icons btn' title='update'>edit</i></a>";
                        echo "<a href='#' onclick='delete_order({$OrderID});' class='btn-img-info'><i class='material-icons btn' title='delete'>delete</i></a>";
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
        <?php include_once "../../bottom.php"; ?>
        <script type="text/javascript">
            function delete_order(id){
                var answer = confirm('Are you sure?');
                if(answer){
                    window.location = 'delete.php?id=' + id;
                }
            }     
        </script>
    </body>
</html>