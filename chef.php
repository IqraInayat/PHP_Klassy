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
$specerror = "";
$imageerror = "";
if (isset($_POST["submit-add"])) 
{
    
    $name = $_POST['name-add'];
    $speciality = $_POST['spec-add'];
    if (empty($name)) {
        $nameerror = 'Fill this name field';
    } elseif (empty($speciality)) {
        $specerror = 'Fill this field first';
    } elseif ($_FILES['image-add']['error'] != 0) {
        $imageerror = 'Choose image first';
    } else {
        $imagename = $_FILES['image-add']['name'];
        $temp_path = $_FILES['image-add']['tmp_name'];
        $split_extension = explode('.', $imagename);
        $extension = strtolower(end($split_extension));
        $image_array = ['jpg', 'jpeg', 'png'];
        if (in_array($extension, $image_array)) {
            $newimagename = rand(555, 9999999) . "chefimg" . microtime() . $imagename;
            $image_folder = './img/' . $newimagename;
            if (move_uploaded_file($temp_path, $image_folder)) {
                $chef_add =
                    [
                        'name' => $name,
                        'speciality' => $speciality,
                        'image' => $image_folder
                    ];
                $object->Add_data('chef_tbl', $chef_add);
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
                            <h1 class="h3 mb-3">Chefs Data</h1>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addchef" id="btn-add">
                                Add Chef
                            </button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- delete model -->
                                <div class="modal fade" id="deletechef" tabindex="-1" aria-labelledby="deletechefLabel" aria-hidden="true">
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
                                </div>


                                <div class="card-body">

                                    <!-- add course -->
                                    <div class="modal fade" id="addchef" tabindex="-1" aria-labelledby="addchefLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="addchefLabel">Add Chef</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-danger" id="error-add"></div>
                                                    <div class="text-success" id="success-add"></div>
                                                    <form action="#" method="POST" id="add-chef-form" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="name-add">Chef Name</label>
                                                            <input type="text" class="form-control" name="name-add" id="name-add" placeholder="Enter chef name!">
                                                            <p class="text-danger"><?php echo $nameerror ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="spec-add">Speciality</label>
                                                            <input type="text" class="form-control" name="spec-add" id="spec-add" placeholder="Enter Speciality!">
                                                            <p class="text-danger"><?php echo $specerror ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image-add">Image</label>
                                                            <input type="file" class="form-control" name="image-add" id="image-add">
                                                            <p class="text-danger"><?php echo $imageerror ?></p>
                                                        </div>
                                                        <div>
                                                            <input type="submit" value="Add Chef" class="btn btn-primary" name="submit-add">
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

                                    <div class="modal fade" id="editchef" tabindex="-1" aria-labelledby="editchefLabel" aria-hidden="true">
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
                                    </div>

                                    <!-- Data display with PHP code -->
                                    <div class="row">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Chef's Name</th>
                                                                <th>Speciality</th>
                                                                <th>Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbody">
                                                            <?php
                                                            $fetch_data = $object->Display_data('chef_tbl');
                                                            foreach ($fetch_data as $data) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $data['id'] ?></td>
                                                                    <td><?php echo $data['name'] ?></td>
                                                                    <td><?php echo $data['speciality'] ?></td>
                                                                    <td><img src="<?php echo $data['image'] ?>" height="150px" width="150px"></td>
                                                                    <td>
                                                                        <a href="./deletechef.php?deletechef=<?php echo $data['id']?>" class="btn btn-danger">Delete</a>
                                                                        <a href="./editchef.php?editchef=<?php echo $data['id']?>" class="btn btn-info">Edit</a>
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