<?php
class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection)
            self::$connection = new self();
        return self::$connection;

    }

    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage() . "<BR>";
        }


    }

    /**
     * Parameter 1: SQL statement to be executed.
     * Parameter 2: An associative array of [markers] => [binding values].
     * Returns: A PDO object on success. Boolean false on failure.
     * Description: Given a SQL statement and optionally an array of binding
     * values, use PDO to prepare and bind the values and execute.
     */
    public function sqlBindQuery($query, $valArray = null)
    {
        try {
            $statement = $this->connection->prepare($query);
            if (is_array($valArray)) {
                $statement->execute($valArray);
            } else {
                $statement->execute();
            }
            return $statement;
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage() . "<BR>";
        }

    }

    /**
     * Parameter 1: SQL statement to be executed.
     * Parameter 2: An associative array of [markers] => [binding values].
     * Returns: Associative array containing all rows returned from the SQL
     * query or False if no results.
     * Description: Execute an SQL statement using the sqlBindQuery helper
     * method. Return an associative array of all rows affected/returned from
     * the SQL query.
     */
    public function fetchArray($query, $valArray = null) {
        $statement = $this->sqlBindQuery($query, $valArray);
        if ($statement->rowCount() == 0) {
            return false;
        } else if ($statement->rowCount() >= 1) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

    }

    /**
     * Returns: The auto_increment field for the last executed insert
     * command
     * Description: Returns the id that was last assigned to a record
     * inserted into the db
     */
    public function lastInsertId() {
        $id=$this->connection->lastInsertId();
        return $id;
    }

    /**
     * Parameter 1: SQL statement to be executed.
     * Parameter 2: An associative array of [markers] => [binding values].
     * Returns: The number of rows returned from the SQL query
     * Description: Given a SQL statement binding values, execute the
     * statement and return the number of rows returned from the SQL query.
     */
    public function rowCount($query, $valArray = null) {
        $statement = $this->sqlBindQuery($query, $valArray);
        return $statement->rowCount();
    }

}