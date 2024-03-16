<?php
include '../account/header.php';
?> 
    <?php
       require_once('../php/bd.php');
    ?>
		<section>
   <h2>Customers</h2>
        




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



                <table>
                    <tr class="naim_atribytov">
                        <th>customer_id</th>
                        <th>full_name</th>
                        <th>contact_info</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Customers";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Customers" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['customer_id'] . "</td>";
                            echo "<td>" .  $supplier['full_name'] . "</td>";
                            echo "<td>" .  $supplier['contact_info'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['customer_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['customer_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
          
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['full_name']) and !empty($_POST['contact_info']))){
        $full_name=$_POST['full_name'];
        $contact_info=$_POST['contact_info'];
        mysqli_query($conn, "INSERT INTO `Customers` (`customer_id`, `id_user`,`full_name`, `contact_info`) VALUES (null, 1, '$full_name', '$contact_info')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
        var_dump($_POST['full_name']);
        var_dump($_POST['contact_info']);
       
    }
}
?>
   
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>full_name</p>
            <input class="form_for-text" type="text" name="full_name">
            <p>contact_info</p>
            <input class="form_for-text" type="text" name="contact_info">
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
   
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Customers where customer_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Customers" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>full_name</p>
                            <input class='form_for-text' type='text' required name='full_name' value='{$supplier['full_name']}'/>
                            <p>contact_info</p>
                            <input class='form_for-text' type='text' required name='contact_info' value='{$supplier['contact_info']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $full_name=$_POST['full_name'];
                    $contact_info=$_POST['contact_info'];
                    mysqli_query($conn, "UPDATE `Customers` SET `full_name` = '$full_name', `contact_info` = '$contact_info' where customer_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
</section>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Customers WHERE customer_id = {$_GET['del_id']}");        
                }   
            ?>
       