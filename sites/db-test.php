<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    require_once(__DIR__.'/../lib/mysql-wrapper.php');

    $db = new MySQLWrapper(
      "127.0.0.1",
      "root",
      "password123",
      "Ksiegarnia1"
    );
    $result = $db->execute("SELECT * FROM Ksiazka");
    foreach ($result as $row) {
      print_r(json_encode($row));
      echo "</br>";
    }
  ?>
</body>
</html>