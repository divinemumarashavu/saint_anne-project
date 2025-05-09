<?php
include("connect.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];

     $sql = "DELETE FROM `stock_out` WHERE Product_Id_out='$id'";
     $query = mysqli_query($conn, $sql);
     if ($query) {
        header("location: stockout_select.php");
        exit();
     }
     else {
       echo "not working";
     }


}
?>