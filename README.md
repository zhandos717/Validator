<a name="index_block"></a>
<a name="block1"></a>
## 1. Installation [↑](#index_block)
### when declaring a class, we immediately pass the error page

```php
<?php
    include '../src/Router.php';
    $route = new Router('templates/404.php');
```
<a name="block2"></a>
## 2. Setting the route [↑](#index_block)

<a name="block2.1"></a>
### 2.1. Adding routes and pages to display [↑](#index_block)

```php
<?php
    $route->Add('', 'templates/home.php');
    $route->Add('posts', 'templates/posts.php');
```
