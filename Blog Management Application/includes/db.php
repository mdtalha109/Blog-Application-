<?php

	$dsn = "mysql:host=localhost;dbname=techbarik";  //dsn- Data Source Name

	try {
		$pdo = new PDO($dsn, 'root', '');
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

?>