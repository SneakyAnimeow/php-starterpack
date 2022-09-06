<?php

class MySQLWrapper {
  private $connection;

  /**
   * Create connection to MySQL database by Wrapper
   * @param string $host Domain or IP of MySQL database (for localhost -> 127.0.0.1)
   * @param string $user Username for MySQL database
   * @param string $password Password for MySQL database for provided username
   * @param string $database Name of database
   */
  function __construct($host, $user, $password, $database) {
    return $this->try_connect($host, $user, $password, $database);
  }

  private function try_connect($host, $user, $password, $database) {
    try {
      $this->connection = new mysqli($host, $user, $password, $database);
    } catch (Exception $e) {
      die("Connection failed: " . $e);
    }
    return $this->connection;
  }

  /**
   * Execute query on MySQL database
   * @param string $query Query to execute
   * @return array|bool Array of results or false if query failed
   */
  public function execute($query){
    $result = $this->connection->query($query);
    if ($result->num_rows > 0) {
      $results = [];
      while($row = $result->fetch_assoc()) {
        $results[] = $row;
      };
      return $results;
    } else {
      return false;
    }
  }

}

?>