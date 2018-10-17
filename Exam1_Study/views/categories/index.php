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
                            CategoryID, CategoryName, Description
                          from Categories order by CategoryID desc";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                echo "<div class='row'>";
                echo "<div class='col-md-2' style='margin: 15px 0px 0px 0px;'>";
                echo "<h5><span class='badge badge-secondary'>Records: {$num}</span></h5>";
                echo "</div>";
                echo "<div class='col-md-10 text-right' style='margin: 10px 0px;'>";
                echo "<a href='./create.php' class='btn btn-outline-primary btn-sm'><i class='material-icons'>create</i> Add New Category</a>";
                echo "</div>";
                echo "</div>";
            
                if($num > 0){
                    echo "<table class='table table-hover table-striped table-bordered'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";
                    echo "<th>Category Name</th>";
                    echo "<th>Description</th>";
                    echo "<th>Action</th>";
                    echo "</thead>";
                    echo "</tr>";
                    echo "<tbody>";
                                            
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        echo "<tr>";
                        echo "<td>".utf8_encode($CategoryName)."</td>";
                        echo "<td><pre>".utf8_encode($Description)."</pre></td>";
                        echo "<td>";
                        echo "<a href='read.php?id={$CategoryID}' class='btn-img-info'><i class='material-icons btn' title='view'>dvr</i></a>";
                        echo "<a href='update.php?id={$CategoryID}' class='btn-img-info'><i class='material-icons btn' title='update'>edit</i></a>";
                        echo "<a href='#' onclick='delete_user({$CategoryID});' class='btn-img-info'><i class='material-icons btn' title='delete'>delete</i></a>";
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