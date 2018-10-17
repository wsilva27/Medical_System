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
                $query = "SELECT CategoryID, CategoryName, Description FROM Categories WHERE CategoryID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                //mapping each data into variable
                $categoryName = utf8_encode($row['CategoryName']);
                $description = utf8_encode($row['Description']);
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }              

            if ($_POST) {
                try {
                    $query = "UPDATE Categories 
                              SET CategoryName = :CategoryName, Description = :Description
                              WHERE CategoryID = :CategoryID";
                    $stmt = $con->prepare($query);

                    // posted values
                    $categoryName = htmlspecialchars(strip_tags($_POST['categoryName']));
                    $description = htmlspecialchars(strip_tags($_POST['description']));

                    $stmt->bindParam(':CategoryName', $categoryName);
                    $stmt->bindParam(':Description', $description);
                    $stmt->bindParam(':CategoryID', $id);

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
                        <label for="categoryName">Category Name</label>
                        <input type="text" name="categoryName" class="form-control" value="<?php echo $categoryName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="description">Description</label>
                        <textarea name="description" rows="4" class="form-control"><?php echo $description ?></textarea>
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