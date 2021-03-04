<?php
class CategoryContainers {
	
	private $con;
	private $username;
	public function __construct($con, $username){
		$this->con = $con;
		$this->username = $username;
	}


	public function showAllCategory (){
		$query = $this->con->prepare("SELECT * FROM categories");
		$query->execute();

		$html="<div class='previewCategory'>";

		while ($row = $query->fetch(PDO::FETCH_ASSOC)){
			$html .=$row["name"];
		}

		return $html . "</div>";
	}
}
?>