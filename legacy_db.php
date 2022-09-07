<?php

require_once(__DIR__.'/lib/mysql-wrapper.php');
  
$db = new MySQLWrapper(
  "127.0.0.1",
  "root",
  "password123",
  "Ksiegarnia1"
);

return $db;

?>