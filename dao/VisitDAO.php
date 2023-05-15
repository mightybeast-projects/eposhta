<?php
    include "../entities/Visit.php";
    include "../dao/ClientDAO.php";
    include "../dao/UserDAO.php";
    include "../entities/Invoice.php";
    header('Content-Type: text/html; charset=utf-8');

	class VisitDAO{

        private $dbConnection;
        private $userDao;
        private $clientDAO;
		
		public function __construct(){
            $this->dbConnection = mysqli_connect('localhost', 'root', '', 'eposhta');
            $this->userDao = new UserDAO();
            $this->clientDao = new ClientDAO();
		}

		public function insert($visit){
            echo $visit;
            $clientId = $visit->getClient()->getId();
            $userId = $visit->getUser()->getId();
            $visitNumber = $visit->getNumber();
            $date = $visit->getDate();
            $operationType = $_SESSION["current_operation"];
			$query = "INSERT INTO visits (visit_id, visit_number, user_id, client_id, date, operation_type) 
                                VALUES ('NULL', '".$visitNumber."', '".$userId."', '".$clientId."', '".$date."', '".$operationType."')";
			$this->dbConnection->query($query);
        }

        public function selectAllByUserId($userId){
            $visits = [];
            $date = date("Y-m-d");
            $query = "SELECT * FROM visits";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
                    $numberRow = $row[1];
                    $userRow = $row[2];
                    $clientRow = $row[3];
                    $dateRow = $row[4];
                    if($userRow == $userId && $dateRow == $date){
                        $client = $this->clientDao->selectById($clientRow);
                        $user = $this->userDao->selectById($userRow);
                        $visit = new Visit($client, $user);
                        $visit->setId($row[0]);
                        $visit->setNumber($numberRow);
                        $visit->setDate($dateRow);
                        $visit->setLastOperation($row[5]);
						array_push($visits, $visit);
                    }
			 	}
			}
			return $visits;
        }

        public function sentPackages($senderId){
			$query = "UPDATE invoices
					SET sent = 1
                    WHERE sender_id = ".$senderId.";";
            $this->dbConnection->query($query);
		}

        public function receivedPackages($receiverId){
			$query = "UPDATE invoices
					SET received = 1
                    WHERE receiver_id = ".$receiverId.";";
            $this->dbConnection->query($query);
		}
	}
?>