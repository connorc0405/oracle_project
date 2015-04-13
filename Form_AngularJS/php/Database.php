<?php 
class Database{
	var $dbName = "ryan_student";
	function Database(){}

	/* Connects to the database */
	public function connect(){
		$dbconn = mysql_connect("localhost", "root", "");

		if(! $dbconn) {
			die("died" . mysql_error());
		}
		else {
			echo("Connected to database.");
		}
	}

	/* Selects the Database */
	public function selectDatabase($name){
		mysql_select_db($name);
	}

	/* Gets the total number of rows in the ryan_student table */
	public function getNumRows(){
		return mysql_num_rows(mysql_query("SELECT * FROM ryan_student"));
	}

	/* Will run any mysql query, but used for adding a row */
	public function addRow($query){
		mysql_query($query);
	}
}
?>