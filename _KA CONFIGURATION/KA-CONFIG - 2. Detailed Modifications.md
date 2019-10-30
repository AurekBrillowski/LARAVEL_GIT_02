# KA-TECH PRE-CONFIGURED LARAVEL INSTALLS

## 1. INSTALLED: Doctrine DBAL

```bash
	PROJECT ROOT :> composer require doctrine/dbal
```

## 2. ADDED Custom Artisan Command: "php artisan telstar:serve"

## 3. INSTALLED & CONFIGURED: SQLite Database

## 4. MODIFIED phpunit.xml for In-Memory DB testing.

## 5. CONFIGURED: MySQL Database

# ...

# 3. SQLite Database Install & Config

## CREATED: / database / database.sqlite

## MODIFIED: / .env

-   ### ADDED:

```php
	SQLITE_CONNECTION=sqlite
```

-   ### ADDED:

```php
	SQLITE_FOREIGN_KEYS=true
```

## MODIFIED: / config / database.php

-   ### ADDED:

```php
	'default' => env('SQLITE_CONNECTION', 'sqlite'),
```

-   ### DELETED:

```php
'sqlite' => [
	'driver' => 'sqlite',
	'url' => env('DATABASE_URL'),
	'database' => env('DB_DATABASE', database_path('database.sqlite')),
	'prefix' => '',
	'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
],
```

-   ### ADDED:

```php
'sqlite' => [
	'driver' => 'sqlite',
	'url' => env('DATABASE_URL'),
		'database' => env('SQLITE_DATABASE', database_path('database.sqlite')),
		'prefix' => '',
		'foreign_key_constraints' => env('SQLITE_FOREIGN_KEYS', true),
	],
```

## MODIFIED: / phpunit.xml

-   ### ADDED to \<PHP> section:

```xml
    <server name="DB_CONNECTION" value="sqlite"/>
    <server name="DB_DATABASE" value=":memory:"/>
```

# 4. MySQL Datbase Configuration

## 1. Used Sequel Pro to set up a local instance of MySQL and use the credentials in the .env file in the next step.

## 2. MODIFIED: / .env

-   ### ADDED:

```php
	// == ================================================== ==
	// == OPTION 2: MySQL Relational Database (RDBMS)...
	MYSQL_CONNECTION=mysql
	MYSQL_HOST=127.0.0.1
	MYSQL_PORT=3306
	MYSQL_DATABASE=YourDbName
	MYSQL_USERNAME=root
	MYSQL_PASSWORD=root
```

## 3. MODIFIED: / config / database.php

-   ### ADDED:

```php
	'default' => env('MYSQL_CONNECTION', 'mysql'),
```

-   ### MODIFIED:

```php
		'mysql' => [
			'driver' => 'mysql',
			'url' => env('DATABASE_URL'),
			'host' => env('MYSQL_HOST', '127.0.0.1'),
			'port' => env('MYSQL_PORT', '3306'),
				'database' => env('MYSQL_DATABASE', 'forge'),
				'username' => env('MYSQL_USERNAME', 'forge'),
				'password' => env('MYSQL_PASSWORD', ''),
				'unix_socket' => env('MYSQL_SOCKET', ''),
				'charset' => 'utf8mb4',
				'collation' => 'utf8mb4_unicode_ci',
				'prefix' => '',
				'prefix_indexes' => true,
				'strict' => true,
				'engine' => null,
				'options' => extension_loaded('pdo_mysql') ? array_filter([
				    PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
				]) : [],
			],
```
