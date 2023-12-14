<?php
include('./connection.php');

$emailerror = "";
$nameerror = "";
$passerror ="";

if (isset($_POST['submit'])) 
{

	$name = $_POST['name'];
	$email = $_POST['email'];
  $password=$_POST['password'];

	if (empty($name)) 
  {
		$nameerror = "please Enter your Name..";
	} 
  elseif (empty($email)) 
  {
		$emailerror = "please Enter your Email..";
	} 
  elseif (empty($password)) 
  {
		$passerror = "please Enter your password..";
	} 
  else 
  {

  $sql = "INSERT INTO `user_tbl`(`name`, `email`, `password`) VALUES ('{$name}','{$email}','{$password}')";
  if(mysqli_query($server,$sql))
  {
    header("location:./signin.php");
  }
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.min.css">
    <title>Document</title>
	<style>
		img
		{
			height: 150px;
		}
	</style>
</head>
<body style="background-color: #2c2c2c;">
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-4">
              <div class="card rounded-3">
                <img src="./img/image-asset.jpeg"
                  class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                  alt="Sample photo">
                <div class="card-body p-4">
                  <h3 class="mb-3 mx-5">Registration</h3>
      
                <form class="form" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-3">
                      <label class="form-label" for="name">Name</label>
                      <input type="text" id="name" name="name" class="form-control" />
                      <p class="text-danger"><?php echo $nameerror ?></p>
                    </div>
  
                  <div class="form-outline mb-3">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" />
                      <p class="text-danger"><?php echo $emailerror ?></p>
                    </div>
  
                  <div class="form-outline mb-3">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control" />
                      <p class="text-danger"><?php echo $passerror ?></p>
                    </div>
                    <button type="submit" class="btn btn-dark" name="submit">Submit</button>&nbsp;&nbsp;&nbsp;Have an Account :
                    <i class="fa-solid fa-user"></i><a href="./signin.php" class="mx-2 text-dark">Sign in</a>
                </form>
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>