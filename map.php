<?php
  require_once(__DIR__ . '/vendor/autoload.php');
  $api = new \Yandex\Geo\Api();
  $address;
  $lat;
  $lon;

  if (!empty($_GET['lat']) && !empty($_GET['lon'])) {
    $lat = $_GET['lat'];
    $lon = $_GET['lon'];
  }
  
  if (!empty($_POST['address']) || !empty($_GET['address'])) {
    $address = !empty($_POST['address']) ? $_POST['address'] : $_GET['address'];
    $api->setQuery($address);
    $api
      ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
      ->load();

    $response = $api->getResponse();
    $collection = $response->getList();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>map.php</title>

  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
</head>
<body>
  <div>
    <h3>Поиск по адресу: <?php echo $address; ?></h3>

    <?php if (!empty($collection)) : ?>
      <ul>
        <?php foreach($collection as $item): ?>
        <li>
          <a href="
            ?lat=<?php echo $item->getLatitude(); ?>
            &lon=<?php echo $item->getLongitude(); ?>
            &address=<?php echo $address; ?>
          ">
            <?php echo $item->getAddress(); ?>
          </a>
        </li>
        <?php endforeach;?>
      </ul>

    <?php else:?>
      <p>Нет результатов поиска... Попробуйте изменить запрос</p>
      <a href="./">Назад</a>
    <?php endif;?>
  </div>

  <?php if (!empty($lat) && !empty($lon) && !empty($address)): ?>
    <div id="yaMap" style="height: 400px"></div>
    <script>
      window.addEventListener('load', () => {
        ymaps.ready(init);
        
        function init(){   
          const myMap = new ymaps.Map("yaMap", {
            center: [
              <?php echo $lat; ?>, 
              <?php echo $lon; ?>,
            ],
            zoom: 16
          });

          const myPlacemark = new ymaps.Placemark(
            [
              <?php echo $lat; ?>,
              <?php echo $lon; ?>
            ], 
            {
              hintContent: '<?php echo $address; ?>',
              balloonContent: '<?php echo $address; ?>'
            }
          );

          myMap.geoObjects.add(myPlacemark);
        }
      });
    </script>
  <?php endif; ?>
</body>
</html>