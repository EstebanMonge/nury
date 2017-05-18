<?php

        include 'database.php';

	$updated=$_POST["updated"];
	$fname=$_POST["fname"];
	$mname=$_POST["mname"];
	$lname=$_POST["lname"];
	$fphone=$_POST["fphone"];
	$id=$_POST["id"];
	$sphone=$_POST["sphone"];
	$birthdate=$_POST["birthdate"];
	$address=$_POST["address"];
	$occupation=$_POST["occupation"];
	$civilstate=$_POST["civilstate"];
	$height=$_POST["height"];
	$weight=$_POST["weight"];
	$imc=$_POST["imc"];


        $pdo = Database::connect();
        $sql= "INSERT INTO patients (updated,id,fname,mname,lname,fphone,sphone,birthdate,address,occupation,civilstate,height,weight,imc) VALUES ('".$updated."',".$id.",'".$fname."','".$mname."','".$lname."',".$fphone.",".$sphone.",'".$birthdate."','".$address."','".$occupation."','".$civilstate."',".$height.",".$weight.",".$imc.")";
        $q = $pdo->prepare($sql);
        $q->execute();

	$sql= "SELECT * FROM items WHERE active = 1 ORDER BY sort ASC";
	$q = $pdo->prepare($sql);
        $q->execute();
	foreach ($q as $row) {
		$item_id=$row['id'];
		$iteam_value=$_POST[$row['id']];
		$item_details=$_POST["details".$row['id']];
		if ( $item_details != "" || $item_details == "yes") {
			$sql="INSERT INTO patients_data (patient_id,item_id,item_value,item_details) VALUES (".$id.",".$item_id.",'".$iteam_value."','".$item_details."')";
			echo $sql;
			$q = $pdo->prepare($sql);
        		$q->execute();
		}
	}

	Database::disconnect();
	header("Location: search.php?id=".$id);
?>
