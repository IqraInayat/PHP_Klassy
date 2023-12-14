<?php 
session_start();
if(isset($_SESSION["key"]))
{
	header("location:./dashboard.php");
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
			height: 170px;
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
                  <h3 class="mb-3 mx-5">&nbsp;&nbsp;&nbsp;Log Inn</h3>
      
                <form class="form" action="login.php" method="post" enctype="multipart/form-data">
  
                  <div class="form-outline mb-3">
                      <!-- <input type="hidden" name="name" class="form-control"/>   -->
                      <label class="form-label" for="form3Example1q">Email</label>
                      <input type="email" id="form3Example1q" name="email" class="form-control" />
                  </div>
  
                  <div class="form-outline mb-3">
                      <label class="form-label" for="form3Example1q">Password</label>
                      <input type="password" id="form3Example1q" name="password" class="form-control" />
                  </div>
                    <button type="submit" name="submit" class="btn btn-dark">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;No account:
                    <i class="fa-solid fa-user mx-2"></i><a href="./Register.php" class="text-dark">Sign Up</a>
                </form>
      
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>