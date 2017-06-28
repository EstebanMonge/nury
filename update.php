<?php

        include 'database.php';

	$updated=$_POST["updated"];
	$fname=$_POST["fname"];
	$mname=$_POST["mname"];
	$lname=$_POST["lname"];
	$fphone=$_POST["fphone"];
	$id=$_POST["id"];
        if ($_POST["sphone"] != '')
        {
                $sphone=$_POST["sphone"];
        }
        else {
                $sphone="''";
        }
	$birthdate=$_POST["birthdate"];
	$address=$_POST["address"];
        if ($_POST["occupation"] != '')
        {
                $occupation=$_POST["occupation"];
        }
        else {
                $occupation="''";
        }
	$civilstate=$_POST["civilstate"];
        if ($_POST["height"] != '')
        {
                $height=$_POST["height"];
        }
        else {
                $height="''";
        }
        if ($_POST["weight"] != '')
        {
                $weight=$_POST["weight"];
        }
        else {
                $weight="''";
        }
        if ($_POST["imc"] != '')
        {
                $imc=$_POST["imc"];
        }
        else {
                $imc="''";
        }

        $pdo = Database::connect();
        $sql= "UPDATE patients SET updated='".$updated."',fname='".$fname."',mname='".$mname."',lname='".$lname."',fphone=".$fphone.",sphone=".$sphone.",birthdate='".$birthdate."',address='".$address."',occupation='".$occupation."',civilstate='".$civilstate."',height=".$height.",weight=".$weight.",imc=".$imc." WHERE id=".$id;
        $q = $pdo->prepare($sql);
        $q->execute();


        $sql= "SELECT * FROM items WHERE active = 1 ORDER BY sort ASC";
        $q = $pdo->prepare($sql);
        $q->execute();
        foreach ($q as $row) {
                $item_id=$row['id'];
                $item_value=$_POST[$row['id']];
                $item_details=$_POST["details".$row['id']];
                $item_state=$_POST["state".$row['id']];
                if ( $item_details != "" || $item_value == "yes") {
			if ( $item_state == "new" ) {
                        	$sql="INSERT INTO patients_data (patient_id,item_id,item_value,item_details) VALUES (".$id.",".$item_id.",'".$item_value."','".$item_details."')";
                        	$q = $pdo->prepare($sql);
                        	$q->execute();
			}
			else {
                        	$sql="UPDATE patients_data SET item_value='".$item_value."', item_details='".$item_details."' WHERE patient_id = ".$id." AND item_id=".$item_id;
				echo $sql;
                        	$q = $pdo->prepare($sql);
                        	$q->execute();
			}
                }
        }

	Database::disconnect();

        header("Location: search.php?id=".$id);
?>
