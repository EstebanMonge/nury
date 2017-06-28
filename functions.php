<?php

        include 'database.php';

	function get_patient_data($id,$item) {
		$pdo = Database::connect();
                $sql="select * from patients_data where patient_id =".$id." AND item_id = ".$item;
                $q = $pdo->prepare($sql);
                $q->execute();
                $items=$q->fetchAll();
		return $items[0]['item_details'];
        }
	function draw_section($section,$id) {
	        $pdo = Database::connect();
		$sql="select * from patients_data where patient_id =".$id;
		$q = $pdo->prepare($sql);
		$q->execute();
		$items=$q->fetchAll();
		$sql= "select * from items where section_id=".$section.' and active = 1 order by sort ASC';
		$q = $pdo->prepare($sql);
		$q->execute();
		$html='';
		Database::disconnect();
		foreach ($q as $row) {
			$with_data=0;
			foreach ($items as $valores) {
				if ( $valores['item_id'] == $row['id']){
					$with_data=1;
					$item_details=$valores['item_details'];
					$item_value=$valores['item_value'];
				}
			}
			if ( $with_data == 1){
		                        $html.='<div class="row">
                	        	                <div class="col-md-3"><strong>'.$row['name'].': </strong></div>
                        	        	        <div class="col-md-3">';
					if ( $item_value=="no" ) {
                                		$html.='        <input type="radio" name="'.$row['id'].'" value="yes"> Sí
                                                		<input type="radio" name="'.$row['id'].'" value="no" checked> No';
					}
					else {
                                		$html.='        <input type="radio" name="'.$row['id'].'" value="yes" checked> Sí
                                                		<input type="radio" name="'.$row['id'].'" value="no"> No';
					}
                                	$html.='
						       	</div>
                                        		<div class="col-md-6">Detalles: <textarea class="form-control" rows="1" name="details'.$row['id'].'">'.$item_details.'</textarea></div>
                                		</div>';

			}
			else {
                		        $html.='<div class="row">
                                		        <div class="col-md-3"><strong>'.$row['name'].': </strong></div>
                                        		<div class="col-md-3">
                                                		<input type="radio" name="'.$row['id'].'" value="yes"> Sí
                                                		<input type="radio" name="'.$row['id'].'" value="no" checked> No
                                        		</div>
                                        		<div class="col-md-6">Detalles: <textarea class="form-control" rows="1" name="details'.$row['id'].'"></textarea></div>
                                        		<input type="hidden" name="state'.$row['id'].'" value="new">
                                		</div>';
			}
		}
		return $html;
	}

	function draw_encounter($id) {
	        $pdo = Database::connect();
		$sql="select * from encounters where patient_id =".$id." order by id DESC limit 4";
		$q = $pdo->prepare($sql);
		$q->execute();
		$items=$q->fetchAll();
		$html='<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
					Encuentro Actual</a>
				</h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse in">
				<div class="panel-body">
					<form action="add_encounter.php" class="register" method="POST">
						<div class="encounter">
						<h1>Padecimiento: </h1>
							<button class="add_field_button">Añadir padecimiento</button>
							<div><textarea class="form-control" rows="3" name="encounter[]"></textarea></div>
							<input type="hidden" name="id" value="'.$id.'">
							<input type="hidden" name="updated" value="'.date('Y-m-d G:i:s').'">
						</div>
						<h1>Tratamiento: </h1>
							<textarea class="form-control" rows="5" name="treatment"></textarea>';
							$html.=draw_exam(5);
							$html.='<div class="pull-right"><button type="submit" class="btn btn-primary">Guardar</button></div>
					</form>
				</div>
			</div>
		</div>';
		$collapse=2;
		foreach ($items as $row) {
			$html.='<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$collapse.'">
							Encuentro del '.$row['updated'].'</a>
						</h4>
					</div>
					<div id="collapse'.$collapse.'" class="panel-collapse collapse">
						<div class="panel-body">
						<h1>Padecimiento: </h1>';
                			$sql="select * from encounters_data where encounter_id =".$row['id']." order by id ASC";
                			$q = $pdo->prepare($sql);
                			$q->execute();
                			$items=$q->fetchAll();
					$item=1;
			                foreach ($items as $filas) {
						$html.='<p><b>Padecimiento '.$item.':</b> '.$filas['encounter_details'].'</p>';
						$item++;
					}
                			$sql="select * from treatments where encounter_id =".$row['id']." order by id ASC";
                			$q = $pdo->prepare($sql);
                			$q->execute();
                			$treatment=$q->fetchAll();
					$html.='<h1>Tratamiento: </h1><p>'.$treatment[0]['treatment_details'].'</p></div>
					</div>
 				 </div>';
			$collapse++;
		}
	Database::disconnect();
	$html.='</div>';
	return $html;
	}

	function draw_exam($section) {
	        $pdo = Database::connect();
		$sql= "select * from items where section_id=".$section.' and active = 1 order by sort ASC';
		$q = $pdo->prepare($sql);
		$q->execute();
		$html='';
		$html.='<h1>Examen físico:</h1>';
		Database::disconnect();
		foreach ($q as $row) {
		                        $html.='<div class="row">
                	        	                <div class="col-md-3"><strong>'.$row['name'].': </strong></div>
                        	        	        <div class="col-md-3">
                                				<input type="radio" name="'.$row['id'].'" value="anormal"> Anormal 
                                                		<input type="radio" name="'.$row['id'].'" value="normal" checked> Normal
                                	       		</div>
                                        		<div class="col-md-6">Detalles: <textarea class="form-control" rows="1" name="details'.$row['id'].'">'.$item_details.'</textarea></div>
                                		</div>';

			}
		return $html;
	}
?>
