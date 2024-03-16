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
<style>
	section {
		width: 650px;
		margin-right: auto;
		margin-left: auto;
	}

	h2 {
		font-size: 50px;
	}

	.dobaxit_danne {
		padding: 10px;
		width: 150px;
		margin-left: auto;
		margin-right: auto;
	}

	.dobaxit_danne h2 {
		font-size: 20px;
	}

	table,
	td,
	tr {
		border: 1px solid white;
		font-size: 30px;
		padding: 10px;
	}

	p {
		font-size: 30px;
	}

	th {
		font-size: 30px;
		padding-right: 100px;
	}
</style>


<link rel='stylesheet' href='../css/style.css'>

<section class="sql-zaprosi-section">

	<div class="sql-zaprosi">
		<h2>SQL - Запросы</h2>
		<p>1. Получить список всех устройств, находящихся в ремонте с данными заказчика.</p>

		<?php
		require_once('../php/bd.php');
		$sql = "SELECT Devices.device_id, Devices.device_type, Customers.full_name
FROM Devices
INNER JOIN Repairs ON Devices.device_id = Repairs.device_id
INNER JOIN Customers ON Devices.customer_id = Customers.customer_id
WHERE Repairs.status = 'В процессе';";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<table><tr><th>device_id</th><th>device_type</th><th>full_name</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["device_id"] . "</td><td>" . $row["device_type"] . "</td><td>" . $row["full_name"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 результатов";
		}
		?>

		<p>2. Получить список всех ремонтных заказов, выполненных определенным техником.</p>

		<?php
		$query = "SELECT Repairs.repair_id, Devices.device_type, Technicians.full_name
FROM Repairs
INNER JOIN Devices ON Repairs.device_id = Devices.device_id
INNER JOIN Technicians ON Repairs.technician_id = Technicians.technician_id
WHERE Technicians.full_name = 'Иванов Алексей';";
		$results = mysqli_query($conn, $query);
		echo '<table>
<thead>
<tr>
<th>repair_id</th>
<th>device_type</th>
<th>full_name</th>
</tr>
</thead>
<tbody>';
		if ($results) {
			while ($row = mysqli_fetch_assoc($results)) {
				echo "<tr><td>" . $row['repair_id'] . "</td><td>" . $row['device_type'] . "</td><td>" . $row['full_name'] . "</td></tr>";
			}
			echo '</table>';
		}
		?>


		<p>3. Получить список всех устройств, у которых гарантия истекла.</p>
		<p>0 результатов</p>
		<?php

		$query = "SELECT Devices.device_id, Devices.device_type
FROM Devices
LEFT JOIN Repairs ON Devices.device_id = Repairs.device_id
WHERE Repairs.device_id IS NULL;";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0) {
			echo "<table><tr><th>device_id</th><th>device_type</th></tr>";
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>" . $row["device_id"] . "</td><td>" . $row["device_type"] . "</td></tr>";
				echo "<p>0 результатов</p>";
			}
			echo "</table>";
		} else {
			echo "0 результатов";
		}

		?>

		<p>4. Получить список всех клиентов, у которых есть активные ремонтные заказы.</p>
		<?php

		$sql = "SELECT Customers.customer_id, Customers.full_name
FROM Customers
INNER JOIN Devices ON Customers.customer_id = Devices.customer_id
INNER JOIN Repairs ON Devices.device_id = Repairs.device_id
WHERE Repairs.status = 'В процессе';";
		echo "
<table>
    <tr>
        <th>customer_id</th>
        <th>full_name</th>
    </tr>";
		echo "";
		foreach ($conn->query($sql) as $row) {
			echo "<tr>";
			echo "<td>" . $row['customer_id'] . "</td>";
			echo "<td>" . $row['full_name'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";

		?>

		<p>5. Получить список всех устройств, которые были ремонтированы определенным техником.</p>

		<?php

		$sql = "SELECT Devices.device_id, Devices.device_type
FROM Devices
INNER JOIN Repairs ON Devices.device_id = Repairs.device_id
INNER JOIN Technicians ON Repairs.technician_id = Technicians.technician_id
WHERE Technicians.full_name = 'Иванов Алексей';";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table><tr><th>device_id</th><th>device_type</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["device_id"] . "</td><td>" . $row["device_type"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		?>


		<p>6. Получить список всех ремонтных заказов, у которых дата завершения ремонта попадает в заданный временной интервал.</p>

		<?php

		$sql = "SELECT *
FROM Repairs
WHERE end_date BETWEEN '2022-01-01' AND '2022-02-01';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table><tr><th>repair_id</th><th>device_id</th><th>technician_id</th><th>start_date</th><th>end_date</th><th>status</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["repair_id"] . "</td><td>" . $row["device_id"] . "</td><td>" . $row["technician_id"] . "</td><td>" . $row["start_date"] . "</td><td>" . $row["end_date"] . "</td><td>" . $row["status"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}

		?>

		<p>7. Получить список всех устройств, у которых неисправность связана с определенным компонентом.</p>

		<?php

		$sql = "SELECT Devices.device_id, Devices.device_type
FROM Devices
INNER JOIN DeviceComponents ON Devices.device_id = DeviceComponents.device_id
INNER JOIN Components ON DeviceComponents.component_id = Components.component_id
WHERE Components.component_name = 'Процессор';";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table><tr><th>device_id</th><th>device_type</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["device_id"] . "</td><td>" . $row["device_type"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		?>

		<p>8. Получить список всех устройств, сгруппированных по типу и указанием общего количества устройств каждого типа.</p>

		<?php

		$sql = "SELECT device_type, COUNT(*) AS total_devices
FROM Devices
GROUP BY device_type;";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table><tr><th>device_type</th><th>total_devices</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["device_type"] . "</td><td>" . $row["total_devices"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		?>



		<p>9. Получить список всех ремонтных заказов, сгруппированных по статусу и указанием количества заказов для каждого статуса.</p>

		<?php

		$sql = "SELECT status, COUNT(*) AS total_orders
    FROM Repairs
    GROUP BY status;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table><tr><th>status</th><th>total_orders</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["status"] . "</td><td>" . $row["total_orders"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}

		?>


		<p>10. Получить список всех ремонтных заказов, у которых неисправность связана с определенным производителем устройства.</p>

		<?php

		$sql = "SELECT Repairs.repair_id, Devices.device_type, Manufacturers.manufacturer_name
FROM Repairs
INNER JOIN Devices ON Repairs.device_id = Devices.device_id
INNER JOIN DeviceManufacturers ON Devices.device_id = DeviceManufacturers.device_id
INNER JOIN Manufacturers ON DeviceManufacturers.manufacturer_id = Manufacturers.manufacturer_id
WHERE Manufacturers.manufacturer_name = 'Intel';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<table><tr><th>repair_id</th><th>device_type</th><th>manufacturer_name</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["repair_id"] . "</td><td>" . $row["device_type"] . "</td><td>" . $row["manufacturer_name"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "0 results";
		}

		?>
	</div>

</section>
<?php
include 'footer.php';
?>