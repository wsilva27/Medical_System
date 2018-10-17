<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "create";
            $message = [];
            $categoryName = "";
            $description = "";

            include_once "../../nav.php";
            include '../../confi/database.php';
        
            if ($_POST) {
                try {
                    $query = "INSERT INTO Categories 
                              SET CategoryName = :CategoryName, Description = :Description";
                    $stmt = $con->prepare($query);

                    // posted values
                    $categoryName = htmlspecialchars(strip_tags($_POST['categoryName']));
                    $description = htmlspecialchars(strip_tags($_POST['description']));

                    $stmt->bindParam(':CategoryName', $categoryName);
                    $stmt->bindParam(':Description', $description);

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
