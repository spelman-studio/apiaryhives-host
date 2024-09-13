<?php
require_once("inc/global.php");
session_destroy();
header("Location: index.php");
die();
?>