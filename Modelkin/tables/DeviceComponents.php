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
   <h2>Device Components</h2>
        
                <table>
                    <tr class="naim_atribytov">
                        <th>device_id</th>
                        <th>component_id</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM DeviceComponents";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM DeviceComponents" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['device_id'] . "</td>";
                            echo "<td>" .  $supplier['component_id'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['device_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['device_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['component_id'])) ){
        $component_id=$_POST['component_id'];
        mysqli_query($conn, "INSERT INTO `DeviceComponents` (`device_id`, `component_id`) VALUES (NULL, '$component_id')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>component_id</p>
            <input class="form_for-text" type="text" name="component_id">
            
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM DeviceComponents where device_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM DeviceComponents" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>component_id</p>
                            <input class='form_for-text' type='text' required name='component_id' value='{$supplier['component_id']}'/>
                            
                        ";
                    }
                echo '<br><br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $component_id=$_POST['component_id'];
                    
                    mysqli_query($conn, "UPDATE `DeviceComponents` SET `component_id` = '$component_id'  where device_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
						</section>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM DeviceComponents WHERE device_id = {$_GET['del_id']}");        
                }   
            ?>
