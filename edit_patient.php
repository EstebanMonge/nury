
<?php
    include 'functions.php';
    $strenc2= $_GET['data'];
    $data = unserialize(urldecode($strenc2));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Electronic Health Record</title>

    <!-- Bootstrap core CSS -->
    <link href="jscss/bootstrap.min.css" rel="stylesheet">
    <link href="jscss/jquery-ui.min.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
      <div class="container">
        <div class="navbar-header">
          <button type"button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Electronic Health Record</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Search</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<?php
	if (isset($data['found'])) { 
		echo '<form action="update.php" method="post" id="patient">';
		echo '<div class="alert alert-success alert-dismissable">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>¡Encontrado!</strong> Puede leer la información o actualizar datos.
		</div>'; }
	else {
			echo '<form action="edit.php" method="post" id="patient">';
		if (isset($data['notfound'])) {
                	echo '<div class="alert alert-danger alert-dismissable">
                	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                	<strong>¡No se ha encontrado!</strong> Puede ingresar nuevos los datos.
                	</div>'; }
	}
?>
    <div class="container">
        <h1>Detalles del paciente:</h1>
	<div class="row">
		<div class="col-md-8"><strong>Fecha última actualización: </strong><?= $data['updated'] ?> </div>
	</div>
	<div class="row">
		<div class="col-md-8"><strong>Fecha actual: </strong><input type="text" id="updated" name="updated" value="<?= date("Y-m-d") ?>" required></div>
	</div>
	<div class="row">
		<div class="col-xs-6"><strong>Nombre: </strong><input type="text" name="fname" value="<?= $data['fname'] ?>" required></br><strong>Apellido 1: </strong><input type="text" name="mname" value="<?= $data['mname'] ?>" required></br><strong>Apellido 2: </strong><input type="text" name="lname" value="<?= $data['lname'] ?>" required></div>
		<div class="col-xs-6"><strong>Teléfono 1: </strong><input type="number" name="fphone" value="<?= $data['fphone'] ?>" required></div>
	</div>
	<div class="row">
		<div class="col-xs-6"><strong>Identificación: </strong><input type="number" name="id" value="<?= $data['id'] ?>" required></div>
		<div class="col-xs-6"><strong>Teléfono 2: </strong><input type="number" name="sphone" value="<?= $data['sphone'] ?>"></div>
	</div>
	<div class="row">
		<div class="col-xs-6"><strong>Fecha de nacimiento: </strong><input type="text" id="birthdate" name="birthdate" value="<?= $data['birthdate'] ?>"required></div>
		<div class="col-xs-6"><strong>Edad: </strong><input type="text" id="age"></div>
	</div>
	<div class="row">
		<div class="col-md-8"><strong>Dirección: </strong><input type="text" name="address"  value="<?= $data['address'] ?>" required></div>
	</div>
	<div class="row">
		<div class="col-xs-6"><strong>Ocupación: </strong><input type="text" name="occupation"  value="<?= $data['occupation'] ?>"></div>
		<div class="col-xs-6"><strong>Estado Civil: </strong>
			<select name="civilstate" required>
			<option value="Casado" <?php $selected=($data['civilstate'] == "Casado") ? 'selected="selected"' : ''; echo $selected; ?> >Casado</option>
			<option value="Soltero" <?php $selected=($data['civilstate'] == "Soltero") ? 'selected="selected"' : ''; echo $selected; ?>>Soltero</option>
			<option value="Unión Libre" <?php $selected=($data['civilstate'] == "Unión Libre") ? 'selected="selected"' : ''; echo $selected; ?>>Unión Libre</option>
			<option value="Divorciado" <?php $selected=($data['civilstate'] == "Divorciado") ? 'selected="selected"' : ''; echo $selected; ?> >Divorciado</option>
			<option value="Viudo" <?php $selected=($data['civilstate'] == "Viudo") ? 'selected="selected"' : ''; echo $selected; ?>>Viudo</option>
			</select> 
		</div>
	</div>
	<div class="row">
		<div class="col-md-4"><strong>Talla (cm): </strong><input type="number" name="height" value="<?= $data['height'] ?>"></div>
		<div class="col-md-4"><strong>Peso (kg): </strong><input type="number" name="weight" value="<?= $data['weight'] ?>"></div>
		<div class="col-md-4"><strong>IMC: </strong><input type="text" id="imc" ></div>
	</div>
    </div><!-- /.container -->
    <div class="container">
	<h1>Antecedentes Patológicos:</h1>
	<?php
		echo draw_section(1,$data['id']);
	?>
    </div><!-- /.container -->
    <div class="container">
	<h1>Antecedentes no patológicos:</h1>
	<?php
		echo draw_section(2,$data['id']);
	?>
	<div class="row">
		<div class="col-md-3"><strong>Vacunas: </strong></div>
		<div class="col-md-3">
			<input type="radio" name="nopatologico7" value="yes"> Sí
			<input type="radio" name="nopatologico7" value="no" checked> No
			<input type="hidden" name="hnopatologico7" value="7">
		</div>
		<div class="col-md-6">Detalles: <input type="text" name="detailsnopatologico7"></div>
	</div>
	<div class="row">
		<div class="col-md-4"><strong><input type="checkbox" name="nopatologico8" value="DT">DT</strong></div>
		<div class="col-md-4"><strong><input type="checkbox" name="nopatologico8" value="Infuenza">Influenza</strong></div>
		<div class="col-md-4"><strong><input type="checkbox" name="nopatologico8" value="Pneumo 23">Pneumo 23</strong></div>
	</div>
    </div><!-- /.container -->
    <div class="container">
	<h1>Antecedentes Quirúrgicos:</h1>
	<div class="row">
		<div class="col-md-8">
			<textarea class="form-control" rows="3" name="antecedentesquirurgicos">Escriba los detalles...</textarea>
		</div>
	</div>
    </div><!-- /.container -->
    <div class="container">
	<h1>Antecedentes Heredo Familiares:</h1>
	<div class="row">
		<div class="col-md-8">
			<textarea class="form-control" rows="3" name="antecedentesheredofamiliares">Escriba los detalles...</textarea>
		</div>
	</div>
    </div><!-- /.container -->
    <div class="container">
	<h1>Antecedentes Ginecoobstétricos:</h1>
	<?php
		echo draw_section(4,$data['id']);
	?>
	<div class="pull-right">
<?php
	if (isset($data['found'])) { 
		echo '<button type="submit" class="btn btn-primary">Aplicar cambios</button>'; }
	else {
                echo '<button type="submit" class="btn btn-primary">Crear paciente</button>'; 
	}
?>
        </div>
    </div><!-- /.container -->
</form>
    <div class="container">
	<?php
		echo draw_encounter($data['id']);
	?>
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jscss/jquery-3.2.1.min.js"></script>
    <script src="jscss/jquery-ui.min.js"></script>
    <script src="jscss/bootstrap.min.js"></script>
    <script>
	$( function() {
		$( "#updated" ).datepicker({
			       dateFormat: "yy-mm-dd"
			});
		$( "#birthdate" ).datepicker({
                               dateFormat: "yy-mm-dd"
                        });
	} );
   </script>
   <script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".encounter"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><br><textarea class="form-control" rows="3" name="encounter[]"></textarea><a href="#" class="remove_field">Eliminar</a></div>'); //add input box
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
   </script>
   <script>
	function getAge(dateString) {
	var today = new Date();
	var birthDate = new Date(dateString);
	var age = today.getFullYear() - birthDate.getFullYear();
	var m = today.getMonth() - birthDate.getMonth();
	if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
		age--;
  	}
	if (isNaN(age)) {
        	return 0;
   	}
   	else {
		return age;
	}
	}
	document.getElementById("age").value = getAge('<?= $data['birthdate']?>');
   </script>
   <script>
   function getIMC() {
   var height=<?= $data['height']?>;
   var weight=<?= $data['weight']?>;
   var imc = weight / (height/100*height/100);
   if (isNaN(imc)) {
	return 0;
   }
   else {
   	return Number(Math.round(imc+'e1')+'e-1');
   }
   }
   document.getElementById("imc").value = getIMC();
   </script>
   </body>
</html>
