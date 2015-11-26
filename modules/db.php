<?php

/**
 * Project:     Framework G - G Light
 * File:        db.php
 * 
 * For questions, help, comments, discussion, etc., please join to the
 * website www.frameworkg.com
 * 
 * @link http://www.frameworkg.com/
 * @copyright 2013-02-07
 * @author Group Framework G  <info at frameworkg dot com>
 * @version 1.2
 */

class db
{
    var $server = C_DB_SERVER; //DB server
	var $user = C_DB_USER; //DB user
    var $pass = C_DB_PASS; //DB password
	var $db = C_DB_DATABASE_NAME; //DB database name
	var $limit = C_DB_LIMIT; //DB limit of elements by page
	var $cn;
	var $numpages;
	
	public function db(){}
	
	//connect to database
	public function connect()
	{
		$this->cn = mysqli_connect($this->server, $this->user, $this->pass);
		if(!$this->cn) {die("Failed connection to the database: ".mysqli_error($this->cn));}
		if(!mysqli_select_db($this->cn,$this->db)) {die("Unable to communicate with the database $db: ".mysqli_error($this->cn));}
		mysqli_query($this->cn,"SET NAMES utf8");
	}
	
	//function for doing multiple queries
	public function do_operation($operation, $class = NULL)
	{
		$result = mysqli_query($this->cn, $operation) ;
		if(!$result) {$this->throw_sql_exception($class);}	
	}
	
	//function for obtain data from db in object form
	private function get_data($operation)
	{		
		$data = array(); 
		$result = mysqli_query($this->cn, $operation) or die(mysqli_error($this->cn));
		while ($row = mysqli_fetch_object($result))
		{
			array_push($data, $row);
		}
		return $data;
	}
	
	//throw exception to web document
	private function throw_sql_exception($class)
    {
		$errno = mysqli_errno($this->cn); $error = mysqli_error($this->cn);
		$msg = $error."<br /><br /><b>Error number:</b> ".$errno;
        throw new Exception($msg);
    }
	
	//for avoid sql injections, this functions cleans the variables
	private function escape_string(&$data)
	{
		if(is_object($data))
		{
			foreach ($data->metadata() as $key => $attribute)
			{if(!is_empty($data->get($key))){$data->set($key,mysqli_real_escape_string($this->cn,$data->get($key)));}}
		}
		else if(is_array($data))
		{
			foreach ($data as $key => $value) 
			{if(!is_array($value)){$data[$key]=mysqli_real_escape_string($this->cn,$value);}}
		}
	}
	
	//function for add data to db
	public function insert($options,$object) 
	{
		switch($options['lvl1'])
		{																																																																																													
			case "user":
			switch($options['lvl2'])
			{
				case "normal":
					//
					break;
			}
			break;
			
			default: break;
		}
	}
	
	//function for edit data from db
	public function update($options,$object) 
	{
		switch($options['lvl1'])
		{																																																																																																		
			case "user":
			switch($options['lvl2'])
			{
				case "normal":
					//
					break;
			}
			break;
			
			default: break;
		}
	}
	
	//function for delete data from db
	public function delete($options,$object)
	{
		switch($options['lvl1'])
		{																																																																																												
			case "user":
			switch($options['lvl2'])
			{
				case "normal": 
					//
					break;
			}
			break;
			case "veterinario":
			switch($options['lvl2'])
			{
				case "normal": 
					$identificacion=mysqli_real_escape_string($this->cn,$object->get('identificacion'));
                	$this->do_operation("DELETE FROM veterinario WHERE identificacion='$identificacion';");
					break;
			}
			break;
			
			default: break;			  
		}
	}
	
