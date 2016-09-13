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

    $queryArray = array();
//    $query = 'DROP TABLE *';
//    array_push($queryArray, $query);

    $query = "CREATE  TABLE  Movies  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, FirstName TEXT, LastName TEXT, EmailAddress TEXT, Comments TEXT)";
    array_push($queryArray, $query);

    $query = "CREATE  TABLE  bids  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, item_id INT, amount FLOAT(7,2), user_id INT)";
    array_push($queryArray, $query);

    $query = "CREATE  TABLE  items  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, user_id INT, cat_id TINYINT, name VARCHAR(100), startingprice FLOAT(7,2), description TEXT, dateends DATETIME, endnotified TINYINT)";
    array_push($queryArray, $query);

    $query = "CREATE  TABLE  users  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, username VARCHAR(10), password VARCHAR(40), email VARCHAR(100), verifystring VARCHAR(20), active TINYINT)";
    array_push($queryArray, $query);

    $query = "CREATE  TABLE  categories  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, cat VARCHAR(20))";
    array_push($queryArray, $query);

    $query = "CREATE  TABLE  images  (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, item_id INT, name VARCHAR(100))";
    array_push($queryArray, $query);


    print_r($queryArray);

    foreach($queryArray as &$table) {

        $dbc->exec($table)or die(print_r($dbc->errorInfo(), true));
        print("Created $table Table.\n");
    }

} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}

$dbc->connection = null;
?>

</body>
</html>