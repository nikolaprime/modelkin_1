<?php
		include('pages/header.php');
		?>
		<div class="log-in" style="
    margin-right: auto;
    margin-left: auto;
    width: 500px;
    height: 500px;
    padding: 50px;
">
			<form action="php/login.php" method="POST">
				<div class="login">
					<label for="firstname">Email:</label>
					<input type="text" name="email" id="Order_number" placeholder="Email" > <br>
					<label for="status">Password:</label>
					<input type="password" name="password" id="status" placeholder="******" ><br>
					<input type="submit" name="login" id="status" value="Log in" style="margin-left: 59px;"><br><br>
					<a href="register.php">Зарегистрироваться</a>
				</div>
			</form>
		</div>

		<?php
		include('pages/footer.php');
		?>