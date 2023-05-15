<?php
	class Visit implements \JsonSerializable{
		private $id = 0;
        private $client;
        private $user;
        private $invoices;

        public $date;
        public $number;
        public $lastOperation;

		public function __construct($client, $user){
            $this->client = $client;
            $this->user = $user;
            $this->date = date("Y-m-d");
            $this->invoices = array();
        }

		public function SetId($id){
			$this->id = $id;
        }

        public function setUser($user){
            $this->user = $user;
        }
        
        public function setClient($client){
            $this->client = $client;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function setNumber($number){
            $this->number = $number;
        }

        public function getDate(){
            return $this->date;
        }

        public function getClient(){
            return $this->client;
        }

        public function getUser(){
            return $this->user;
        }

        public function getInvoices(){
            return $this->invoices;
        }

        public function getNumber(){
            return $this->number;
        }

        public function addInvoice($invoice){
            array_push($this->invoices, $invoice);
        }

        public function setInvoices($invoices){
            $this->invoices = $invoices;
        }

        public function setLastOperation($lastOperation){
            $this->lastOperation = $lastOperation;
        }

        public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}

		public function __toString(){
			return "Visit:[id=".$this->id.", client=".$this->client.", user=".$this->user.", invoices=".count($this->invoices)."]";
		}
	}
?>