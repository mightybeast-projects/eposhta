<?php
	class Package implements \JsonSerializable{
        public $id;
        public $type;
        private $description;
        private $price;
        private $dimensions;
        public $weight;
        private $wrapping;
		
		public function __construct($id, $type, $description, $price, $dimensions, $weight, $wrapping){
            $this->id = $id;
            $this->type = $type;
            $this->description = $description;
            $this->price = $price;
            $this->dimensions = $dimensions;
            $this->weight = $weight;
            $this->wrapping = $wrapping;
        }
        
        public function getId(){
            return $this->id;
        }

        public function getType(){
            return $this->type;
        }

        public function getDescription(){
            return $this->description;
        }

        public function getPrice(){
            return $this->price;
        }

        public function getDimensions(){
            return $this->dimensions;
        }

        public function getWeight(){
            return $this->weight;
        }

        public function getWrapping(){
            return $this->wrapping;
        }

        public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}

        public function __toString(){
			return "Package:[id=".$this->id."]";
		}
	}
?>