<?php
	include "../entities/User.php";

	class UserDAO{

		private $dbConnection;
		
		public function __construct(){
			$this->dbConnection = mysqli_connect('localhost', 'root', '', 'eposhta');
		}

		public function insert($user){
			$fullName = $user->getFullName();
			$username = $user->getUsername();
			$password = $user->getPassword();
			$position = $user->getPosition();
			$department = $user->getDepartment();
			$query = "INSERT INTO users (user_id, full_name, username, password, position, department_id) 
								VALUES ('NULL', '".$fullName."', '".$username."', '".$password."', '".$position."', '".$department."')";
			$this->dbConnection->query($query);
		}

		public function selectById($userId){
			$query = "SELECT * FROM users";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
                     $idRow = $row[0];
                     if($idRow == $userId){
                        return new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                     }
			 	}
            }
        }

		public function selectByUsername($username){
			$query = "SELECT * FROM users";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
			 		if($row[2] == $username){
			 			return new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
			 		}
			 	}
		 	}
		}
	}
?>