<?php
require_once(__DIR__ . './vendor/autoload.php');
$api = new \Yandex\Geo\Api();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Yandex Geo</title>

  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
</head>
<body>

  <script src="./myMap.js"></script>
</body>
</html>