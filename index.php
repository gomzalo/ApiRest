<?php

//incluir el archivo principal
include("Slim/Slim.php");

//registran la instancia de slim
\Slim\Slim::registerAutoloader();
//aplicacion 
$app = new \Slim\Slim();

//routing 
//accediendo VIA URL
//http:///www.google.com/

$app->get(
    '/',function() use ($app){
    	
    	
    	$datos = array(
    					"nombre" => "Hola pinche putita", 
    					"edad" => "69"
    					);
						$message = array("message" => "Intentaron Abrir el Porton ALV");
					$url = 'https://fcm.googleapis.com/fcm/send';
					$fields = array(
						//'registration_ids' => $tokens, //tokens
						//"condition" => "'dogs' in topics || 'cats' in topics",
						"to" => "/topics/Arqui1",
						"data" => $message
					);
					$headers = array('Content-Type: application/json',
						'Authorization:key=AIzaSyBj5l2DzazhLbtMPDw5-Y_QOeenZdAsN6I'
					);
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
					$result = curl_exec($ch);
					if ($result == FALSE){
						die('Curl failed: ' . curl_error($ch));
						echo "error";
					}else if($result==TRUE){
						echo json_encode($datos);
						
					}
					curl_close($ch);
    	//json 
       
    }
)->setParams(array($app));

$app->get(
    '/usuario/:nombre',function($nombre) use ($app){
    	$id = $nombre;
    	//almaceno el ID
    	//conexion con base de datos
    	//el proceso
    	// retorno un JSON
        echo "hola bienvenido " . $nombre;
    }
);

//inicializamos la aplicacion(API)
$app->run();

