<?php

$server = "JWKSQL";
$database = "KPP";
$user = "vb";
$password = "autocar1";
$conn = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=$database;", $user, $password);

?>
