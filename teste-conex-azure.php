<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:db-cnbrs.database.windows.net,1433; Database = CNBRS_PRODUCAO", "sa_cnbrs", "1qaz2wsx3@dcSKY");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    //print("Error connecting to SQL Server.");
    echo '<pre>';
    die(print_r($e));
}

// SQL Server Extension Sample Code:
// $connectionInfo = array("UID" => "sa_cnbrs", "pwd" => "1qaz2wsx3@dcSKY", "Database" => "CNBRS_PRODUCAO", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
// $serverName = "tcp:db-cnbrs.database.windows.net,1433";
// $conn = sqlsrv_connect($serverName, $connectionInfo);
?>