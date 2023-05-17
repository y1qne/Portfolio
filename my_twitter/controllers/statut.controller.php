<?php 
if(($_SESSION['loggedin']?? false) == true){
    header("Location: home");
}
?>