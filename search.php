<?php

        include 'database.php';
	$options = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
		)
	);
	if (isset($_GET["id"])) {
		$id=$_GET["id"];
	}
	else {
		$id=$_POST["id"];
	}
       	$sql= "SELECT * FROM patients WHERE id = ".$id;

        $pdo = Database::connect();
        $q = $pdo->prepare($sql);
        $q->execute();
	foreach ($q as $row) {
                            $data['updated']=$row['updated'];
                            $data['id']=$row['id'];
                            $data['fname']=$row['fname'];
                            $data['mname']=$row['mname'];
                            $data['lname']=$row['lname'];
                            $data['birthdate']=$row['birthdate'];
                            $data['fphone']=$row['fphone'];
                            $data['sphone']=$row['sphone'];
                            $data['address']=$row['address'];
                            $data['occupation']=$row['occupation'];
                            $data['height']=$row['height'];
                            $data['weight']=$row['weight'];
                            $data['civilstate']=$row['civilstate'];
			    $data['found']="found";
                            $data['imc']=$row['imc'];
                   }
	if (!isset($data['id'])) {
		$data['notfound']="notfound";
		$data['id']=$id;
	}
	Database::disconnect();
	$dataString=serialize($data);
	header("Location: edit_patient.php?data=".urlencode($dataString));
	die();
?>
