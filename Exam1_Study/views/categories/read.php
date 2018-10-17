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
                $query = "SELECT CategoryID, CategoryName, Description FROM Categories WHERE CategoryID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                //mapping each data into variable
                $categoryID = $row['CategoryID'];
                $categoryName = utf8_encode($row['CategoryName']);
                $description = utf8_encode($row['Description']);
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }

            include_once "./breadcrumb.php.inc";
        ?> 
        <div class="offset-md-5 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="categoryName" class="form-control" value="<?php echo $categoryName ?>" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="description">Description</label>
                    <textarea name="description" rows="4" class="form-control" disabled><?php echo $description ?></textarea>
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