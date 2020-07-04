<?php

//test_api.php

include('Api.php');

$api_object = new API();

if($_GET["action"] == 'fetch_all') // Yapılmamış işleri listeler
{
	$data = $api_object->fetch_all();
}

if($_GET["action"] == 'fetch_done') //Yapılmıi işleri listeler
{
	$data = $api_object->fetch_done();
}


if($_GET["action"] == 'insert')
{
	$data = $api_object->insert();
}

if($_GET["action"] == 'delete')
{
	$data = $api_object->delete($_GET["id"]);
}
if($_GET["action"] == 'undone')
{
	$data = $api_object->undone($_GET["id"]);
}
if($_GET["action"] == 'done')
{
	$data = $api_object->done($_GET["id"]);
}

echo json_encode($data);

?>