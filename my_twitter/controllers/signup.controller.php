<?php
include_once('../models/model_user.php');
$var = new user();
$var->add_user_to_db($_POST["pseudo"], $_POST["birthdate"], $_POST["email"], $_POST["password"]);
