<?php
	include "../entities/Invoice.php"; 
	include "../dao/PackageDAO.php"; 

    header('Content-Type: text/html; charset=utf-8');

	class InvoiceDAO{

		private $dbConnection;
		public $packageDAO;
		
		public function __construct(){
			$this->dbConnection = mysqli_connect('localhost', 'root', '', 'eposhta');
			$this->packageDAO = new PackageDAO();
		}

		public function insert($invoice){
        	$number = $invoice->getNumber();
        	$senderAddr = $invoice->getSenderAddr();
        	$receiverAddr = $invoice->getReceiverAddr();
			$deliveryPrice = $invoice->getDeliveryPrice();
			$payedBy = $invoice->getPayedBy();
			$sent = $invoice->isSent();
			$delivered = $invoice->isDelivered();
			$received = $invoice->isReceived();
			$sender = $invoice->getSenderId();
			$receiver = $invoice->getReceiverId();
			$sendDate = $invoice->getSendDate();
			$deliverDate = $invoice->getDeliverDate();
			$receiveDate = $invoice->getReceiveDate();
			$sendDepartment = $invoice->getSendDepartment();
			$deliverDepartment = $invoice->getDeliverDepartment();
			$packageId = $invoice->getPackageId();

			$query = "INSERT INTO invoices (invoice_id, number, sender_addr, receiver_addr, delivery_price, payed_by, sent, delivered, received, sender_id, receiver_id, send_date, deliver_date, receive_date, send_department, deliver_department, package_id) 
								VALUES ('NULL', '".$number."', '".$senderAddr."', '".$receiverAddr."', '".$deliveryPrice."', '".$payedBy."', '".$sent."' , '".$delivered."', '".$received."', '".$sender."', '".$receiver."', '".$sendDate."', '".$deliverDate."', '".$receiveDate."', '".$sendDepartment."', '".$deliverDepartment."', '".$packageId."')";
			$this->dbConnection->query($query);
		}
		
		public function getAllByReceiverId($receiverId){
			$invoices = [];
            $query = "SELECT * FROM invoices";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
					$receiverRow = $row[10];
					$receivedRow = $row[8];
					$received = boolval($receivedRow);
                    if($receiverRow == $receiverId && !$received){
						array_push($invoices, 
									new Invoice($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], 
												$row[6], $row[7], $row[8], $row[9], $row[10], $row[11],
												$row[13], $row[14], $row[15], $row[16]));
                    }
			 	}
			}
			return $invoices;
		}

		public function getAllBySenderId($senderId){
			$invoices = [];
            $query = "SELECT * FROM invoices";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
					$senderRow = $row[9];
					$sentRow = $row[6];
					$sent = boolval($sentRow);
                    if($senderRow == $senderId && !$sent){
						array_push($invoices, 
									new Invoice($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], 
												$row[6], $row[7], $row[8], $row[9], $row[10], $row[11],
												$row[13], $row[14], $row[15], $row[16]));
                    }
			 	}
			}
			return $invoices;
		}

		public function selectByNumber($invoiceNumber){
            $query = "SELECT * FROM invoices";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	while ($row = mysqli_fetch_row($result)) {
					$dbInvoiceNumber = $row[1];
                    if($dbInvoiceNumber == $invoiceNumber){
						$invoice =  new Invoice($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], 
												$row[6], $row[7], $row[8], $row[9], $row[10], $row[11],
												$row[13], $row[14], $row[15], $row[16]);
						$invoice->setPackage($this->packageDAO->select($invoice->getPackageId()));

						return $invoice;
                    }
			 	}
			}
			return null;
		}

		public function getLastNumber(){
			$query = "SELECT * FROM invoices ORDER BY invoice_id DESC LIMIT 1";
			if ($result = mysqli_query($this->dbConnection, $query)) {
			 	return mysqli_fetch_row($result)[1];
			}
		}
	}
?>