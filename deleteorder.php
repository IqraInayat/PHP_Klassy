<?php 
include("./data.php");
if(isset($_GET["delorder"]))
{
    $order_id=$_GET['delorder'];
    $object->delete_data('reservation_tbl', $order_id);
    header('location:./reservation.php');
}
?>