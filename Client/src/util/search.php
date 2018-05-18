<?php

	/**
	* 	search.php
	*
	*	Provides search functionality for the qrent.com
	*
	* 	@author David Paul Brackin
	*/

	require_once "connectToDb.php";

	/**
	*	@param string $query The query string that the query from the data base should 
	*	@return Array An array containing the item rows that match the query string
	*/
	function searchForItem($query){

		global $conn;

		$sql = "SELECT * from Item where match(itemName,itemDescription,itemBrand,itemOwner) against(?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s",$query);
		$stmt->execute();

		$result = $stmt->get_result();
		$res = array();

		for($i = 0; $row = $result->fetch_assoc(); $i++){
				$res[$i] = $row;
		}

		return $res;
	}

?>