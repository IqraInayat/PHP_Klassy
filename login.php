 <?php
session_start(); 
include("./connection.php");
if(isset($_POST["submit"]))
{
  $email=$_POST['email'];
  $password=$_POST['password'];
//   $name=$_POST['name'];
  $sql="SELECT * FROM `user_tbl` WHERE `email`='{$email}' AND `password`='{$password}'";
  $query=mysqli_query($server,$sql);
  $user=mysqli_fetch_assoc($query);
  if(mysqli_num_rows($query)>0)
 {
    $_SESSION['key']=$email;
    // $_SESSION['name']= $name;
    //  $_SESSION['pass']=$password;
    $_SESSION['user_type']=$user['user_type'];
    if($_SESSION['user_type']=='admin')
    {
        header('location:./dashboard.php');
    }
    else
    {
        header('location:./index.php');
    }
 }
 else
 {
    header('location:./signin.php');
 }
}
?> 