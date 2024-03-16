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

   <h2>Device Manufacturers</h2>
        
                <table>
                    <tr class="naim_atribytov">
                        <th>technician_id</th>
                        <th>full_name</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Technicians";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Technicians" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['technician_id'] . "</td>";
                            echo "<td>" .  $supplier['full_name'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['technician_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['technician_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['full_name'])) ){
        $full_name=$_POST['full_name'];
        mysqli_query($conn, "INSERT INTO `Technicians` (`technician_id`, `full_name`) VALUES (NULL, '$full_name')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>full_name</p>
            <input class="form_for-text" type="text" name="full_name">
            
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Technicians where technician_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Technicians" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>full_name</p>
                            <input class='form_for-text' type='text' required name='full_name' value='{$supplier['full_name']}'/>
                            
                        ";
                    }
                echo '<br><br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $full_name=$_POST['full_name'];
                    
                    mysqli_query($conn, "UPDATE `Technicians` SET `full_name` = '$full_name'  where technician_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
						</section>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Technicians WHERE technician_id = {$_GET['del_id']}");        
                }   
            ?>
