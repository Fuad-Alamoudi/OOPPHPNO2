<?php
	session_start();

	require_once './db/connected.php';
	require_once './class/user.php';

	if (isset($_SESSION['user'])) {
		header('Location: index.php');
	}

	// Check If User Coming From HTTP Post Request
	$db = new connectedDb("Productdb", "Producttb");

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['login'])) {

			$user = $_POST['email'];
			$pass = $_POST['password'];

			if($user=User::checkUser($user,$pass)){

				$_SESSION['user_id']=$user['id'];
				$_SESSION['user']=$user['name'];
				$_SESSION['type']=$user['type'];

				if($_SESSION['type']==1){
					header('Location: dashbord.php');
				exit;
				}
				header('Location: index.php');
				exit;
			}
	}
}
require_once './include/head.php';

?>

<div class="container login-page m-5 p-3">
	<h1 class="text-center">
		<span class="selected" data-class="login">Login</span> 
	</h1>
	<!-- Start Login Form -->
	<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<div class="input-container text-center w-50 mx-auto">
			<input 
				class="form-control m-2 " 
				type="text" 
				name="email" 
				autocomplete="off"
				placeholder="Type your email" 
				required />
		</div>
		<div class="input-container m-2 w-50 text-center mx-auto">
			<input 
				class="form-control" 
				type="password" 
				name="password" 
				autocomplete="new-password"
				placeholder="Type your password" 
				required />
		</div>
		<input class="btn btn-primary btn-block" name="login" type="submit" value="Login" />
	</form>
</div>