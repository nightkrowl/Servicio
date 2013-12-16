<div class="forms">

<?php
$contenido = ($_REQUEST['alta']);
if ($contenido == 'alumno'){
?>
<form id="alta">
	<fieldset>
		<label>Nombres</label>
		<input type="text" name="nombres" placeholder="Nombres" autocapitalize="words" required/>
		
		<label>Apellidos</label>
		<input type="text" name="apellidos" placeholder="Apellidos" autocapitalize="words" required/>
		
		<label>Carrera</label>
		<select id="carreras" name="carrera" required>
			
    	</select>

    	<label>Semestre</label>
		<select id="semestre" name="semestre" required>
			
    	</select>
    	
    	<label>Correo</label>
    	<input type="email" name="correo" placeholder="ejemplo@dominio.com" required/>

    	<button type="submit" class="btn btn-primary">Aceptar</button>
    	<button class="btn btn-primary">Cancelar</button>
    </fieldset>
</form>
    <?php } elseif ($contenido == "profesor"){ ?>
<form id="alta">
    <fieldset>
		<label>Nombres</label>
		<input type="text" name="nombres" placeholder="Nombres" autocapitalize="words" required/>
		
		<label>Apellidos</label>
		<input type="text" name="apellidos" placeholder="Apellidos" autocapitalize="words" required/>
		
		<label>Carrera</label>
		<select id="carreras" name="carrera">
			
    	</select>

		<label>Materia que impartirá</label>
		<input type="text" list="materia" name="materia"/>
		<datalist id="materia">
			
		</datalist>
    	
    	<label>Correo</label>
    	<input type="email" name="correo" placeholder="ejemplo@dominio.com"/>

    	<button type="submit" class="btn btn-primary">Aceptar</button>
    	<button class="btn btn-primary">Cancelar</button>
    </fieldset>
</form>
    <?php }elseif ($contenido == "grupo") {?>
<form id="alta">
    <fieldset>
		<label>Carrera</label>
		<select id="carreras" name="carrera" required>
			
    	</select>
		
		<label>Semestre</label>
		<select id="semestre" name="semestre">
			
    	</select>
		
		<label>Materia</label>
		<input type="text" list="materia" name="materia"/>
		<datalist id="materia">
			
		</datalist>
    	
    	<label>Profesor</label>
    	<!--<select id="profesor" name="profesor">
			
    	</select>-->
    	<input type="text" list="profesor" name="profesor"/>
		<datalist id="profesor">
			
		</datalist>

		<label>Hora</label>
		<select id="hora" name="hora" required>
			
    	</select>

		<label>Ciclo</label>
		<select id="ciclo" name="ciclo" required>
			<option selected="selected">Escoge</option>
			<option>Agosto-Diciembre</option>
			<option>Enero-Junio</option>
    	</select>    	

    	<button type="submit" class="btn btn-primary">Aceptar</button>
    	<button class="btn btn-primary">Cancelar</button>
    </fieldset>
</form>


    <?php } ?>
</div>
<script src="js/admin.js"></script>