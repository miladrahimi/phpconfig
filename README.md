# PHPConfig
Free PHP configuration file tools for neat and powerful projects!

## Overview
PHPConfig is a tiny package for access static configuration files.
It helps you provide easy-to-use configuration files for your PHP project.

## Installation
### Using Composer (Recommended)
Read
[How to use composer in php projects](http://miladrahimi.com/blog/2015/04/12/how-to-use-composer-in-php-projects)
article if you are not familiar with [Composer](http://getcomposer.org).

Run following command in your project root directory:

```
composer require miladrahimi/phpconfig
```

### Manually
You may use your own autoloader as long as it follows [PSR-0](http://www.php-fig.org/psr/psr-0) or
[PSR-4](http://www.php-fig.org/psr/psr-4) standards.
Just put `src` directory contents in your vendor directory.

### Getting Started
First of all, you must write the configuration files.
If you use PHP >= 5.4 you should use new PHP array syntax `[]`,
otherwise you must use old-style array syntax `array()`.
See the following configuration file sample:

```
<?php
return array(
    "mysql" => array(
        "username" => "milad",
        "password" => "secret",
        "hostname" => "localhost",
        "database" => "shop"
    ),
    "sqlite" => array(
        "filename" => "path/to/db.sqlite",
        "username" => "milad",
        "password" => "secret"
    )
);
```

Now you may retrieve data from the configuration file above this way:

```
use MiladRahimi\PHPConfig\Config;

$config = new Config();
$config->path(__DIR__ . "/database.php");
echo $config->get("mysql", "password");
```

It echos `secret` string.

### Getting all data
If you pass no parameter to `Config::get()` method, it will return all configuration file data:

```
$all_data = $config->get();
print_r($all_data);
```

The output will be:

```
Array
(
    [mysql] => Array
        (
            [username] => milad
            [password] => secret
            [hostname] => localhost
            [database] => shop
        )
    [sqlite] => Array
        (
            [filename] => path/to/db.sqlite
            [username] => milad
            [password] => secret
        )

)
```

### Getting smaller arrays and single data
You usually don't need the all data.
What you need is single values or smaller arrays.
To access configuration data deeper, you can pass more parameters to `Config::get()` method.

```
$r = $config->get("mysql");
```

The example above return only mysql part of the configuration file (mentioned above).
The `$r` will be:

```
Array
(
    [username] => milad
    [password] => secret
    [hostname] => localhost
    [database] => shop
)
```

You can pass more parameters to this method and access deeper.

```
$r = $config->get("mysql","database");
```

Then the output will be a single string value:

```
shop
```

### Path method
As I mentioned above, you can pass the configuration file via `Config::path()` method.
This method returns the set path if you call it without parameter.

### Multiple files approach
If you have multiple configuration file, there is more convenient approach to set their paths.
Actually you can set the directory and file names separately,
then for traversing between files,
you only need to set file names.

```
use MiladRahimi\PHPConfig\Config;

$config = new Config();
$config->setDirectory(__DIR__);
$config->setFile("database.php");
$db = $config->get("mysql", "database");
$config->setFile("superuser.php");
$un = $config->get("admin", "username");
```

## License
PHPConfig is created by [Milad Rahimi](http://miladrahimi.com)
and released under the [MIT License](http://opensource.org/licenses/mit-license.php).