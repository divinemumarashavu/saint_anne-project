<?php
include("connect.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM `products` WHERE Product_ID='$id' ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("location: product_select.php");
        exit();
    }
    else{
        echo "not deleted" . mysqli_error($conn);
    }
}


?>