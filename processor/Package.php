<?php 
class Package{
    function __construct()
	{
		$servername = "localhost";
		$username = "asif";
		$password = "12345678";
		try {
			$this->db = new PDO("mysql:host=$servername;dbname=toursandtravels", $username, $password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}//End of constructor

    
	// Get all packages
	function get_packages()
	{
		$query = "SELECT * FROM packages";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() < 1) 
			return [];
		else
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);

	}

	// Get single package
	function get_package($id){
		$query = "SELECT * FROM packages WHERE PackageId = ? ";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array($id));
		// echo "<pre>" . var_export($stmt->fetchAll(PDO::FETCH_OBJ),true) . "</pre>";
		if ($stmt->rowCount() < 1) 
			return [];
		 else 
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		
	}

	function booking_request(){
		$package_id = $_POST['package_id'];
		$user_id = $_POST['user_id'];
		$comment = $_POST['comment'];

		try {
			$query = "INSERT INTO booking(package_id,user_id,comment) VALUES(?,?,?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($package_id,$user_id,$comment));
			return 'Your Booking Request Has Been added we will Contact you soon.';
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}

	function get_single_user_booking($user_id){
		// echo '<pre>' . var_export($user_id, true) . '</pre>';
		try {
			$query = "SELECT b.* , p.* from booking b join packages p on p.PackageId=b.package_id 
			          WHERE b.user_id= ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array($user_id));

			if($stmt->rowCount() < 1)
				return [];
			else
			return $stmt->fetchAll(PDO::FETCH_OBJ);
			// echo '<pre>' . var_export($stmt->fetchAll(PDO::FETCH_ASSOC), true) . '</pre>';
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
	}


}
