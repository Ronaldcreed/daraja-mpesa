<?php

$orderid = $_GET['oid'];
//$data = file_get_contents("php://input");

//$h = fopen("api/orders/" . $orderid . "-payment.json", "a");
//fwrite($h, $data);
//fclose($h);


http_response_code(200);

    # if this is your first time, you might need to check the directory 'Tutorial 1'  File first.
    require 'config.php';
    header("Content-Type: application/json");

    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Confirmation Received Successfully"
    }';

    // Response from M-PESA Stream
    $data = file_get_contents("php://input");
    //$mpesaResponse = file_get_contents('php://input');

    // log the response
    $logFile = "M_PESAConfirmationResponse.txt";

    $jsonMpesaResponse = json_decode($data, true); // We will then use this to save to database

    $transaction = array(
            ':name'      => $jsonMpesaResponse['name'],
            ':desc'              => $jsonMpesaResponse['desc'],
            ':price'            => $jsonMpesaResponse['price'],
            ':phone'          => $jsonMpesaResponse['phone']
           
            
           
    );
    

    // write to file
    
$h = fopen($logFile, "a");
    fwrite($h, $data);
    fclose($h);
    
   // $log = fopen($logFile, "a");
    //fwrite($log, $mpesaResponse);
    //fclose($log);

    echo $response;

    // this will insert to database.
    insert_response($transaction);