<?php 
include("./data.php");
if(isset($_GET["deletefood"]))
{
    $food_id=$_GET['deletefood'];
    $object->delete_data('food_tbl', $food_id);
    header('location:./food.php');
}
?>