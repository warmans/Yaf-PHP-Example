# Yaf-php Example Project #

http://uk.php.net/manual/en/book.yaf.php

This is a full-ish example Yaf application implementing:

- Zend-like folder structure
- Error Controller
- Third Party libraries (zend_db)
- Routing

## Requirements: ##
- PHP 5.3+
- Yaf Extension Installed/Enabled
- PDO (sqlite)
- .htaccess must be enabled

## Useful: ##
- Sqliteman (Linux) / Sqlite Administrator (Windows)

Example Development Apache Vhost:

```
    #ensure vhosts are enabled
    NameVirtualHost *:80

    #the vhost
    <VirtualHost *:80>
        DocumentRoot [project dir]/public
        ServerName yaf.dev #or whatever
    </VirtualHost>
```

Set you hosts file to:

```
    127.0.0.1   yaf.dev #or whatever
```

Set the environment in you php.ini by adding this to the bottom:

```ini
    [yaf]
    yaf.environ=devel
```