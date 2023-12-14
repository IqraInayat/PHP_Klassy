<?php 
session_start();
if(!isset($_SESSION["key"]))
{
	header("location:./index.php");
}
?>

<?php
include('./data.php');
$nameerror = "";
$priceerror = "";
$timeerror = "";
$imageerror = "";
if (isset($_POST["submit-add"])) 
{
    
    $name = $_POST['name-add'];
    $price = $_POST['price-add'];
    $time = $_POST['time-add'];
    if (empty($name)) {
        $nameerror = 'Fill this name field';
    } elseif (empty($price)) {
        $priceerror = 'Fill this field first';
    } 
    elseif (empty($time)) {
        $timeerror = 'Fill this field first';
    } 
    elseif ($_FILES['image-add']['error'] != 0) {
        $imageerror = 'Choose image first';
    } else {
        $imagename = $_FILES['image-add']['name'];
        $temp_path = $_FILES['image-add']['tmp_name'];
        $split_extension = explode('.', $imagename);
        $extension = strtolower(end($split_extension));
        $image_array = ['jpg', 'jpeg', 'png'];
        if (in_array($extension, $image_array)) {
            $newimagename = rand(555, 9999999) . "foodimg" . microtime() . $imagename;
            $image_folder = './img/' . $newimagename;
            if (move_uploaded_file($temp_path, $image_folder)) {
                $food_add =
                    [
                        'name' => $name,
                        'price' => $price,
                        'time' => $time,
                        'image' => $image_folder
                    ];
                $object->Add_data('food_tbl', $food_add);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        }
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
                    <div class="row">
                        <div class="col-6">
                            <h1 class="h3 mb-3">Food Data</h1>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addfood" id="btn-add">
                                Add Food
                            </button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- delete model -->
                                <!-- <div class="modal fade" id="deletechef" tabindex="-1" aria-labelledby="deletechefLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deletechefLabel">Delete Chef</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="text-success" id="success-delete"></div>
                                                <form action="" method="POST" id="deletechef">
                                                    <div>Are your sure you want to delete this?</div>
                                                    <p id="namedel"></p>
                                                    <div>
                                                        <input type="submit" value="Delete chef" class="btn btn-danger" name="submit-delete" data-bs-dismiss="modal">
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->


                                <div class="card-body">

                                    <!-- add course -->
                                    <div class="modal fade" id="addfood" tabindex="-1" aria-labelledby="addfoodLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="addfoodLabel">Add Food</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-danger" id="error-add"></div>
                                                    <div class="text-success" id="success-add"></div>
                                                    <form action="#" method="POST" id="add-food-form" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="name-add">Food Name</label>
                                                            <input type="text" class="form-control" name="name-add" id="name-add" placeholder="Enter food name!">
                                                            <p class="text-danger"><?php echo $nameerror ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price-add">Price</label>
                                                            <input type="text" class="form-control" name="price-add" id="price-add" placeholder="Enter price!">
                                                            <p class="text-danger"><?php echo $priceerror ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="time-add">Time</label>
                                                            <input type="text" class="form-control" name="time-add" id="time-add" placeholder="Enter time!">
                                                            <p class="text-danger"><?php echo $timeerror ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image-add">Image</label>
                                                            <input type="file" class="form-control" name="image-add" id="image-add">
                                                            <p class="text-danger"><?php echo $imageerror ?></p>
                                                        </div>
                                                        <div>
                                                            <input type="submit" value="Add food" class="btn btn-primary" name="submit-add">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end of addd user model -->

                                    <!-- <div class="modal fade" id="editchef" tabindex="-1" aria-labelledby="editchefLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p id="uname"></p>
                                                    <h1 class="modal-title fs-5" id="editchefLabel">Edit Chef Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-danger" id="error-edit"></div>
                                                    <div class="text-success" id="success-edit"></div>
                                                    <form action="" method="POST" id="edit-chef-form">
                                                        <div class="mb-3">
                                                            <label for="name-edit">Chef Name</label>
                                                            <input type="text" class="form-control" name="name-edit" id="name-edit" placeholder="Enter chef name!">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="spec-edit">Speciality</label>
                                                            <input type="text" class="form-control" name="spec-edit" id="spec-edit" placeholder="Enter speciality!">
                                                        </div>
                                                        <div>
                                                            <input type="submit" value="Edit chef" class="btn btn-primary" name="submit-edit" data-bs-dismiss="modal">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- Data display with PHP code -->
                                    <div class="row">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Food Name</th>
                                                                <th>Price($Dollar)</th>
                                                                <th>Time</th>
                                                                <th>Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbody">
                                                            <?php
                                                            $fetch_data = $object->Display_data('food_tbl');
                                                            foreach ($fetch_data as $data) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $data['id'] ?></td>
                                                                    <td><?php echo $data['name'] ?></td>
                                                                    <td><?php echo $data['price'] ?></td>
                                                                    <td><?php echo $data['time'] ?></td>
                                                                    <td><img src="<?php echo $data['image'] ?>" height="150px" width="150px"></td>
                                                                    <td>
                                                                        <a href="./deletefood.php?deletefood=<?php echo $data['id']?>" class="btn btn-danger">Delete</a>
                                                                        <a href="./editfood.php?editfood=<?php echo $data['id']?>" class="btn btn-info">Edit</a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <!-- End of Data display -->
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