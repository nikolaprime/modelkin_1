<?php
include '../account/header.php';
?> 
    <?php
       require_once('../php/bd.php');
    ?>




		<!-- стили -->
		<style>
			section{
				width: 650px;
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

   <h2>Devices</h2>
        
                <table>
                    <tr class="naim_atribytov">
                        <th>device_id</th>
                        <th>device_type</th>
                        <th>customer_id</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Devices";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Devices" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['device_id'] . "</td>";
                            echo "<td>" .  $supplier['device_type'] . "</td>";
                            echo "<td>" .  $supplier['customer_id'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['device_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['device_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
          
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['device_type']) and !empty($_POST['customer_id']))){
        $device_type=$_POST['device_type'];
        $customer_id=$_POST['customer_id'];
        mysqli_query($conn, "INSERT INTO `Devices` (`device_id`, `id_user`,`device_type`, `customer_id`) VALUES (null, 1, '$device_type', '$customer_id')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
        var_dump($_POST['device_type']);
        var_dump($_POST['customer_id']);
       
    }
}
?>
   
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>device_type</p>
            <input class="form_for-text" type="text" name="device_type">
            <p>customer_id</p>
            <input class="form_for-text" type="text" name="customer_id">
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
   
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Devices where device_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Devices" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>device_type</p>
                            <input class='form_for-text' type='text' required name='device_type' value='{$supplier['device_type']}'/>
                            <p>customer_id</p>
                            <input class='form_for-text' type='text' required name='customer_id' value='{$supplier['customer_id']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $device_type=$_POST['device_type'];
                    $customer_id=$_POST['customer_id'];
                    mysqli_query($conn, "UPDATE `Devices` SET `device_type` = '$device_type', `customer_id` = '$customer_id' where device_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
						</section>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Devices WHERE device_id = {$_GET['del_id']}");        
                }   
            ?>
       