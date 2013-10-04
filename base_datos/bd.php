<?php
/**
*Clase para conexion y ejecutar consultas a base de datos
*@categoria Acceso a base de datos
*@paquete MysqliDb
**/

require_once ("bd_config.php");
class bd{
	/**
	*Instancia de MySQLi
	**/
	protected $mysqli;
	/**
	*Query a ser preparada y ejecutada
	**/
	protected $query;
	/**
	*Arreglo dinamico con tipos de variables (strings, integers, doubles, blobs)
	**/
	protected $tipos_var;
	/**
	*Arreglo dinamico para enlazar a la query
	**/
	protected $bind_params = array('');
	/**
	*Arreglo para almacenar 'campo' => 'valor'
	**/
	protected $where = array();
	/**
	*Arreglo dinamico con los tipos de variables utilizando condicion WHERE
	**/
	protected $where_tipos_var;


	public function __construct(){
		$this -> mysqli = new mysqli(BD_HOST, BD_USUARIO, BD_CONTRASENA, BD_NOMBRE)
			or die('No es posible establecer una conexion con la base de datos');
		$this->mysqli->set_charset('utf8');
	}
	/*
	public function ejecutar_query($texto){
		$query = $this -> limpiar_query($texto);
		$resultado = $this -> mysqli -> query($query);
		return $resultado;
	}*/

	public function insertar($tabla, $data){
		$this -> query = "INSERT INTO $tabla";
		$sentencia = $this -> construir_query($data);
		return $sentencia -> execute();
	}

	public function selec_todo($tabla){
		$this -> query = "SELECT * FROM $tabla";
		$sentencia = $this -> construir_query();
		$sentencia -> execute();
		return $this -> get_arreglo($sentencia);
	}

	public function borrar($tabla){
		$this -> query = "DELETE FROM $tabla";
		$sentencia = $this -> construir_query();
		return $sentencia -> execute();
	}

	public function where($campo, $valor){
		$this -> where[$campo] = $valor;
		return $this;
	}

	public function actualizar($tabla, $data){
		$this -> query = "UPDATE $tabla SET ";
		$sentencia = $this -> construir_query($data);
		return $sentencia -> execute();
	}

	public function ejecutar_query($query, $data = NULL){
		$this -> query = filter_var($query, FILTER_SANITIZE_STRING);
		$sentencia = $this -> construir_query();
		if ( is_array($data) === true) {
			$params = array('');
			foreach ($data as $i => $val) {
				$params[0] .= $this -> obtener_tipo($val);
				array_push($params, $data[$i]);
			}

			call_user_func_array(array($sentencia, 'bind_param'), $this -> referencia_valores($params));
		}

		$sentencia -> execute();
		return $this -> get_arreglo($sentencia);
	}

