<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=todolist", "root", "");
	}

	function fetch_all() // Tamamlanmamış işleri listeler
	{
		$query = "SELECT * FROM todo WHERE _state = 'undone' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	function fetch_done() // Tamamlanmış işleri listeler
	{
		$query = "SELECT * FROM todo WHERE _state = 'done' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert() //Yapılacak iş ekler
	{
		if(isset($_POST["todoname"]))
		{
			$form_data = array(
				':todoname'		=>	$_POST["todoname"]
				
			);
			$query = "
			INSERT INTO todo 
			(name,_state) VALUES 
			(:todoname,'undone')
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function delete($id) // Element siler
	{
		$query = "DELETE FROM todo WHERE id = '".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function undone($id) //Yapılmamış işi, yapılmışa çevirir
	{
		
		$query = "UPDATE todo SET _state='done' WHERE id = '".$id."' ";	
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function done($id) // Yapılmış işi, tekrar yapılmamışa çevirir
	{
		
		$query = "UPDATE todo SET _state='undone' WHERE id = '".$id."' ";	
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}




}

?>