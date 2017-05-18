<?php

        include 'database.php';

	$id=$_POST["id"];
	$updated=$_POST["updated"];
	$encounter=$_POST["encounter"];
	print_r($encounter);

        $pdo = Database::connect();
        $sql= "INSERT INTO encounters (updated,patient_id) VALUES ('".$updated."',".$id.")";
        $q = $pdo->prepare($sql);
        $q->execute();

	$sql= "SELECT id FROM encounters ORDER BY id DESC LIMIT 1";
	$q = $pdo->prepare($sql);
        $q->execute();
	foreach ($q as $row) {
		$encounter_id=$row['id'];
		foreach ($encounter as $item) {
		        $sql= "INSERT INTO encounters_data (encounter_id,encounter_details) VALUES (".$encounter_id.",'".$item."')";
			echo $sql;
		        $q = $pdo->prepare($sql);
		        $q->execute();
		}
	}

	Database::disconnect();
	header("Location: search.php?id=".$id);
?>
