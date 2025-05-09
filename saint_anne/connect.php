<?php 
$conn = New mysqli("localhost", "root", "","Saint_Anne");
if ($conn){
   // echo "database connected";
}
else {
    echo "not connected" . mysqli_error($conn);
}
?>