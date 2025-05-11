# Hvilina Rest API Framework

[EN](#english) | [BE](#belarusian) | [RU](#russian)

---

<a name="english"></a>
## 🌍 English

### A minimalistic PHP framework for building REST APIs and web applications.  
**Version:** 1.2.0 | **Author:** Alexey Kulbacki | **License:** MIT

### 🚀 Features
- HTTP methods: GET, POST, PUT, DELETE
- Dynamic routing (`/user/{id}`)
- Request/Response handling
- HTML template rendering
- Custom headers and status codes
- Built-in 404 handling

### ⚙️ Examples:
```php
<?php
require_once 'hvilina.php';

use Hvilina\Hvilina;

$app = new Hvilina();

// Static route with JSON response with handle request data
$app->get('/json', function($request, $response) {

  $data = json_decode($request->body, true);
  // Making magic with $data ...

  // Set response type
  $response->header('Content-Type', 'application/json');
  // You can use or not status method when you need different than 200
  $response->status(201)->renderText(["string" => "Без назвы", "number" => 30, "bool" => false]);
});

// Dynamic route with plant text response
$app->get('/user/{id}', function ($request, $response) {
  $response->renderText("User ID: " . $request->params['id']);
});

// Ops, this page is not found
$app->get('/404', function($request, $response) {
  // Default method which already contain code 404 as page response code 
  $response->notFound();
});

// Template file with php variables
$app->get('/about', function($request, $response) {
  /*
  this method send variable 'name' into file by using path 'views/about.php'
  Ex. <h1><?= $name ?>!</h1>
  */
  $response->renderView('views/about.php', ['name' => 'About Framework']);
});

$app->listen();
?>
```

---

<a name="belarusian"></a>
## 🌍 Беларуская

### Мінімалістычны PHP-фреймворк для стварэння REST API і вэб-прыкладанняў.
**Версія:** 1.2.0 | **Аўтар:** Аляксей Кульбацкі | **Ліцэнзія:** MIT

### 🚀 Функцыі
- HTTP-метады: GET, POST, PUT, DELETE
- Дынамічная маршрутызацыя (`/user/{id}`)
- Апрацоўка запытаў/адказаў
- Рэндэрынг HTML-шаблонаў
- Карыстальніцкія загалоўкі і коды стану
- Убудаваная апрацоўка 404

### ⚙️ Прыклады:
```php
<?php
require_once 'hvilina.php';

use Hvilina\Hvilina;

$app = new Hvilina();

// Статычны маршрут з тэкставым адказам у фармаце JSON
$app->get('/json', function($request, $response) {

  $data = json_decode($request->body, true);
  // Магія з $data ...

  // Усталёўваем тып адказу
  $response->header('Content-Type', 'application/json');
  // Вы можаце выкарыстоўваць ці не выкарыстоўваць метад status, калі вам патрэбны код адказу, які адрозніваецца ад 200
  $response->status(201)->renderText(["string" => "Без назвы", "number" => 30, "bool" => false]);
});

// Дынамічны маршрут з тэкставым адказам 
$app->get('/user/{id}', function ($request, $response) {
  $response->renderText("User ID: " . $request->params['id']);
});

// Ой, гэтая старонка не знойдзена
$app->get('/404', function($request, $response) {
  // Метад па змаўчанні, які ўжо мае код 404 у якасці адказу старонкі
  $response->notFound();
});

// Файл шаблону са зменнымі PHP
$app->get('/about', function($request, $response) {
  /*
  Гэты метад адпраўляе зменную «name» у файл, выкарыстоўваючы шлях «views/about.php».
  Напрыклад, <h1><?= $name ?>!</h1>
  */
  $response->renderView('views/about.php', ['name' => 'About Framework']);
});

$app->listen();
?>
```


---

<a name="russian"></a>
## 🌍 Русский

### Минималистичный PHP-фреймворк для создания REST API и веб-приложений.
**Версия:** 1.2.0 | **Автор:** Алексей Кульбацкий | **Лицензия:** MIT

### 🚀 Функции
- Методы HTTP: GET, POST, PUT, DELETE
- Динамическая маршрутизация (`/user/{id}`)
- Обработка запросов/ответов
- Отображение шаблонов HTML
- Пользовательские заголовки и коды состояния
- Встроенная обработка 404

### ⚙️ Примеры:
```php
<?php
require_once 'hvilina.php';

use Hvilina\Hvilina;

$app = new Hvilina();

// Статический маршрут с текстовым ответом в JSON формате
$app->get('/json', function($request, $response) {

  $data = json_decode($request->body, true);
  // Магия с $data ...

  // Задайте тип ответа
  $response->header('Content-Type', 'application/json');
  // Вы можете использовать или не использовать метод status, если вам нужен код ответа, отличный от 200
  $response->status(201)->renderText(["string" => "Untitled", "number" => 30, "bool" => false]);
});

// Динамический маршрут с текстовым ответом в формате текст
$app->get('/user/{id}', function ($request, $response) {
  $response->renderText("User ID: " . $request->params['id']);
});

// Упс, эта страница не найдена
$app->get('/404', function($request, $response) {
  // Метод по умолчанию, который уже содержит код 404 в качестве ответа страницы
  $response->notFound();
});

//Переменная sa шаблона файла — PHP
$app->get('/about', function($request, $response) {
  /*
  Этот метод отправляет переменную «name» в файл, используя путь «views/about.php».
  Например, <h1><?= $name ?>!</h1>
  */
  $response->renderView('views/about.php', ['name' => 'About Framework']);
});

$app->listen();
?>
```
