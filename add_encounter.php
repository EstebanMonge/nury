<?php

        include 'database.php';

	$id=$_POST["id"];
	$updated=$_POST["updated"];
	$encounter=$_POST["encounter"];
	$treatment=$_POST["treatment"];

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
		        $q = $pdo->prepare($sql);
		        $q->execute();
		}
	}
        $sql= "INSERT INTO treatments (encounter_id,treatment_details) VALUES (".$encounter_id.",'".$treatment."')";
	$q = $pdo->prepare($sql);
        $q->execute();


        $sql= "SELECT * FROM items WHERE active = 1 AND section_id = 5 ORDER BY sort ASC";
        $q = $pdo->prepare($sql);
        $q->execute();
        foreach ($q as $row) {
                $item_id=$row['id'];
                $item_value=$_POST[$row['id']];
                $item_details=$_POST["details".$row['id']];
                if ( $item_details != "" || $item_details == "yes") {
                        $sql="INSERT INTO exams (encounter_id,item_id,item_value,item_details) VALUES (".$encounter_id.",".$item_id.",'".$item_value."','".$item_details."')";
                        $q = $pdo->prepare($sql);
                        $q->execute();
                }
        }


	Database::disconnect();
	header("Location: search.php?id=".$id);
?>
