<?php

include __DIR__ . '/../legacy_db.php';

$result = $db->execute("SELECT * FROM Ksiazka");

header('Content-Type: application/json');
echo json_encode($result);

?>

<!--To deletion-->