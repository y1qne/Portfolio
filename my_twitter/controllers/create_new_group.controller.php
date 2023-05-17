<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../models/model_messages.php");

$data = file_get_contents('php://input');
$array = json_decode($data, true);

if($array != null){
    $p= '';
    $var = new Message();
    $id_conv = $var -> next_id_conv();
    foreach ($array as $participant => $status){
        if ($status == true){
            $var = new Message();
            $var -> add_user_to_conversation($participant,$id_conv);
        }
    }
}
