<?php
	class Database {
		$link = mysqli_connect("localhost","root","","StudentDatabase");
		function Database(){}

		/*
		 * Connects to the Student Database
		*/
		public function connect() {
			$link = mysqli_connect("localhost","root","","StudentDatabase");

			if(! $link) {
				die("died" . mysql_error());
			}
		}

		/*
		 * Selects a database given a name
		*/
		public function selectDatabase($name) {
			mysql_query('USE StudentDatabase');
			// mysql_select_db($name);
		}

		/*
		 * Creates the student table with foreign key to the login_information table.  
		 *
		 * NEED TO FIX THE FOREIGN KEY VALUES --> TROY
		*/
		public function createStudentTable() {
			$link = mysqli_connect("localhost","root","","StudentDatabase");

			/* Checks to see if the student table exists. If not, it creates it. */
			if(Database::table_exists1('students', 'StudentDatabase')) {
				echo "Table already exists";
			}
			else {
				mysqli_query($link,"CREATE TABLE students (student_id INT(6) PRIMARY KEY, 
			 		fname VARCHAR(30) NOT NULL, lname VARCHAR(30) NOT NULL, 
			 		gender VARCHAR(6) NOT NULL, homeroom VARCHAR(30) NOT NULL, 
			 		gradyear INT(4) NOT NULL, dob DATE NOT NULL, classes VARCHAR(30),
			 		active_status BIT NOT NULL, img_path VARCHAR(256), account_id INT(4),
					CONSTRAINT fk_account_id FOREIGN KEY (account_id)
			 		REFERENCES login_information(id))")
				or die(mysqli_error($link));
				echo "Courses Table Created Successfully";
			}		
			echo "Table Edit Successful";
		}

		/*
		 * Checks to see if a table is in the StudentDatabase database
		*/
		public function table_exists($table) {
			$link = mysqli_connect("localhost","root","","StudentDatabase");
		    if (mysql_query("SELECT 1 FROM `".$table."` LIMIT 0")) { 
				return true; 
		    } 
		    else { 
			    return false; 
		    } 
		}

		public function table_exists1($table, $database) { 
						    mysql_connect('localhost', 'root', '') or die(mysql_error()); 
						    mysql_select_db($database) or die(mysql_error()); 
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
		public function getCourses() {
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			$sql = "SELECT * FROM courses WHERE course_id=(
					SELECT MAX(course_id) FROM courses)";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			return $row;
		}

		/* Gets the last entered student in the student table.  
		Maybe make another function to return an array of students, with each element being a row.  2d array */
		public function getStudents() {
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			$sql = "Select * from students where student_id=(
					Select max(student_id) From students)";
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			return $row;
		}

		/* Gets content with Devon's method */
		public function getContent($name) {
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			return $link->real_escape_string($name);
		}

		/* Adds a student to the student table.  ADD THE ACCOUNT_ID HERE */
		public function addStudent($student_id, $fname, $lname, $gender, $homeroom, $gradyear, $dob, $classes, $img_path) {
			$link = mysqli_connect("localhost","root","","StudentDatabase");
			mysqli_query($link,"INSERT INTO students (`student_id`, `fname`, 
				`lname`, `gender`, `homeroom`, `gradyear`, `dob`, `classes`, `active_status`,
				`img_path`)
			VALUES ('".$student_id."', '". $fname. "', '". $lname. "', '". $gender. "', 
				'". $homeroom. "', '". $gradyear. "', '". $dob. "',
				'". $classes. "', 'TRUE', '". $img_path. "')") 
			or die(mysqli_error($link));
		}
	}
?>