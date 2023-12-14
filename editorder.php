<?php
include("./data.php");
if(isset($_GET["editorder"]))
{
$id = $_GET['editorder'];
$data = $object->showsingle_data("reservation_tbl",$id);

$uid = $data["id"];
$name = $data['name'];
$email = $data['email'];  
$number = $data['contact'];    
$guest = $data['guest_no'];    
$date = $data['date'];    
$time = $data['time'];
$message = $data['message'];    
}

$nameerror = "";
$emailerror = "";
$numerror = "";
$guesterror = "";
$dateerror = "";
$timeerror = "";
$success="";
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['phone'];
    $guest = $_POST['number-guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    if (empty($name)) {
        $nameerror = 'Fill this name field';
    } elseif (empty($email)) {
        $emailerror = 'Fill this field first';
    } elseif (empty($number)) {
        $numerror = 'Fill this field first';
    } elseif (empty($guest)) {
        $guesterror = 'Fill this field first';
    } elseif (empty($date)) {
        $dateerror = 'Fill this field first';
    } elseif (empty($time)) {
        $timeerror = 'Fill this field first';
    } else {
        $data =
            [
                'name' => $name,
                'email' => $email,
                'contact' => $number,
                'guest_no' => $guest,
                'date' => $date,
                'time' => $time,
                'message' => $message
            ];
        $success =  $object->update_data("reservation_tbl", $data,$id);
        header("location:./reservation.php");
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

                    <h1 class="h3 mb-3">Edit Order</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form id="contact" action="" method="post">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <fieldset>
                                                    <input class="form-control" name="name" type="text" id="name" placeholder="Your Name*" value="<?php echo $name ?>">
                                                    <p class="text-danger"><?php echo $nameerror ?></p>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <fieldset>
                                                    <input class="form-control" name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" value="<?php echo $email ?>">
                                                    <p class="text-danger"><?php echo $emailerror ?></p>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <fieldset>
                                                    <input class="form-control" name="phone" type="text" id="phone" placeholder="Phone Number*" value="<?php echo $number ?>">
                                                    <p class="text-danger"><?php echo $numerror ?></p>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <fieldset>
                                                    <select class="form-select" value="number-guests" name="number-guests" id="number-guests">
                                                        <option value="number-guests">Number Of Guests</option>
                                                        <option name="1" id="1" <?php if ($guest == 1) echo 'selected'; ?>>1</option>
                                                        <option name="2" id="2" <?php if ($guest == 2) echo 'selected'; ?>>2</option>
                                                        <option name="3" id="3" <?php if ($guest == 3) echo 'selected'; ?>>3</option>
                                                        <option name="4" id="4" <?php if ($guest == 4) echo 'selected'; ?>>4</option>
                                                        <option name="5" id="5" <?php if ($guest == 5) echo 'selected'; ?>>5</option>
                                                        <option name="6" id="6" <?php if ($guest == 6) echo 'selected'; ?>>6</option>
                                                        <option name="7" id="7" <?php if ($guest == 7) echo 'selected'; ?>>7</option>
                                                        <option name="8" id="8" <?php if ($guest == 8) echo 'selected'; ?>>8</option>
                                                        <option name="9" id="9" <?php if ($guest == 9) echo 'selected'; ?>>9</option>
                                                        <option name="10" id="10" <?php if ($guest == 10) echo 'selected'; ?>>10</option>
                                                        <option name="11" id="11" <?php if ($guest == 11) echo 'selected'; ?>>11</option>
                                                        <option name="12" id="12" <?php if ($guest == 12) echo 'selected'; ?>>12</option>
                                                    </select>
                                                </fieldset>
                                                <p class="text-danger"><?php echo $guesterror ?></p>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="filterDate2">
                                                    <div class="input-group date" data-date-format="yyyy-mm-dd">
                                                        <input class="form-control" name="date" id="date" type="text" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $date ?>">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                    <p class="text-danger"><?php echo $dateerror ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <fieldset>
                                                    <select class="form-select" value="time" name="time" id="time">
                                                        <option value="time">Time</option>
                                                        <option name="Breakfast" id="Breakfast" <?php if ($time == 'Breakfast') echo 'selected'; ?>>Breakfast</option>
                                                        <option name="Lunch" id="Lunch" <?php if ($time == 'Lunch') echo 'selected'; ?>>Lunch</option>
                                                        <option name="Dinner" id="Dinner" <?php if ($time == 'Dinner') echo 'selected'; ?>>Dinner</option>
                                                    </select>
                                                </fieldset>
                                                <p class="text-danger"><?php echo $timeerror ?></p>
                                            </div>
                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <textarea class="form-control" name="message" rows="6" id="message" placeholder="Message"><?php echo $message ?></textarea>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-12">
                                                <fieldset>
                                                    <button type="submit" id="form-submit" name="submit" class="btn btn-info mt-3">Make A Reservation</button>
                                                </fieldset>
                                                <p class="text-success"><?php echo $success ?></p>
                                            </div>
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