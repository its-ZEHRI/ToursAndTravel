<?php

class get_data{

	function __construct(){
		$servername = "localhost";
		$username = "asif";
		$password = "12345678";

		try {
		  $this->db = new PDO("mysql:host=$servername;dbname=tms", $username, $password);
		  // set the PDO error mode to exception
		  $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  // echo "Connection Successfull ";
		  
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		}
	}



function tblusersup(){
session_start();
error_reporting(0);
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(?,?,?,?)";
$query = $this->db->prepare($sql);
// $query->bindParam(':fname',$fname,PDO::PARAM_STR);
// $query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
// $query->bindParam(':email',$email,PDO::PARAM_STR);
// $query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute(array($fname, $mnumber, $email, $password));
$lastInsertId = $this->db->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="You are Scuccessfully registered. Now you can login ";
header('location:../thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:../thankyou.php');
}
}


function tblusers() {
session_start();

$email=$_POST['email'];
$password=md5($_POST['password']);
if(empty($email) || empty($password)){
	return "Please, Enter email and password";
			}
$sql ="SELECT id, FullName, EmailId, Password FROM tblusers WHERE EmailId=? AND Password=?";
$query= $this->db->prepare($sql);
// $query-> bindParam(':fname', $name, PDO::PARAM_STR);
// $query-> bindParam(':email', $email, PDO::PARAM_STR);
// $query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute(array($email, $password));	
$results=$query->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $key => $value){
        $id =  $value['id'];
        $name= $value['FullName'];
    }
    $_SESSION['id'] = $id;
    $_SESSION['name']= $name;
echo "<script type='text/javascript'> document.location = '../myprofile.php'; </script>";
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];
} else{
	
	echo "<script>alert('Invalid Details');</script>";
}
}






	// add user profile like pictures
	function add_user_profile(){
	$title=$_POST['title'];
	$picture=$_POST['picture'];
	$id=$_SESSION['id'];
	$query="INSERT INTO userprofile(title, photos, user_id) VALUES(?,?,?)";
    $stmt= $this->db->prepare($query);
	$stmt->execute(array($title, $picture, $id));
    return "ok";
	}

	function show_user_profile(){
		$id=$_SESSION['id'];
	        $query= "SELECT * FROM userprofile WHERE user_id=?";
			$stmt=$this->db->prepare($query);
			$stmt->execute(array($id));
			if($stmt->rowCount()<1){
			   return [];
			}else{
				return 	$stmt->fetchAll(PDO::FETCH_OBJ);
			}

        }

    function delete_user_photo(){
		$id=$_POST['userphoto'];
		$query="DELETE FROM userprofile WHERE id = ?";
		$stmt=$this->db->prepare($query);
		$stmt->execute(array($id));
		return "Record Deleted Successfully";
		}

    function newsfeed(){
        // $id=$_SESSION['id'];
    	$query="SELECT * FROM tblusers join userprofile ON tblusers.id=userprofile.user_id";
    	$stmt=$this->db->prepare($query);
    	$stmt->execute();
    	if($stmt->rowCount()<1){
    		return [];
    	}else{
    		return $stmt->fetchAll(PDO::FETCH_OBJ);
    	}
    	
    }

}

?>