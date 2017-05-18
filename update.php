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
        $sql= "UPDATE patients SET updated='".$updated."',fname='".$fname."',mname='".$mname."',lname='".$lname."',fphone=".$fphone.",sphone=".$sphone.",birthdate='".$birthdate."',address='".$address."',occupation='".$occupation."',civilstate='".$civilstate."',height=".$height.",weight=".$weight.",imc=".$imc." WHERE id=".$id;
	echo $sql;
        $q = $pdo->prepare($sql);
        $q->execute();
	Database::disconnect();
	header("Location: search.php?id=".$id);
?>
