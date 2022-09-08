<!DOCTYPE html>
<html lang="en">
<?php
    //import framework classes
    include(__DIR__.'/framework/interfaces/Jsonable.php');
    include(__DIR__.'/framework/sql/SQL.php');
    include(__DIR__.'/framework/sql/MySQL.php');
    include(__DIR__.'/framework/sql/SQLQueryable.php');
    include(__DIR__.'/framework/sql/SQLQueryableFactory.php');
    include(__DIR__.'/framework/config/Config.php');
    include(__DIR__.'/framework/config/Router.php');
    include(__DIR__.'/framework/config/TemplateEngine.php');

    $globals = json_decode(file_get_contents("globals.json"));

    foreach ($globals as $key => $value) {
        $GLOBALS[$key] = $value;
    }

    $config = Config::init(file_get_contents("config.json"));

    error_reporting($config->getRouter()->getErrorPrinting());

    $site = preg_replace('/[^A-Za-z0-9\-]/', "", explode('/', $_SERVER['REQUEST_URI'])[1]);

    if($site == ""){
        $site = "main";
    }

    if(!file_exists(__DIR__ . "/sites/$site.php")){
        $content = file_get_contents("framework/internal/404.php");
    }else{
        $content = file_get_contents("sites/$site.php");
    }

    if(!file_exists(__DIR__ . "/jsons/$site.json")){
        $constants = json_decode(file_get_contents("framework/internal/404.php"), true);
    }else{
        $constants = json_decode(file_get_contents("jsons/$site.json"), true);
    }

    foreach([$constants, $globals] as $array){
        foreach($array as $key => $value){
            $content = str_replace("@$key", (is_array($value) ? implode($config->getTemplateEngine()->getArraySeparator(), $value) : $value), $content);
        }
    }

    //inject js script
    echo "<script>
        var PHP_GLOBALS = " . json_encode($globals) . ";
        var PHP_CONSTANTS = " . json_encode($constants) . ";
          </script>";

    //eval php code
    $content = preg_replace_callback('/<\?php(.*?)\?>/s', function($matches) {
        ob_start();
        eval($matches[1]);
        return ob_get_clean();
    }, $content);

    echo $content;
?>