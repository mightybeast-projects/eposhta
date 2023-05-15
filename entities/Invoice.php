<?php
	class Invoice implements \JsonSerializable{
        public $id;
        public $number;
        private $senderAddr;
        private $receiverAddr;
        public $deliveryPrice;
        public $payedBy;
        private $sent;
        private $delivered;
        private $received;
        public $senderId;
        private $sender;
        private $receiver;
        public $receiverId;
        private $sendDate;
        private $deliverDate;
        private $receiveDate;
        public $sendDepartment;
        public $deliverDepartment;
        private $packageId;
        public $package;
		
        public function __construct($id, $number, $senderAddr, $receiverAddr, $deliveryPrice, $payedBy, $sent, $delivered, $received, 
                                    $senderId, $receiverId, $sendDate, $receiveDate, $sendDepartment, $deliverDepartment, $packageId){
            $this->id = $id;
            $this->number = $number;
            $this->senderAddr = $senderAddr;
            $this->receiverAddr = $receiverAddr;
            $this->deliveryPrice = $deliveryPrice;
            $this->payedBy = $payedBy;
            $this->sent = $sent;
            $this->delivered = $delivered;
            $this->received = $received;
            $this->senderId = $senderId;
            $this->receiverId = $receiverId;
            $this->sendDate = $sendDate;
            $this->deliverDate = $sendDate;
            $this->receiveDate = $receiveDate;
            $this->sendDepartment = $sendDepartment;
            $this->deliverDepartment = $deliverDepartment;
            $this->packageId = $packageId;
        }
        
        public function getId(){
            return $this->id;
        }

        public function getNumber(){
            return $this->number;
        }
        
        public function getSenderAddr(){
            return $this->senderAddr;
        }

        public function getReceiverAddr(){
            return $this->receiverAddr;
        }

        public function getDeliveryPrice(){
            return $this->deliveryPrice;
        }

        public function getPayedBy(){
            return $this->payedBy;
        }

        public function isSent(){
            return $this->sent;
        }

        public function isDelivered(){
            return $this->delivered;
        }

        public function isReceived(){
            return $this->received;
        }

        public function getSender(){
            return $this->sender;
        }

        public function getReceiver(){
            return $this->receiver;
        }

        public function getSendDate(){
            return $this->sendDate;
        }

        public function getDeliverDate(){
            return $this->deliverDate;
        }

        public function getReceiveDate(){
            return $this->receiveDate;
        }

        public function getSendDepartment(){
            return $this->sendDepartment;
        }

        public function getDeliverDepartment(){
            return $this->deliverDepartment;
        }

        public function getPackageId(){
            return $this->packageId;
        }

        public function getSenderId(){
            return $this->senderId;
        }

        public function getReceiverId(){
            return $this->receiverId;
        }

        public function setPackage($package){
            $this->package = $package;
        }

        public function setSender($sender){
            $this->sender = $sender;
        }

        public function setReceiver($receiver){
            $this->receiver = $receiver;
        }

        public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}

        public function __toString(){
			return "Invoice:[id=".$this->id."]";
        }
	}
?>