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
                $query = "select 
                            p.ProductID, p.ProductName, s.SupplierName, c.CategoryName, p.Unit, p.Price
                          from Products p, Suppliers s, Categories c
                          where p.SupplierID = s.SupplierID and p.CategoryID = c.CategoryID
                          order by p.ProductID desc";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                echo "<div class='row'>";
                echo "<div class='col-md-2' style='margin: 15px 0px 0px 0px;'>";
                echo "<h5><span class='badge badge-secondary'>Records: {$num}</span></h5>";
                echo "</div>";
                echo "<div class='col-md-10 text-right' style='margin: 10px 0px;'>";
                echo "<a href='./create.php' class='btn btn-outline-primary btn-sm'><i class='material-icons'>create</i> Add New Product</a>";
                echo "</div>";
                echo "</div>";
            
                setlocale(LC_MONETARY, 'en_US');
            
                if($num > 0){
                    echo "<table class='table table-hover table-striped table-bordered'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";
                    echo "<th>Product Name</th>";
                    echo "<th>Supplier</th>";
                    echo "<th>Category</th>";
                    echo "<th>Unit</th>";
                    echo "<th>Price</th>";
                    echo "<th>Action</th>";
                    echo "</thead>";
                    echo "</tr>";
                    echo "<tbody>";
                                            
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        echo "<tr>";
                        echo "<td>".utf8_encode($ProductName)."</td>";
                        echo "<td>".utf8_encode($SupplierName)."</td>";
                        echo "<td>".utf8_encode($CategoryName)."</td>";
                        echo "<td>".$Unit."</td>";
                        echo "<td>".number_format($Price, 2, '.', ',')."</td>";
                        echo "<td>";
                        echo "<a href='read.php?id={$ProductID}' class='btn-img-info'><i class='material-icons btn' title='view'>dvr</i></a>";
                        echo "<a href='update.php?id={$ProductID}' class='btn-img-info'><i class='material-icons btn' title='update'>edit</i></a>";
                        echo "<a href='#' onclick='delete_user({$ProductID});' class='btn-img-info'><i class='material-icons btn' title='delete'>delete</i></a>";
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
            function delete_user(id){
                var answer = confirm('Are you sure?');
                if(answer){
                    window.location = 'delete.php?id=' + id;
                }
            }     
        </script>
    </body>
</html>