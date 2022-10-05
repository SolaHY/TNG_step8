<?php
//Database Connection Code
$con = mysqli_connect("localhost", "root", "","vmachine" );

//Delete Data Code
extract($_POST);

if(isset($id)){
    $query = mysqli_query($con, "delete from products where id='".$id."'" );
    if($query == true){
        echo "delete";
    }
}
?>
