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
    $mysql = SQLQueryableFactory::createDefault();
    $result = $mysql->execute("SELECT * FROM test");
    foreach ($result as $row) {
        print_r(json_encode($row));
        echo "</br>";
    }
?>
</body>
</html>


<!-- TODO: this not working with any dynamic router so go debug it -->