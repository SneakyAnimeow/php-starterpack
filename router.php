<?php

// needs solid refactor... (its prototype)

chdir(__DIR__);
$filePath = realpath(ltrim($_SERVER["REQUEST_URI"], '/'));
if ($filePath && is_dir($filePath)){
    // attempt to find an index file
    foreach (['index.php', 'index.html'] as $indexFile){
        if ($filePath = realpath($filePath . DIRECTORY_SEPARATOR . $indexFile)){
            break;
        }
    }
}
if (!$filePath || !is_file($filePath)) {
  if(is_file(__DIR__ . DIRECTORY_SEPARATOR.$_SERVER["REQUEST_URI"].".php")){
    $filePath = __DIR__ . DIRECTORY_SEPARATOR.$_SERVER["REQUEST_URI"].".php";
  } else {
    header("HTTP/1.1 404 Not Found");
    die("404 Not Found");
  }
}
// 1. check that file is not outside of this directory for security
// 2. check for circular reference to router.php
// 3. don't serve dotfiles
if (strpos($filePath, __DIR__ . DIRECTORY_SEPARATOR) === 0 &&
    $filePath != __DIR__ . DIRECTORY_SEPARATOR . 'router.php' &&
    substr(basename($filePath), 0, 1) != '.'
) {
    if(str_contains($filePath, "/sites")){
      $segmented_path = explode('/', $filePath);
      $site = $segmented_path[count($segmented_path) - 1];
      // remove .php from $site
      $site = substr($site, 0, -4);
      $content = file_get_contents($filePath);
      try {
        if (is_file(__DIR__ . DIRECTORY_SEPARATOR."jsons/$site.json")){
          $constants = json_decode(file_get_contents( __DIR__ . DIRECTORY_SEPARATOR."jsons/$site.json"), true);
          if ($constants){
            foreach($constants as $key => $value){
                $content = str_replace("@$key", (is_array($value) ? implode(", ", $value) : $value), $content);
            }
          }
        }
      } catch (Exception $e) {
        // probably site doesnt has its .json or .json is invalid but f*ck it
        // this try catch is to handling exception when site doesnt have .json
      }
      if(str_ends_with($filePath, "/sites/index.php")){
        include $filePath;
      }
      echo $content;
    } else {
      header("HTTP/1.1 403 Forbidden");
      die("403 Forbidden");
    }
} else {
    // disallowed file
    header("HTTP/1.1 404 Not Found");
    die("404 Not Found");
}