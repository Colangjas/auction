<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Tables</title>
</head>
<body>

    <h1>Creating Tables For The Auction Website v1.5</h1>

<?php
try{
    // Set the variables for the database access:
    require_once('includes/initialize.php');


    $dbc = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME , DB_USER , DB_PASSWORD);
    $dbc->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

    $moviesTable = "movies";
    $testTable = "test";

    $sql = "CREATE  TABLE  Movies  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, FirstName TEXT, LastName TEXT, EmailAddress TEXT, Comments TEXT)";

    $dbc->exec($sql)or die(print_r($dbc->errorInfo(), true));
    print("Created $testTable Table.\n");

} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}

$dbc->connection = null;
?>

</body>
</html>