<?php
//displaying User's login details
$mysqli_con = mysqli_connect('localhost', 'root','','the_database');
	
$current_file = $_SERVER['SCRIPT_NAME'];

ob_start();
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_hash = md5($password);

		$query_select = "SELECT id FROM users_logging WHERE username='$username' AND password='$password_hash'";

		if($query = mysqli_query($mysqli_con, $query_select)){

			if(mysqli_num_rows($query)== 0){
				echo 'Invalid login details';
			}else if(mysqli_num_rows($query)==1){
				$user_id = mysqli_fetch_assoc($query);
				foreach($user_id as $data){
					$data;
				}
				$_SESSION['user_id'] = $data;
				//header('Location: index.php');
					if(isset($data) && !empty($data)){
						$firstname = getUserField('firstname');
						$surname = getUserField('surname');
					echo 'You are logged in ' .$firstname. ' ' .$surname. ' <a href="pagetwo.php">Logout</a><br>';
					
					}

			}
		}


	}else{
		echo 'Please provide username and password';
	}
}

function getUserField($field){
	global $mysqli_con;
	$sess = $_SESSION['user_id'];
	$select = "SELECT $field FROM users_logging WHERE id = '$sess'";
	if($query = mysqli_query($mysqli_con, $select)){
		if($query_result= mysqli_fetch_assoc($query)){
			foreach($query_result as $data){
				return $data;
			}
		}
	}
}


?>

<form action="<?php echo $current_file; ?>" method="POST">

Username:<input type="text" name="username" />
Password:<input type="password" name="password" />
			<input type="submit" value="Login" />
</form>

