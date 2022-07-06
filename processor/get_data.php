<?php

class get_data
{
	function __construct()
	{
		$servername = "localhost";
		$username = "ZEHRI";
		$password = "ijaz1234";
		try {

			$this->db = new PDO("mysql:host=$servername;dbname=toursandtravels", $username, $password);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "Connection Successfull ";

		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	function userRegister()
	{
		try {
			session_start();
			error_reporting(0);
			$name = $_POST['name'];
			$contact = $_POST['number'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$c_password = $_POST['c_password'];

			// $image = $_FILES["image"]["name"];

			$filename = $_FILES["image"]["name"];
			$tempname = $_FILES["image"]["tmp_name"];
			$folder = "../images/" . $filename;

			// VALIDATION
			if (!preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
				return "Please Enter a valid Name";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "You have entered an invalid email";
			}

			if (!preg_match("/^[0-9]{11}+$/", $contact)) {
				return "Please enter a valid contact number e.g. 0313XXXXXXX";
			}

			if ($password != $c_password)
				return "password confirmation does not match.";

			$password = md5($_POST['password']);

			$check = $this->db->prepare("SELECT FullName FROM users WHERE EmailId = ? LIMIT 1");
			$check->execute(array($email));
			if ($check->rowCount() == 1)
				return "Email already registered";

			if (move_uploaded_file($tempname, $folder)) {
			}
				// return " Failed to upload image..";

			// move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);
			$query = "INSERT INTO  users(FullName,MobileNumber,EmailId ,image,Password) VALUES(?,?,?,?,?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($name, $contact, $email, $filename, $password));

			$query = "SELECT * FROM users WHERE EmailId=? LIMIT 1";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($email));
			$user =  $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($user as $key => $value) {
				$id =  $value['id'];
				$name = $value['FullName'];
				$image = $value['image'];
			}
			session_name("travel");
			session_start();

			$_SESSION['id'] = $id;
			$_SESSION['image'] = $image;
			$_SESSION['user_name'] = $name;
			$_SESSION['user_logged_in'] = true;

			header('location:../index.php');
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	function userLogin()
	{
		try {
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			// $password = $_POST['password'];

			if (empty($email) || empty($password)) {
				return "Please, Enter email and password";
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return "You have entered an invalid email";
			}

			$query = "SELECT * FROM users WHERE EmailId=? AND Password=?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($email, $password));

			if ($stmt->rowCount() != 1) {
				return "Invalid Credentials";
			}
			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($user as $key => $value) {
				$id =  $value['id'];
				$name = $value['FullName'];
				$image = $value['image'];
			}

			session_name("travel");
			session_start();

			$_SESSION['id'] = $id;
			$_SESSION['image'] = $image;
			$_SESSION['user_name'] = $name;
			$_SESSION['user_logged_in'] = true;

			header('location:../index.php');
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	// add user posts
	function addPost()
	{
		$id = $_SESSION['id'];
		$description = $_POST['description'];
		$filename = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$folder = "images/" . $filename;

		if (move_uploaded_file($tempname, $folder)) {
		} else
			return " Failed to upload image..";

		try {
			$query = "INSERT INTO posts(description, p_image, user_id) VALUES(?,?,?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($description, $filename, $id));
			return "ok";
		} catch (\Throwable $th) {
			var_dump($th->getMessage());
		}
	}
	function getPosts()
	{
		try {
			$query = "SELECT u.FullName, u.image , p.* FROM users u join posts p ON u.id = p.user_id ORDER BY p.id DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			if ($stmt->rowCount() < 1)
				return [];
			else
				return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	function getUserPost()
	{
		$id = $_SESSION['id'];
		$query = "SELECT * FROM posts WHERE user_id=?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		if ($stmt->rowCount() < 1) {
			return [];
		} else {
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	function getUser()
	{
		$id = $_SESSION['id'];
		$query = "SELECT * FROM users WHERE id=?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		if ($stmt->rowCount() < 1) {
			return [];
		} else {
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	function deletePost()
	{
		$id = $_POST['post_id'];
		$query = "DELETE FROM posts WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		return "Record Deleted Successfully";
	}

	// update profile image
	function updateProfileImage()
	{
		$filename = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$folder = "images/" . $filename;

		if (move_uploaded_file($tempname, $folder)) {
		} 
		// echo '<pre>' . var_export('Image updated failed', true) . '</pre>';

		$id = $_SESSION['id'];
		$query = "UPDATE users Set `image` = ? WHERE id = ?";
		$stmt = $this->db->prepare($query);
		 $stmt->execute(array( $filename ,$id));
		$_SESSION['image'] =  $filename;
	}
	// update profile name
	function updateProfileName()
	{
		$id = $_SESSION['id'];
		$name = $_POST['name'];
		$query = "UPDATE users Set `FullName` = ? WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array( $name,$id));
		// echo '<pre>' . var_export('FullName updated Successfully', true) . '</pre>';
		return "Name updated Successfully";
	}

	function getComments($post_id)
	{
		try {
			$query = "SELECT c.comment, c.created_at, u.FullName, u.image FROM comments c JOIN users u WHERE c.post_id = $post_id and c.user_id = u.id ORDER BY created_at DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if ($stmt->rowCount() < 1) {
				return [];
			} else {
				return $stmt->fetchAll(PDO::FETCH_OBJ);

				// $data = $stmt->fetchAll(PDO::FETCH_OBJ);
				// echo '<pre>' . var_export($data, true) . '</pre>';
			}
		} catch (\Throwable $th) {
			var_dump($th->getMessage());
		}
	}

	// function getAuthUser($id){
	// 	try {
	// 		$query = "SELECT  FROM comments c JOIN users u WHERE c.post_id = $post_id and c.user_id = u.id ORDER BY created_at DESC";
	// 		$stmt = $this->db->prepare($query);
	// 		$stmt->execute();
	// 		if ($stmt->rowCount() < 1) {
	// 			return [];
	// 		} else {
	// 			return $stmt->fetchAll(PDO::FETCH_OBJ);

	// 			// $data = $stmt->fetchAll(PDO::FETCH_OBJ);
	// 			// echo '<pre>' . var_export($data, true) . '</pre>';
	// 		}
	// 	} catch (\Throwable $th) {
	// 		var_dump($th->getMessage());
	// 	}
	// }

	function addComment()
	{
		$user_id = $_POST['user_id'];
		$post_id = $_POST['post_id'];
		$comment = $_POST['comment'];

		if ($comment == "")
			return 'please enter comments';

		try {
			$query = "INSERT INTO comments(user_id,post_id,comment) VALUES(?,?,?)";
			$stmt = $this->db->prepare($query);
			$resp = $stmt->execute(array($user_id, $post_id, $comment));
			if ($resp)
				return 'ok';
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}
	function getSinglePostComments()
	{
		try {
			$post_id = $_POST['post_id'];

			$query =  "SELECT c.comment , u.FullName FROM comments c JOIN users u Where c.post_id = $post_id and c.user_id = u.id ORDER BY c.created_at DESC";
			$stmt = $this->db->prepare($query);
			$stmt->execute();

			if ($stmt->rowCount() < 1) {
				return [];
			} else
				return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

}