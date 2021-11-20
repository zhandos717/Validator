<a name="index_block"></a>
<a name="block1"></a>
## 1. Installation [↑](#index_block)
### Connect the file and declare the class

```php
<?php
    require '../src/Validator.php';
   $val = new Validator;
```
<a name="block2"></a>
## 2. Introduction to validation [↑](#index_block)

<a name="block2.1"></a>
### 2.1. Adding validation directly to the form via the pattern attribute and title [↑](#index_block)

```php
<?php
     echo '<input type="password" name="password" pattern='.$val->patterns['password']['expression'].' title='.$val->patterns['password']['title'].' placeholder="password" class="form-control">';
```

<a name="block2.2"></a>
### 2.2. Data validation with dynamic methods [↑](#index_block)

```php
<?php

        $val->name('email')->value($_POST['email'])->pattern('email')->required();
        $val->name('tel')->value($_POST['tel'])->pattern('tel');
        $val->name('ip')->value($_POST['ip'])->pattern('ip');
        $val->name('message')->value($_POST['message'])->required();

```

<a name="block2.3"></a>
### 2.3 Data validation with static methods [↑](#index_block)

```php
<?php
    if (Validator::is_email($_POST['email'])) {
                echo 'email correct';
    }else{
        echo 'email is not correct';
    }

```

<a name="block 3"></a>
### 3 Error output during dynamic check [↑](#index_block)

#### Usage:

```php
<?php
      echo  $val->displayErrors() 

```

#### Output:
```HTML
 <ul><li>error text</li></ul> 
```