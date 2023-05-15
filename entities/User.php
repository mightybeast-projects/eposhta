<?php
	class User{
		private $id;
		private $fullName;
		private $username;
		private $password;
		private $position;
		private $departmentId;
		private $visitsCounter = 0;

		public function __construct($id, $fullName, $username, $password, $position, $departmentId){
			$this->id = $id;
			$this->fullName = $fullName;
			$this->username = $username;
			$this->password = $password;
			$this->position = $position;
			$this->departmentId = $departmentId;
		}

		public function addVisitsCounter(){
			$this->visitsCounter++;
		}

		public function getId(){
			return $this->id;
		}

		public function getFullName(){
			return $this->fullName;
		}

		public function getUsername(){
			return $this->username;
		}

		public function getPassword(){
			return $this->password;
		}

		public function getPosition(){
			return $this->position;
		}

		public function getDepartmentId(){
			return $this->departmentId;
		}

		public function getVisitsCounter(){
			return $this->visitsCounter;
		}

		public function __toString(){
			return "User:[id=".$this->id.", username=".$this->username.", password=".$this->password.", fullName=".$this->fullName."]";
		}
	}
?>