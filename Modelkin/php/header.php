<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/indexx.css">
	<title>Modelkin</title>
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="nav">
				<ul>
					<li class="logo"><a href="../index.php"><img src="../img/logo.png" alt="" class="logo"></a></li>
					<li class="li_main"><a href="../about_us.php"> about us</a></li>
					<li class="li"><a href="../services.php">services</a></li>
					<li class="li"><a href="../faq.php">FAQ</a></li>
					<li class="li"><a href="../news.php">news</a></li>
                    <?php 
					session_start();
					require_once('bd.php');
                   if (isset($_SESSION['login_user'] )) {
                    $user_check = $_SESSION['login_user'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
                    $rows = mysqli_fetch_array($query);
                    $status = $rows['admin'];
                    $id_user = $rows['id_user'];
                    if($status ==1){
                        // header("Location: ../account/admin.php");
                        $admin = '<li class="login"><a href="../account/admin.php"><img src="img/login.png" alt="" class="login"></a></li>';
                    }else{
                        $admin = '<li class="login"><a href="account.php"><img src="img/login.png" alt="" class="login"></a></li>';
                    }
                    
                    echo  $admin;
                }  else{
                    echo '<li class="login"><a href="../lk.php"><img src="img/login.png" alt="" class="login"></a></li>';
                }
                  ?>
					<!-- <li class="login"><a href="../lk.php"><img src="img/login.png" alt="" class="login"></a></li> -->
                    <li class="li"><a href="exit.php">Выйти</a></li>
				</ul>
			</div>
		</div>
    </header>
     
        