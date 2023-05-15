<?php
	class Client implements \JsonSerializable{
		private $id;
		public $fullName;
		private $phoneNumber;
		private $isIndividual;

		public function __construct($id, $fullName, $phoneNumber){
			$this->id = $id;
			$this->fullName = $fullName;
			$this->phoneNumber = $phoneNumber;
			$this->isindividual = true;
		}

		public function SetId($id){
			$this->id = $id;
		}

		public function setCompany($isCompany){
			$this->isIndividual = false;
			$this->isCompany = $isCompany;
		}

		public function getId(){
			return $this->id;
		}

		public function getFullName(){
			return $this->fullName;
		}

		public function getPhoneNumber(){
			return $this->phoneNumber;
		}

		public function isIndividual(){
			return $this->isIndividual;
		}

		public function isCompany(){
			return $this->isCompany;
		}

		public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}

		public function __toString(){
			return "Client:[id=".$this->id.", fullName=".$this->fullName.", phoneNumber=".$this->phoneNumber."]";
		}
	}
?>