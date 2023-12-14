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

					<h1 class="h3 mb-3">User Data</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="card">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table">
														<?php
														include('./connection.php');
														$tbl_data = "SELECT * FROM `user_tbl`";
														$tbl_query = mysqli_query($server, $tbl_data);
														if (mysqli_num_rows($tbl_query) > 0) {
														?>
															<thead>
																<tr>
																	<th scope="col">Id</th>
																	<th scope="col">Name</th>
																	<th scope="col">Email</th>
																	<th scope="col">Password</th>
																	<th scope="col">User_Type</th>
																	<th scope="col">Action</th>
																</tr>
															</thead>

														<?php
														} else {
															echo "No record found";
														}
														?>

														<tbody>
															<?php
															while ($fetch_data = mysqli_fetch_assoc($tbl_query)) {
															?>

																<tr>
																	<td><?php echo $fetch_data['id'] ?></td>
																	<td><?php echo $fetch_data['name'] ?></td>
																	<td><?php echo $fetch_data['email'] ?></td>
																	<td><?php echo $fetch_data['password'] ?></td>
																	<td><?php echo $fetch_data['user_type'] ?></td>
																	<td><a href="./delete.php?deldata=<?php echo $fetch_data['id'] ?>" class="btn btn-danger">Delete</a><a href="./update.php?updata=<?php echo $fetch_data['id'] ?>" class="btn btn-info mx-3">Edit</a></td>

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