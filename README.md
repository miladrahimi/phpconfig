[![Build Status](https://travis-ci.com/miladrahimi/file-bridge-server.svg?branch=master)](https://travis-ci.com/miladrahimi/file-bridge-server)

# PhpConfig
A PHP configuration tool

## Overview
PhpConfig is a minimal package for adding configuration tool to your PHP project.
It provides different types of config repositries such as runtime array, php file, directory of php files, json file and directory of json files.

## Installation
Run following command in the root directory of your project:

```bash
composer require miladrahimi/phpconfig
```

##Getting started

First of all, you need to provide configuration data to PhpConfig. It supports different types of repositories like php file, json file, and you can use anyone you are interested in.

As an example we use array repository as the configuration data source. The following example demonstrates how to use an array of data as the data source, how to access data in your code and also how to go deeper using `.` operator.

```php
use MiladRahimi\PhpConfig\Config;
use MiladRahimi\PhpConfig\Repositories\ArrayRepository;

$data = [
    'name' => 'MyProject',
    'mysql' => [
        'hostname' => '127.0.0.1',
        'username' => 'root',
        'password' => 'secret',
        'database' => 'my_database'
    ]
];

$repository = new ArrayRepository($data);
$config = new Config($repository);

$name = $config->get('name'); // "MyProject"
$mysql_username = $config->get('mysql.username', 'root'); // "root"
$mysql_password => $config->get('mysql.password', ''); // "secret"
$locale = $config->get('locale', 'en'); // "en" (Default)

// Runtime config setting/manipulating
$config->set('locale', 'fa');

$locale = $config->get('locale', 'en'); // "fa"

```

## Repositories

The example above illustrates how to use a defined array as the respository for PhpConfig. In this section, we introduce some other repositories.

### Config PHP File

You can put the data array into a separate PHP file this way:

```php
<?php

return [
    'name' => 'MyProject',
    'mysql' => [
        'hostname' => '127.0.0.1',
        'username' => 'root',
        'password' => 'secret',
        'database' => 'my_database'
    ]
];
```

And to use the config file:

```php
use MiladRahimi\PhpConfig\Config;
use MiladRahimi\PhpConfig\Repositories\FileRepository;

$repository = new FileRepository('config.php');
$config = new Config($repository);

$mysql_username = $config->get('mysql.username');
```

### Config Directory

You probably need to split your configuration data into multiple files in a larger scale. Don't worry about it, it will be handled so easy!

Consider the config files in a directory like this:

```
Project
- index.php
- configs
- - app.php
- - mysql.php
```

And `app.php` :

```php
<?php
    
return [
    'name' => 'MyProject',
    'locale' => [
        'code' => 'fa',
        'name' => 'Farsi (Persian)',
    ],
    'url' => 'https://example.com'
];
```

And `mysql.php`:

```php
<?php

return [
    'hostname' => '127.0.0.1',
    'username' => 'root',
    'password' => 'secret',
    'database' => 'my_database'
];
```

And the main code:

```php
use MiladRahimi\PhpConfig\Config;
use MiladRahimi\PhpConfig\Repositories\DirectoryRepository;

$config = new Config(new DirectoryRepository('configs'));

$app_locale_code = $config->get('app.locale.code', 'en');
$mysql_username = $config->get('mysql.username', 'default-username');
```

### Config JSON File

PHP array syntax looks very nice but you may prefer JSON, if so, there's a good news, you can write your configs in JSPN format like the following example.

The `config.json`:

```json
{
    "app": {
        "name": "MyProject",
        "locale": {
            "code": "fa",
            "name": "Farsi (Persian)"
        }
    }
}
```

And the main code:

```php
use MiladRahimi\PhpConfig\Config;
use MiladRahimi\PhpConfig\Repositories\JsonFileRepository;

$config = new Config(new JsonFileRepository('config.json'));

$app_locale_code = $config->get('app.locale.code', 'en'); // "fa"
```

### Config JSON Directory

A Single JSON configuration file still has the same single php file problem, so we have implemented another repository type for multiple JSON files.

Consider the config files in a directory like this:

```
Project
- index.php
- configs
- - app.json
- - mysql.json
```

And `app.json` :

```json
{
    "name": "MyProject",
    "locale": {
        "code": "fa",
        "name": "Farsi (Persian)"
    }
}
```

And `mysql.json`:

```json
{
    "hostname": "localhost",
    "username": "root",
    "password": "secret",
    "database": "my_project_db"
}
```

And the main code:

```php
use MiladRahimi\PhpConfig\Config;
use MiladRahimi\PhpConfig\Repositories\JsonDirectoryRepository;

$config = new Config(new JsonDirectoryRepository('configs'));

$app_locale_code = $config->get('app.locale.code', 'en'); // "fa"
$mysql_username = $config->get('mysql.username', 'default-username');
```

### Custom Repositories

You can also make your own repositories by implementing following interface:

```php
<?php
    
namespace MiladRahimi\PhpConfig\Repositories;

interface Repository
{
    /**
     * Get configuration data
     *
     * @return array
     */
    public function getData(): array;
}
```

## License
PhpConfig is initially created by [Milad Rahimi](http://miladrahimi.com) and released under the [MIT License](http://opensource.org/licenses/mit-license.php).