	protected function construir_query($data = NULL){
		$bool_data = is_array($data);
		$bool_where = !empty($this -> where);
		//INSERT
		if ($bool_data){
			$pos = strpos($this -> query, "INSERT");

			//Query tiene INSERT?
			if($pos !== false){
				$keys = array_keys($data);
				$valores = array_values($data);
				$total = count($keys);

				//Agrega comillas a los valores
				foreach ($valores as $i => $val){
					$values[$i] = "'{val}'";
					$this -> tipos_var .= $this -> obtener_tipo($val);
				}

				$this -> query .= '('. implode(',', $keys). ') VALUES(';
				//Completa query con '?'' dependiendo del total de parametros
				while($total !== 0){
					$this -> query .= '?, ';
					$total--;
				}

				//Remueve ultima coma
				$this -> query = rtrim($this -> query, ', ');
				$this -> query .= ')';
			}
		}
		//Metodo where fue llamado?
		if ( $bool_where ) {
			if ( $bool_data ) {
				$pos = strpos( $this -> query, 'UPDATE' );

				if ( $pos !== false ) {
					foreach ( $data as $i => $val ) {
						$this -> tipos_var .= $this -> obtener_tipo($val);
						$this -> query .= ($i .= ' = ?, ');
					}
					$this -> query = rtrim($this-> query, ', ');
				}
			}
			$this -> query .= ' WHERE ';
			foreach ( $this -> where as $i => $val ) {
				//Obtiene tipos de parametros
				$this -> where_tipos_var .= $this -> obtener_tipo($val);
				//Completa query
				$this -> query .= ($i .' = ? AND ');
			}
			//Remueve ultimo AND
			$this -> query = rtrim($this -> query, ' AND ');
		}

		$sentencia = $this -> preparar_query();
		//print_r($data);
		if($bool_data){
			$this -> bind_params[0] = $this -> tipos_var;
			
			foreach ($data as $i => $val) {
				array_push($this -> bind_params, $data[$i]);
			}
		}
		//print_r($this -> tipos_var);

		//enlazar parametros con condicion WHERE
		if ( $bool_where ) {
			if ( $this -> where ) {
				$this -> bind_params[0] .= $this -> where_tipos_var;
				foreach ( $this -> where as $i => $val ) {
					array_push( $this -> bind_params, $this -> where[$i] );
				}
			}
		}

		//enlazar parametros a enunciado por referencia, de manera dinamica
		//print_r($this -> bind_params);
		if( $bool_data || $bool_where ){
			call_user_func_array(array($sentencia, 'bind_param'), $this -> referencia_valores($this -> bind_params) );
		}
		return $sentencia;
	}

	protected function limpiar_query($texto){
		$query = trim($texto);
		$resultado = $this -> mysqli -> query($query);
		return $resultado;
	}

	protected function obtener_tipo($var){
		switch (gettype($var)) {
			case 'string':
				return 's';
				break;
			
			case 'integer':
				return 'i';
				break;

			case 'blob':
				return 'b';
				break;

			case 'double':
				return 'd';
				break;

			default:
				return '';
				break;
		}
	}

	protected function preparar_query(){
		$enunciado = $this -> mysqli -> prepare($this -> query);
		if (!$enunciado){
			trigger_error("Ocurrio un problema preparando la sentencia ($this->_query) " . $this->mysqli->error, E_USER_ERROR);
		}
		return $enunciado;
	}

	protected function referencia_valores($arreglo){
		if(strnatcmp(phpversion(), '5.3') >= 0){
			$refs = array();
			foreach ($arreglo as $i => $valor) {
                $refs[$i] = & $arreglo[$i];
           	}
            return $refs;
		}else{
			return $arreglo;
		}
	}

	protected function get_arreglo(mysqli_stmt $sentencia){
		$params = array();
		$valores = array();

		$metadada = $sentencia -> result_metadata();

		$filas = array();

		while ($campo = $metadada -> fetch_field() ){
			$filas[ $campo -> name ] = null;
			//echo $campo -> name;
			$params[] =& $filas[$campo -> name];
		}

		call_user_func_array( array( $sentencia, 'bind_result') , $params);

		while ( $sentencia -> fetch() ){
			$aux = array();
			foreach ( $filas as $i => $val ) {
				$aux[$i] = $val;
			}
			array_push($valores, $aux);
		}
		return $valores;
		//print_r($valores);
	}
}
//Raw Query
/*$bd = new bd();
$data = array(1, 'Jonathan Arturo');
$query = "SELECT * FROM alumnos WHERE id = ? AND nombre = ?";
$resultado = $bd -> ejecutar_query($query, $data);
print_r($resultado);*/

//UPDATE
/*$data_update = array(
	'contrasena' => '09876'
	);
$bd -> where('id', 1);
if ($bd -> actualizar('alumnos', $data_update)) {
	echo 'Actualizado';
}*/

/*DELETE
$bd -> where('id', 2);
if($bd -> borrar('alumnos') ){
	echo 'borrado';
}*/

/*SELECT *
$res = $bd -> selec_todo('alumnos');
print_r($res);*/

/*INSERT
$data = array(
	'hora' => 'V7',
	'duracion' => '3:00');
if($bd -> insertar('horas', $data)){
	echo 'Se inserto';
	}*/
?>