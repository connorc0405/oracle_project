<?php
	class Database {
		// var $link = mysqli_connect("localhost","root","","StudentDatabase");
		function Database(){}
		
		/*
		 * Connects to the Student Database
		*/
		public function connect(){
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			if(! $link) {
				die("died" . mysql_error());
			}
			else {
				echo("Connected to database.");
			}
		}

		/*
		 * Selects a database given a name
		*/
		public function selectDatabase($name){
			mysql_select_db($name);
		}

		/*
		 * Creates the student table
		*/
		public function createStudentTable(){
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			mysqli_query($link, "CREATE TABLE students (student_id INT(6) PRIMARY KEY, 
								fname VARCHAR(30) NOT NULL, lname VARCHAR(30) NOT NULL, 
								gender VARCHAR(6) NOT NULL, homeroom VARCHAR(30) NOT NULL, 
								gradyear INT(4) NOT NULL, dob DATE NOT NULL, classes VARCHAR(30),
								active_status BIT NOT NULL, img_path VARCHAR(256))")
								or die(mysql_error($link));
			echo "Table Edit Successful";
		}

		/*
		 * Checks to see if a table is in the StudentDatabase database
		*/
		public function table_exists($table){
			$link = mysqli_connect("localhost","root","","StudentDatabase");
		    if (mysql_query("SELECT 1 FROM `".$table."` LIMIT 0")) { 
				return true; 
		    } 
		    else { 
			    return false; 
		    } 
		}

		/*
		 * Returns individual rows from the courses table in StudentDatabase
		*/
		public function getCourses(){
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			$sql = "Select * from courses where course_id=(
					Select max(course_id) From courses)";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			return $row;
		}
		
	}
?>