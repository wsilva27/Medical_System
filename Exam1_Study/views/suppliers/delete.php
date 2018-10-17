<?php
    include '../../confi/database.php';
    try{
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found');
        $query = "delete from Suppliers where SupplierID = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $id);

        if($stmt->execute()){
            header('Location: index.php?action=deleted');
        }else{
            die('Unable to delete record.');
        }
    }catch(PDOException $exception){
        die('ERROR: '.$exception->getMessage());
    }
?>