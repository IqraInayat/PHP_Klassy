<?php 
include('./data.php');
if(isset($_GET["editchef"]))
{
$id = $_GET['editchef'];
$data = $object->showsingle_data("chef_tbl",$id);

$uid = $data["id"];
$name = $data['name'];
$speciality = $data['speciality'];    
}

$specerror = "";
$nameerror = "";
$success = "";



if (isset($_POST['submit-edit'])) 
{

	$name = $_POST['name-edit'];
	$speciality = $_POST['spec-edit'];

	if (empty($name)) 
    {
		$nameerror = "please Enter chef Name..";
	} 
    elseif (empty($speciality)) 
    {
		$specerror = "please fill this field..";
	} 
    else 
    {

		$data = [
			'name' => $name,
			'speciality' => $speciality,			
		];
		$success =    $object->update_data("chef_tbl", $data,$id);
        header("location:./chef.php");
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
                                            <label for="name-edit">Chef Name</label>
                                            <input type="text" class="form-control" name="name-edit" id="name-edit" placeholder="Enter chef name!" value="<?php echo $name  ?>">
                                            <p class="text-danger"> <?php echo $nameerror  ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="spec-edit">Speciality</label>
                                            <input type="text" class="form-control" name="spec-edit" id="spec-edit" placeholder="Enter your email!" value="<?php echo $speciality  ?>">
                                            <p class="text-danger"> <?php echo $specerror  ?></p>
                                            <p class="text-success"> <?php echo $success  ?></p>
                                        </div>
                                        <div>
                                            <input type="submit" value="Edit chef" class="btn btn-primary" name="submit-edit">
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