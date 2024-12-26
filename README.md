# Tiny framework to make fast and easy REST API in few steps

### About framework / О фреймворке / Аб фрэймворке
(EN) Hvilina Rest API Framework for handling HTTP requests and responses. It provides routing capabilities for general requests.  
(RU) Hvilina - это минималистичный Rest API PHP-фреймворк для обработки HTTP-запросов и ответов. Он предоставляет возможности маршрутизации для общих запросов.  
(BE) Hvilina - гэта мінімалістычны Rest API PHP-фрэймворк для апрацоўкі HTTP-запытаў і адказаў. Ён прадастаўляе магчымасці маршрутызацыі для агульных запытаў.  

## How to use? / Как использовать? / Як выкарыстовываць?

### English
1. Create an instance of the `Hvilina` class;
2. Define routes using the `get`, `post`, `put` or `delete` methods;
3. Add content type header and set responce data method;
4. Start listening for requests using the `listen` method.

### HTML response:
```php
<?php
require 'hvilina.php';

$app = new Hvilina();

$app->get('/rygor-baradulin', function($request, $response) {
    $response->header('Content-Type', 'text/html');

    $response->renderHTML('<h1>Трэба дома бываць часцей...</h1>');
});

$app->listen();
?>
```

### JSON response:
```php
<?php
require 'hvilina.php';

$app = new Hvilina();

$app->get('/json', function($request, $response) {
  $response->header('Content-Type', 'application/json');

  $response->renderJSON('{"string":"Без назвы", "number":30, "bool":false}');
});

$app->listen();
?>
```
