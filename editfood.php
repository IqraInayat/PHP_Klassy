<?php 
include('./data.php');
if(isset($_GET["editfood"]))
{
$id = $_GET['editfood'];
$data = $object->showsingle_data("food_tbl",$id);

$uid = $data["id"];
$name = $data['name'];
$price = $data['price'];    
$time = $data['time'];    
}
$priceerror = "";
$timeerror = "";
$nameerror = "";
$success = "";


if (isset($_POST['submit-edit'])) 
{

	$name = $_POST['name-edit'];
	$price = $_POST['price-edit'];
	$time = $_POST['time-edit'];

	if (empty($name)) 
    {
		$nameerror = "please Enter food Name..";
	} 
    elseif (empty($price)) 
    {
		$priceerror = "please fill this field..";
	} 
    elseif (empty($time)) 
    {
		$timeerror = "please fill this field..";
	}
    else 
    {

		$data = [
			'name' => $name,
			'price' => $price,
            'time' => $time,			
		];
		$success =    $object->update_data("food_tbl", $data,$id);
        header("location:./food.php");
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<?php require_once './Partial/header.php'; ?>

<body>
    <div class="wrapper">

        <?php require_once './Partial/sidebar.php'; ?>

        <div class="main">

            <?php require_once './Partial/navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Edit Chef Data</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form action="" method="POST" id="edit-chef-form">
                                        <div class="mb-3">
                                            <input type="hidden" value="<?php echo $uid  ?>" name="id">
                                            <label for="name-edit">Food Name</label>
                                            <input type="text" class="form-control" name="name-edit" id="name-edit" placeholder="Enter food name!" value="<?php echo $name  ?>">
                                            <p class="text-danger"> <?php echo $nameerror  ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price-edit">Price</label>
                                            <input type="text" class="form-control" name="price-edit" id="price-edit" placeholder="Enter price!" value="<?php echo $price  ?>">
                                            <p class="text-danger"> <?php echo $priceerror  ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="time-edit">Time</label>
                                            <input type="text" class="form-control" name="time-edit" id="time-edit" placeholder="Enter time!" value="<?php echo $time ?>">
                                            <p class="text-danger"> <?php echo $timeerror  ?></p>
                                            <p class="text-success"> <?php echo $success  ?></p>
                                        </div>
                                        <div>
                                            <input type="submit" value="Edit food" class="btn btn-primary" name="submit-edit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php require_once './Partial/footer.php'; ?>

        </div>
    </div>

    <?php require_once './Partial/script.php'; ?>

</body>

</html>