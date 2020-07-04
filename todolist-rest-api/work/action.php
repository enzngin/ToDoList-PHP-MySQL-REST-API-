<?php

//action.php

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'insert')
	{
		$form_data = array(
			'todoname'	=>	$_POST['todoname']
			
		);
		$api_url = "http://localhost/todolist-rest-api/api/test_api.php?action=insert";  
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}



	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://localhost/todolist-rest-api/test_api.php?action=delete&id=".$id.""; 
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}


if($_POST["action"] == 'delete')
{
	$id = $_POST['id'];
	$api_url = "http://localhost/todolist-rest-api/api/test_api.php?action=delete&id=".$id.""; 
	$client = curl_init($api_url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($client);
	echo $response;
}


if($_POST["action"] == 'undone')
{
	$id = $_POST['id'];
	$api_url = "http://localhost/todolist-rest-api/api/test_api.php?action=undone&id=".$id.""; 
	$client = curl_init($api_url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($client);
	echo $response;
}

if($_POST["action"] == 'done')
{
	$id = $_POST['id'];
	$api_url = "http://localhost/todolist-rest-api/api/test_api.php?action=done&id=".$id.""; 
	$client = curl_init($api_url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($client);
	echo $response;
}




}


?>