	//function that returns an array with data from a operation
	public function select($option,$data)
	{
		$info = array();
		switch($option['lvl1'])
		{	

			case "administrador":
			switch($option['lvl2'])
			{
				case "all": 
					//
				break;

				case "one_login":
					$user = mysqli_real_escape_string($this->cn, $data['user']);
					$pass = $data['pass'];
					$result = $this->get_data("SELECT user, pass FROM administrador WHERE user='$user';");
					$hasher = new PasswordHash(8, FALSE);
					if ($hasher->CheckPassword($pass, $result[0]->pass))
						$info = $this->get_data("SELECT * FROM administrador WHERE user = '$user';");
					unset($hasher);
					break;
			}
			break;

			case "veterinario":
			switch($option['lvl2'])
			{
				case "all": 
					//
				break;

				case "one_login":
					$user = mysqli_real_escape_string($this->cn, $data['user']);
					$pass = $data['pass'];
					$result = $this->get_data("SELECT user, pass FROM veterinario WHERE user='$user';");
					$hasher = new PasswordHash(8, FALSE);
					if ($hasher->CheckPassword($pass, $result[0]->pass))
						$info = $this->get_data("SELECT * FROM veterinario WHERE user = '$user';");
					unset($hasher);
					break;
				case "by_nombre": 
					$this->escape_string($data);
					$nombre=$data['valor'];					
					$info=$this->get_data("SELECT * FROM veterinario WHERE nombre like '%$nombre%';"); 
					break;
				case "by_identificacion": 
					$this->escape_string($data);
					$identificacion=$data['valor'];					
					$info=$this->get_data("SELECT * FROM veterinario WHERE identificacion like '%$identificacion%';"); 
					break;
				case "por_identificacion": 
					$this->escape_string($data);
					$identificacion=$data['valor'];					
					$info=$this->get_data("SELECT * FROM veterinario WHERE identificacion = '$identificacion';"); 
					break;
				case "by_telefono": 
					$this->escape_string($data);
					$telefono=$data['valor'];					
					$info=$this->get_data("SELECT * FROM veterinario WHERE telefono like '%$telefono%';"); 
					break;
				case "by_email": 
					$this->escape_string($data);
					$email=$data['valor'];					
					$info=$this->get_data("SELECT * FROM veterinario WHERE email like '%$email%';"); 
					break;
			}
			break;

			case "cita":
			switch($option['lvl2'])
			{
				case "all":
					$this->escape_string($data);
					$identificacion=$data['identificacion']; 
					$info=$this->get_data("SELECT c.*, a.nombre as nombre_animal FROM cita c, animal a WHERE c.animal = a.id AND c.veterinario = '$identificacion';"); 
					break;
				
				case "by_codigo": 
					$this->escape_string($data);
					$codigo=$data['valor'];
					$identificacion=$data['identificacion'];
					$info=$this->get_data("SELECT c.*, a.nombre as nombre_animal FROM cita c, animal a WHERE c.codigo like '%$codigo%' AND c.animal = a.id AND c.veterinario = '$identificacion';"); 
					break;

				case "by_motivo": 
					$this->escape_string($data);
					$motivo=$data['valor'];
					$identificacion=$data['identificacion'];
					$info=$this->get_data("SELECT c.*, a.nombre as nombre_animal FROM cita c, animal a WHERE c.motivo like '%$motivo%' AND c.animal = a.id AND c.veterinario = '$identificacion';"); 
					break;

				case "by_fecha": 
					$this->escape_string($data);
					$fecha=$data['valor'];
					$identificacion=$data['identificacion'];
					$info=$this->get_data("SELECT c.*, a.nombre as nombre_animal FROM cita c, animal a WHERE c.fecha like '%$fecha%' AND c.animal = a.id AND c.veterinario = '$identificacion';"); 
					break;

				case "by_hora": 
					$this->escape_string($data);
					$hora=$data['valor'];
					$identificacion=$data['identificacion'];
					$info=$this->get_data("SELECT c.*, a.nombre as nombre_animal FROM cita c, animal a WHERE c.hora like '%$hora%' AND c.animal = a.id AND c.veterinario = '$identificacion';"); 
					break;

				case "by_animal": 
					$this->escape_string($data);
					$animal=$data['valor'];
					$identificacion=$data['identificacion'];
					$info=$this->get_data("SELECT c.*, a.nombre as nombre_animal FROM cita c, animal a WHERE a.nombre like '%$animal%' AND c.animal = a.id AND c.veterinario = '$identificacion';"); 
					break;

			}
			break;
			
			default: break;
		}
		return $info;
	}
	
	//close the db connection
	public function close()
	{
		if($this->cn){mysqli_close($this->cn);}
	}
	
}

?>