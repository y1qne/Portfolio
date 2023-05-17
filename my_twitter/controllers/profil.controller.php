<?php
include_once("../models/model_profil.php");
$var = new profil();
$results = $var->profil($_GET["pseudo"]);
include_once("../views/view_profil.php");
