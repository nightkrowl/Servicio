<div class="forms">


<?php
$contenido = ($_REQUEST['baja']);
if ($contenido == 'alumno'){
?>
<form id="baja">
	<fieldset>
		<label>Nombres</label>
		<input type="text" name="nombres" placeholder="Nombres" autocapitalize="words" required/>
		
		<label>Apellidos</label>
		<input type="text" name="apellidos" placeholder="Apellidos" autocapitalize="words" required/>
		
		<label>Carrera</label>
		<select id="carreras" name="carrera">
			<option>Escoge</option>
    	</select>

    	<button type="submit" class="btn btn-primary">Aceptar</button>
    	<button class="btn btn-primary">Cancelar</button>
    </fieldset>
</form>

<div>
	<table class="tabla" id="alumno">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Semestre</th>
				<th>Carrera</th>
			</tr>
		</thead>
	</table>
</div>

    <?php } elseif ($contenido == "profesor"){ ?>
<form id="baja">
    <fieldset>
		<label>Nombres</label>
		<input type="text" name="nombres" placeholder="Nombres" autocapitalize="words" required/>
		
		<label>Apellidos</label>
		<input type="text" name="apellidos" placeholder="Apellidos" autocapitalize="words" required/>

    	<button type="submit" class="btn btn-primary">Aceptar</button>
    	<button class="btn btn-primary">Cancelar</button>
    </fieldset>
</form>
<div>
	<table class="tabla" id="profesor">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Apellidos</th>
			</tr>
		</thead>
	</table>
</div>

    <?php }?>

</div>
<script src="js/admin.js"></script>