<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@title</title>
</head>
<body>
    <p>@motd</p>

    @list

    <br>

    <?php
        echo "Also it can execute php code";
    ?>

    <br>

    @globalVarA

    <script>
        document.write(PHP_CONSTANTS["motd"]);
    </script>
</body>
</html>