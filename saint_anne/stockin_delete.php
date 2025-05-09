<?php
include("connect.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM `stock_in` WHERE Product_Id='$id' ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("location: stockin_select.php");
        exit();
    }
    else{
        echo "not deleted" . mysqli_error($conn);
    }
}


?>