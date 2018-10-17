<!DOCTYPE html>
<html>
    <?php include_once "./header.php.inc" ?>
    <body>
        <?php
            $currentPage = "create";
            $message = [];
            $lastName = "";
            $firstName = "";
            $birthDate = "";
            $photo = "";
            $notes = "";
            include_once "../../nav.php";
            include '../../confi/database.php';
            include_once "./breadcrumb.php.inc";
            if ($_POST) {
                try {
                    $query = "INSERT INTO Employees 
                              SET LastName = :LastName, FirstName = :FirstName, BirthDate = :BirthDate, Photo = :Photo, Notes = :Notes";
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

                    if ($stmt->execute())
                        $message = (object)['type' => 'alert-success', 'desc' => 'Record was saved.'];
                    else
                        $message = (object)['type' => 'alert-danger', 'desc' => 'Unable to save record.'];
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
        ?> 
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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
                        <label for="birthDate">Birth Date</label>
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
