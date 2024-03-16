<?php
include('pages/header.php');
?>
<div class="log-in"  style="
    margin-right: auto;
    margin-left: auto;
    width: 500px;
    height: 500px;
    padding: 50px;
">
	<form action="php/register.php" method="POST">
		<div class="login">
			<label for="name">ФИО</label><br>
			<input type="text" required id="name" name="name"><br>
			<label for="tel">Номер телефона</label><br>
			<input type="text" required id="tel" name="number"><br>
			<label for="email">Email</label><br>
			<input type="text" required id="email" name="email"><br>
			<label for="password">Пароль</label><br>
			<input type="password" required id="password" name="password"><br><br>
			<button name="registration">Зарегистрироваться</button>
		</div>
	</form>
</div>

<?php
include('pages/footer.php');
?>