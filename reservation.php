<?php 
session_start();
if(!isset($_SESSION["key"]))
{
	header("location:./index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<!-- Header PHP -->
<?php
include_once('./Partial/header.php');
?>

<body>
	<div class="wrapper">
		<!-- Sidebar PHP -->
		<?php
		include_once('./Partial/sidebar.php');
		?>

		<div class="main">
			<!-- Navbar PHP -->
			<?php
			include_once('./Partial/navbar.php');
			?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Reservations</h1>

					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="card">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table">
															<thead>
																<tr>
																	<th scope="col">Id</th>
																	<th scope="col">Name</th>
																	<th scope="col">Email</th>
																	<th scope="col">Contact</th>
																	<th scope="col">Guest_No</th>
																	<th scope="col">Date</th>
																	<th scope="col">Time</th>
																	<th scope="col">Message</th>
																	<th scope="col">Action</th>
																</tr>
															</thead>

														    <tbody>
                                                        <?php
														    include('./data.php');
                                                            $data=$object->display_data('reservation_tbl');
                                                            foreach($data as $fetch_data)
                                                            {
														?>
																<tr>
																	<td><?php echo $fetch_data['id'] ?></td>
																	<td><?php echo $fetch_data['name'] ?></td>
																	<td><?php echo $fetch_data['email'] ?></td>
																	<td><?php echo $fetch_data['contact'] ?></td>
																	<td><?php echo $fetch_data['guest_no'] ?></td>
																	<td><?php echo $fetch_data['date'] ?></td>
																	<td><?php echo $fetch_data['time'] ?></td>
																	<td><?php echo $fetch_data['message'] ?></td>
																	<td>
                                                                        <a href="./deleteorder.php?delorder=<?php echo $fetch_data['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                                        <a href="./editorder.php?editorder=<?php echo $fetch_data['id'] ?>" class="btn btn-info "><i class="fa-solid fa-pen-to-square"></i></a>
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
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<!-- Footer PHP -->
			<?php
			include_once('./Partial/footer.php');
			?>
		</div>
	</div>

	<script src="js/app.js"></script>



</body>

</html>