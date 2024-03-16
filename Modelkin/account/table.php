<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

	$user_check = $_SESSION['login_user'];
	$query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
	$rows = mysqli_fetch_array($query);
	$names = $rows['name'];
	$status = $rows['admin'];
} else {
	header('Location index.php');
}
?>
<link rel='stylesheet' href='../css/style.css'>
<main class="main_admin admins">

	<section class="blocksss">
		<div class="">
			<div class="">
				<nav class="table_section-nav" style="display: ruby-text;">
					<ul>
						<?php

						$sql = "SHOW FULL TABLES FROM modelkin WHERE TABLE_TYPE != 'VIEW';";
						$result = mysqli_query($conn, $sql);

						// output database names
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								if ($row['Tables_in_modelkin'] == 'components') {
									$tables = 'Components';
									$href = 'Components.php';
								}
								if ($row['Tables_in_modelkin'] == 'customers') {
									$tables = 'Customers';
									$href = 'Customers.php';
								}
								if (($row['Tables_in_modelkin'] == 'devicecomponents')) {
									$tables = 'DeviceComponents';
									$href = 'DeviceComponents.php';
								}
								if ($row['Tables_in_modelkin'] == 'devicemanufacturers') {
									$tables = 'DeviceManufacturers';
									$href = 'DeviceManufacturers.php';
								}
								if ($row['Tables_in_modelkin'] == 'devices') {
									$tables = 'Devices';
									$href = 'Devices.php';
								}
								if ($row['Tables_in_modelkin'] == 'manufacturers') {
									$tables = 'Manufacturers';
									$href = 'Manufacturers.php';
								}
								if ($row['Tables_in_modelkin'] == 'repairs') {
									$tables = 'Repairs';
									$href = 'Repairs.php';
								}
								if ($row['Tables_in_modelkin'] == 'technicians') {
									$tables = 'Technicians';
									$href = 'Technicians.php';
								}
								if ($row['Tables_in_modelkin'] == 'users') {
									$tables = 'users';
									$href = 'users.php';
								}
								echo '<li style="font-size: 50px;" ><a href="../tables/' . $href . '" class="">' . $tables . "</a></li><br>";
							}
						}

						?>


					</ul>
				</nav>
			</div>
		</div>
	</section>
</main>