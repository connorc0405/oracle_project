<html>
	<head>
		<title>Insert Student Spread Sheet</title>
	</head>

	<body>

		<?php

			$data = new Spreadsheet_Excel_Reader($_FILES['student_spreadsheet'],false);


		?>

		<center>
			<img src="AMSA_logo.jpg" style="width:500px;height:225px">
			<br>
			<h2 id="heading">Insert Student Spread Sheet</h2>
			<br>
		</center>

	</body>
</html>