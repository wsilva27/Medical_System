<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "update";
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
            $message = [];
            include_once "../../nav.php";
            include_once '../../confi/database.php';
            try {
                $query = "SELECT EmployeeID, LastName, FirstName, BirthDate, Photo, Notes FROM Employees WHERE EmployeeID = ? LIMIT 0,1";
                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                //mapping each data into variable
                $lastName = utf8_encode($row['LastName']);
                $firstName = utf8_encode($row['FirstName']);
                $birthDate = $row['BirthDate'];
                $photo = $row['Photo'];
                $notes = utf8_encode($row['Notes']);
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }              

            if ($_POST) {
                try {
                    $query = "UPDATE Employees 
                              SET LastName = :LastName, FirstName = :FirstName, BirthDate = :BirthDate, Photo = :Photo, Notes = :Notes
                              WHERE EmployeeID = :EmployeeID";
                    $stmt = $con->prepare($query);

                    // posted values
                    $lastName = htmlspecialchars(strip_tags($_POST['lastName']));
                    $firstName = htmlspecialchars(strip_tags($_POST['firstName']));
                    $birthDate = htmlspecialchars(strip_tags($_POST['birthDate']));
                    $photo = htmlspecialchars(strip_tags($_POST['photo']));
                    $notes = htmlspecialchars(strip_tags($_POST['notes']));

                    $stmt->bindParam(':LastName', $lastName);
                    $stmt->bindParam(':FirstName', $firstName);
                    $stmt->bindParam(':BirthDate', $birthDate);
                    $stmt->bindParam(':Photo', $photo);
                    $stmt->bindParam(':Notes', $notes);
                    $stmt->bindParam(':EmployeeID', $id);

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
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" class="form-control" value="<?php echo $lastName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" class="form-control" value="<?php echo $firstName ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="birthDate">Birth Date (mm/dd/yyyy)</label>
                        <input type="date" name="birthDate" class="form-control" value="<?php echo $birthDate ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="photo">Photo</label>
                        <input type="text" name="photo" class="form-control" value="<?php echo $photo ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="notes">Notes</label>
                        <textarea name="notes" rows="5" class="form-control"><?php echo $notes ?></textarea>
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