<?php
    include "../entities/Client.php";
    header('Content-Type: text/html; charset=utf-8');

	class ClientDAO{

		private $dbConnection;
		
		public function __construct(){
            $this->dbConnection = mysqli_connect('localhost', 'root', '', 'eposhta');
		}

		public function insert($client){
            $fullName = $client->getFullName();
            $phoneNumber = $client->getPhoneNumber();
			$query = "INSERT INTO clients (client_id, full_name, phone_number) 
								VALUES ('NULL', '".$fullName."', '".$phoneNumber."')";
			$this->dbConnection->query($query);
			$client->setId(mysqli_insert_id($this->dbConnection));
		}

		public function selectById($clientId){
			$query = "SELECT * FROM clients";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
                     $idRow = $row[0];
                     if($idRow == $clientId){
                        return new Client($row[0], $row[1], $row[2]);
                     }
			 	}
            }
        }

		public function selectByFullName($fullName){
			$query = "SELECT * FROM clients";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
			 		//TODO
			 	}
		 	}
        }
        
        public function selectByPhoneNumber($phoneNumber){
            $length = strlen($phoneNumber);
            $query = "SELECT * FROM clients";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
                     $rowPhone = substr($row[2], 0, $length);
                     if($rowPhone == $phoneNumber){
                         return new Client($row[0], $row[1], $row[2]);
                     }
			 	}
            }
		}

		public function selectByPhoneAndName($phoneNumber, $fullName){
			$query = "SELECT * FROM clients";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
					 $phoneRow = $row[2];
					 $fullNameRow = $row[1];
                     if($phoneRow == $phoneNumber && $fullNameRow == $fullName){
                         return new Client($row[0], $row[1], $row[2]);
                     }
				}
				$this->insert(new Client(0, $fullName, $phoneNumber));
				return $this->selectByPhoneAndName($phoneNumber, $fullName);
			}
		}
		
		public function selectAllByPhoneNumber($phoneNumber){
			$clients = [];
			$length = strlen($phoneNumber);
            $query = "SELECT * FROM clients";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
                     $rowPhone = substr($row[2], 0, $length);
                     if($rowPhone == $phoneNumber){
                         array_push($clients, new Client($row[0], $row[1], $row[2]));
                     }
			 	}
			}
			return $clients;
		}
	}
?>