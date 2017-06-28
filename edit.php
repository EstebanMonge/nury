<?php

        include 'database.php';

	$updated=$_POST["updated"];
	$fname=$_POST["fname"];
	$mname=$_POST["mname"];
	$lname=$_POST["lname"];
	$fphone=$_POST["fphone"];
	$id=$_POST["id"];
	if ($_POST["129"] != '')
	{
		$antecedentesquirurgicos=$_POST["129"];
	}
	else {
		$antecedentesquirurgicos="''";
	}
	if ($_POST["130"] != '')
	{
		$antecedentesheredofamiliares=$_POST["130"];
	}
	else {
		$antecedentesheredofamiliares="''";
	}
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
        $sql= "INSERT INTO patients (updated,id,fname,mname,lname,fphone,sphone,birthdate,address,occupation,civilstate,height,weight,imc) VALUES ('".$updated."',".$id.",'".$fname."','".$mname."','".$lname."',".$fphone.",".$sphone.",'".$birthdate."','".$address."','".$occupation."','".$civilstate."',".$height.",".$weight.",".$imc.")";
        $q = $pdo->prepare($sql);
	$q->execute();

	$sql= "SELECT * FROM items WHERE active = 1 AND section_id IN (1, 2, 4) ORDER BY sort ASC";
	$q = $pdo->prepare($sql);
        $q->execute();
	foreach ($q as $row) {
		$item_id=$row['id'];
		$item_value=$_POST[$row['id']];
		$item_details=$_POST["details".$row['id']];
		if ( $item_details != "" || $item_details == "yes") {
			$sql="INSERT INTO patients_data (patient_id,item_id,item_value,item_details) VALUES (".$id.",".$item_id.",'".$item_value."','".$item_details."')";
			$q = $pdo->prepare($sql);
        		$q->execute();
		}
	}
        $sql= "INSERT INTO patients_data (patient_id,item_id,item_details,item_value) VALUES ('".$id.",129,'".$antecedentesquirurgicos."','')";
        $sql= "INSERT INTO patients_data (patient_id,item_id,item_details,item_value) VALUES (".$id.",130,'".$antecedentesquirurgicos."','')";

	Database::disconnect();
	header("Location: search.php?id=".$id);
?>
