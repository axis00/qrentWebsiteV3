<?php

	/**
    *   classes.php
    *
    *   A collection of classes meant to represent the objects from teh database
    *
    *   @author David Paul Brackin
    */

	class Item{

		private $num,$name,$desc,$brand,$owner,$rentPrice,$origPrice,$condition,$status;

		function __construct($itemRow){
			$this->num = $itemRow['itemno'];
			$this->name = $itemRow['itemName'];
			$this->desc = $itemRow['itemDescription'];
			$this->brand = $itemRow['itemBrand'];
			$this->owner = $itemRow['itemOwner'];
			$this->rentPrice = $itemRow['itemRentPrice'];
			$this->origPrice = $itemRow['itemOrigPrice'];
			$this->condition = $itemRow['itemCondition'];
			$this->status = $itemRow['retStatus'];
		}

		public function __get($property) {
		    if (property_exists($this, $property)) {
		      	return $this->$property;
		    }
		}

		public function __set($property, $value) {
		    if (property_exists($this, $property)) {
		      	$this->$property = $value;
		    }

		    return $this;
		}

		public function test(){
			echo $this->num;
		}

	}

?>