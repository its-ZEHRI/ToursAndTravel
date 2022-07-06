<?php 

class Package{
    function __construct()
	{
		$servername = "localhost";
		$username = "ZEHRI";
		$password = "ijaz1234";
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
		if ($stmt->rowCount() < 1) 
			return [];
		 else 
			return 	$stmt->fetchAll(PDO::FETCH_OBJ);
		
	}


}
