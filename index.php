<!DOCTYPE html>
<html lang="en">
<?php
    $site = $_GET['site'];

    if($site == ""){
        $site = "main";
    }

    $content = file_get_contents("sites/$site.php");
    $constants = json_decode(file_get_contents("jsons/$site.json"), true);

    foreach($constants as $key => $value){
        $content = str_replace("@$key", (is_array($value) ? implode(", ", $value) : $value), $content);
    }
    echo $content;
?>
</html>