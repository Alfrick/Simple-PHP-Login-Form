<?php

//registration page

include 'index.php';

$mysqli_con = mysqli_connect('localhost', 'root','','the_database');

if(loggedIn()){

	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['firstname']) && isset($_POST['surname'])){

		
		$username = mysqli_real_escape_string($mysqli_con,$_POST['username']);
		$password = mysqli_real_escape_string($mysqli_con,$_POST['password']);
		$password_again = mysqli_real_escape_string($mysqli_con,$_POST['password_again']);
		$firstname = mysqli_real_escape_string($mysqli_con,$_POST['firstname']);
		$surname = mysqli_real_escape_string($mysqli_con,$_POST['password']);
		$password_hash = md5($password);

			if(!empty($username) && !empty($password) && !empty($password_again)
				&& !empty($firstname) && !empty($surname)){


				if(strlen($username)> 30 || strlen($password) > 30 || strlen($firstname) > 30 || strlen($surname) > 30){
				//for this to worrk, redefine variables as $username = $_POST['username'];
						echo 'Please keep to required length';
					
					}else{
						if($password!=$password_again){
								echo 'passwords do not match';
						}else{
							global $mysqli_con;
							$select = "SELECT username FROM users_logging WHERE username = '$username'";
							$query = mysqli_query($mysqli_con, $select);

							if(mysqli_num_rows($query) == 1){
								echo 'username '.$username.' already exists';
							}else{
								$insert = "INSERT INTO users_logging VALUES ('','$username','$password_hash','$firstname','$surname')";
								if($query = mysqli_query($mysqli_con, $insert)){
									header('Location: register_success.php');//or echo '';
								}else{
									echo 'registration unsuccessful';
								}
							}
					}
					}
			}else{
				echo 'all fields are required';
			}
	}

?>

<form action="pagethree.php" method="POST">

	Username:<br><input type="text" name = "username" maxlength = "30" value = "<?php   		
				if(!empty($_POST['username'])){
				$username = $_POST['username'];
				echo $username;
				}?>" /><br>
	Password:<br><input type="password" name="password"><br>
	Password Confirm:<br><input type="password" name="password_again"><br>
	Firstname:<br><input type="text" name="firstname" maxlength = "30" value = "<?php   		
				if(!empty($_POST['firstname'])){
				$firstname = $_POST['firstname'];
				echo $firstname;
				}?>" /><br>
	Surname:<br><input type="text" name="surname" maxlength = "30" value = "<?php   		
				if(!empty($_POST['surname'])){
				$surname = $_POST['username'];
				echo $surname;}?>" /><br>

			<br><input type="submit" value="Register"><br>
</form>


<?php

	echo 'Please register';
	

}else{
	echo 'You are already logged in';
}


?>
