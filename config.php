<?php
// test de fichier
require_once "models/Manager.php";

$db = new Manager();
define("LOCAL_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]);
define("HTTP_PATH_ROOT", isset($_SERVER["HTTP_Host"]) ? $_SERVER["HTTP_Host"] : (isset($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : '_UNKNOWN_'));

var_dump($_SERVER["SERVER_NAME"]);