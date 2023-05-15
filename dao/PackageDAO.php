<?php
    include "../entities/Package.php"; 

    header('Content-Type: text/html; charset=utf-8');

	class PackageDAO{

		private $dbConnection;
		
		public function __construct(){
            $this->dbConnection = mysqli_connect('localhost', 'root', '', 'eposhta');
		}

		public function insert($package){
            $type = $package->getType();
            $description = $package->getDescription();
            $price = $package->getPrice();
            $dimensions = $package->getDimensions();
            $weight = $package->getWeight();

			$query = "INSERT INTO packages (package_id, type, description, price, dimensions, weight, wrapping_id) 
								VALUES ('NULL', '".$type."', '".$description."', '".$price."', '".$dimensions."', '".$weight."', 1)";
            $this->dbConnection->query($query);
        }

        public function select($packageId){
            $query = "SELECT * FROM packages";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
			 		if($row[0] == $packageId){
			 			return new Package($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
			 		}
			 	}
		 	}
        }

        public function getConnection(){
            return $this->dbConnection;
        }
	}
?>