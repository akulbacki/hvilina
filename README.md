# Hvilina Rest API Framework

[EN](#english) | [BE](#беларуская, soon) | [RU](#русский, soon)

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
  // You can use or not status method when you need different than 200 page response code
  $response->status(201)->renderText(["string" => "Без назвы", "number" => 30, "bool" => false]);
});

// Dynamic route with Plant text response
$app->get('/user/{id}', function ($request, $response) {
  $response->renderText("User ID: " . $request->params['id']);
});

// Ops, this page is not found
$app->get('/404', function($request, $response) {
  // Default method which already contain code 400 as page response code 
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
