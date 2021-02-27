<?php

class Entity {
	private $con. sqlData;

	public function __construct($con,$input){
		$this->con = $con;

		if (is_array($input)){
			$this->sqlData = $input;
		}
		else {
			$query = $this->con->prepare("SELECT * FROM entities WHERE id=:id");
			$query->bindValue("id",$input);
			$query->execute();
			$this->sqlData= $query->fetch(PDO::FETCH_ASSOC);
		
	}
}

?>