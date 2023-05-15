<?php
    header('Content-Type: text/html; charset=utf-8');

	class DepartmentDAO{

		private $dbConnection;
		
		public function __construct(){
            $this->dbConnection = mysqli_connect('localhost', 'root', '', 'eposhta');
		}

		public function getDepartmentNumber($departmentId){
            $query = "SELECT * FROM departments";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
			 		if($row[0] == $departmentId){
			 			return $row[1];
			 		}
			 	}
		 	}
		}
		
		public function getDepartmentAddrByNumber($departmentNumber){
            $query = "SELECT * FROM departments";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
			 		if($row[1] == $departmentNumber){
			 			return $row[2];
			 		}
			 	}
		 	}
        }
	}
?>