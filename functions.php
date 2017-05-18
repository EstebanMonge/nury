<?php

        include 'database.php';

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
                                	$html.='       	</div>
                                        		<div class="col-md-6">Detalles: <input type="text" name="details'.$row['id'].'" value="'.$item_details.'"></div>
                                		</div>';

			}
			else {
                		        $html.='<div class="row">
                                		        <div class="col-md-3"><strong>'.$row['name'].': </strong></div>
                                        		<div class="col-md-3">
                                                		<input type="radio" name="'.$row['id'].'" value="yes"> Sí
                                                		<input type="radio" name="'.$row['id'].'" value="no" checked> No
                                        		</div>
                                        		<div class="col-md-6">Detalles: <input type="text" name="details'.$row['id'].'"></div>
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
							<button class="add_field_button">Añadir padecimiento</button>
							<div><input type="text" name="encounter[]"></div>
						</div>
							<input type="hidden" name="id" value="'.$id.'">
							<input type="hidden" name="updated" value="'.date('Y-m-d G:i:s').'">
							<input class="submit" type="submit" value="Guardar" />
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
						<div class="panel-body">';
                			$sql="select * from encounters_data where encounter_id =".$row['id']." order by id ASC";
                			$q = $pdo->prepare($sql);
                			$q->execute();
                			$items=$q->fetchAll();
					$item=1;
			                foreach ($items as $filas) {
						$html.='<p><b>Padecimiento '.$item.':</b> '.$filas['encounter_details'].'</p>';
						$item++;
					}
					$html.='</div>
					</div>
 				 </div>';
			$collapse++;
		}
	Database::disconnect();
	$html.='</div>';
	return $html;
	}
?>
