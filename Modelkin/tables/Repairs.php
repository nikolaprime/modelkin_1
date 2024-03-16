<?php
include '../account/header.php';
?> 
    <?php
       require_once('../php/bd.php');
    ?>

		


		<!-- стили -->
		<style>
			section{
				width: 1300px;
    margin-right: auto;
    margin-left: auto;
			}
			h2{
				font-size: 50px;
			}

			.dobaxit_danne{
				padding: 10px;
    width: 150px;
    margin-left: auto;
    margin-right: auto;
			}
			.dobaxit_danne h2{
				font-size: 20px;
			}
			table,
			td,
			tr {
				border: 1px solid white;

				padding: 10px;
			}

			th {
				font-size: 30px;
				padding-right: 100px;
			}
		</style>
		<!-- конец стилей -->




<section>

   <h2>Repairs</h2>
        
                <table>
                    <tr class="naim_atribytov">
                        <th>repair_id</th>
                        <th>device_id</th>
                        <th>technician_id</th>
                        <th>start_date</th>
                        <th>end_date</th>
                        <th>status</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Repairs";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Repairs" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['repair_id'] . "</td>";
                            echo "<td>" .  $supplier['device_id'] . "</td>";
                            echo "<td>" .  $supplier['technician_id'] . "</td>";
                            echo "<td>" .  $supplier['start_date'] . "</td>";
                            echo "<td>" .  $supplier['end_date'] . "</td>";
                            echo "<td>" .  $supplier['status'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['repair_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['repair_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['device_id'])) ){
        $device_id=$_POST['device_id'];
        $technician_id=$_POST['technician_id'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $status=$_POST['status'];
        mysqli_query($conn, "INSERT INTO `Repairs` (`repair_id`, `device_id`,  `technician_id`, `start_date`, `end_date`, `status`) VALUES (NULL, '$device_id', '$technician_id', '$start_date', '$end_date', '$status')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>device_id</p>
            <input class="form_for-text" type="text" name="device_id">
            <p>technician_id</p>
            <input class="form_for-text" type="text" name="technician_id">
            <p>start_date</p>
            <input class="form_for-text" type="date" name="start_date">
            <p>end_date</p>
            <input class="form_for-text" type="date" name="end_date">
            <p>status</p>
            <input class="form_for-text" type="text" name="status">
        
            
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Repairs where repair_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Repairs" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>device_id</p>
                            <input class='form_for-text' type='text' required name='device_id' value='{$supplier['device_id']}'/>
                            <p>device_id</p>
                            <input class='form_for-text' type='text' required name='technician_id' value='{$supplier['technician_id']}'/>
                            <p>device_id</p>
                            <input class='form_for-text' type='date' required name='start_date' value='{$supplier['start_date']}'/>
                            <p>device_id</p>
                            <input class='form_for-text' type='date' required name='end_date' value='{$supplier['end_date']}'/>
                            <p>device_id</p>
                            <input class='form_for-text' type='text' required name='status' value='{$supplier['status']}'/>
                            
                        ";
                    }
                echo '<br><br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $device_id=$_POST['device_id'];
                    $technician_id=$_POST['technician_id'];
                    $start_date=$_POST['start_date'];
                    $end_date=$_POST['end_date'];
                    $status=$_POST['status'];
                    
                    mysqli_query($conn, "UPDATE `Repairs` SET `device_id` = '$device_id', `technician_id` = '$technician_id',`start_date` = '$start_date',`end_date` = '$end_date',`status` = '$status'  where repair_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
						</section>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Repairs WHERE repair_id = {$_GET['del_id']}");        
                }   
            ?>
