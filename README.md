# PHPConfig
Free PHP configuration file tools for neat and powerful projects!

## Documentation
PHPConfig is a tiny package for access static configuration files.
It helps you provide easy-to-use configuration files for you application.

### Installation
#### Using Composer
It's strongly recommended to use [Composer](http://getcomposer.org).
If you are not familiar with Composer, The article
[How to use composer in php projects](http://www.miladrahimi.com/blog/2015/04/12/how-to-use-composer-in-php-projects)
can be useful.
After installing Composer, go to your project directory and run following command there:
```
php composer.phar require miladrahimi/phpconfig
```
Or if you have `composer.json` file already in your application,
you may add this package to your application requirements
and update your dependencies:
```
"require": {
    "miladrahimi/phpconfig": "~1.0"
}
```
```
php composer.phar update
```
#### Manually
You can use your own autoloader as long as it follows [PSR-0](http://www.php-fig.org/psr/psr-0) or
[PSR-4](http://www.php-fig.org/psr/psr-4) standards.
In this case you can put `src` directory content in your vendor directory.

### Getting Started
First of all, you must write the configuration files.
If you use PHP >= 5.4 you should use new PHP array syntax `[]`,
otherwise you can use old-style array syntax `array()`.
See the following configuration file sample:
```
<?php
return [
    "mysql" => [
        "username" => "milad",
        "password" => "secret",
        "hostname" => "localhost",
        "database" => "shop"
    ],
    "sqlite" => [
        "filename" => "path/to/db.sqlite",
        "username" => "milad",
        "password" => "secret"
    ]
];
```
Now you may retrieve data from the configuration file above:
```
$config = new Config();
$config->setDirectory(__DIR__ . "/config");
$config->setName("database.php");
$r = $config->get();
print_r($r);
```
And the output must be:
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

### Getting all data
As mentioned above to get all data, you can call the `Config::get()` method this way:
```
$all_data = $config->get();
```

### Getting single values
You usually don't need the all data in a only one array.
What you need is single values or smaller arrays.
To access configuration data deeper, you can pass some parameters to `Config::get()` method.
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

### PHPConfigException
There are some situation which this exception will be thrown.
Here are methods and messages:
*   `Config file not found` in `Config::get()` when the config file not exist.
*   `Invalid config file content` in `Config::get()` when the config file has not well format.
*   `Value not found` in `Config::get()` when the requested parameter not exist as a key in the config file.

## Contributor
*	[Milad Rahimi](http://miladrahimi.com)

## Official homepage
*   [PHPConfig](http://miladrahimi.github.io/phpconfig)

## License
PHPConfig is created by [MiladRahimi](http://miladrahimi.com)
and released under the [MIT License](http://opensource.org/licenses/mit-license.php).