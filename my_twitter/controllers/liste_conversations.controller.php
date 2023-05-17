<?php 
require_once("../models/model_messages.php");
$var = new Message();
$tab_convo = $var->liste_conversations($id);

$convo=[];

if ($tab_convo==null){
    $convo=[null];
}else{
    $tab = [];
    foreach ($tab_convo as $row){
        $participants = $var->participants($row['id'],$id);
        foreach($participants as $p){
            array_push($tab,$p['alias']);
        }
        array_push($convo,[$row['id'],$tab]);
        $tab=[];
    }
}
?>
