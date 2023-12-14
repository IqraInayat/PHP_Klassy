<?php 
include("./data.php");
if(isset($_GET["deletechef"]))
{
    $chef_id=$_GET['deletechef'];
    $object->delete_data('chef_tbl', $chef_id);
    header('location:./chef.php');
}
?>