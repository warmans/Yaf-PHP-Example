# Yaf-php Example Project #

http://uk.php.net/manual/en/book.yaf.php

This is a full-ish example Yaf application implementing:

- Zend-like folder structure
- Error Controller
- Third Party libraries (zend_db)
- Routing
- Plugins (to achieve layout wrapper view)
- Registry


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

## Benchmark ##

To see the equivilent benchmart for Zend see:

https://github.com/warmans/Yaf-PHP-Example-ZendEquiv

```
Server Software:        Apache/2.2.21
Server Hostname:        yaf.dev
Server Port:            80

Document Path:          /
Document Length:        3314 bytes

Concurrency Level:      5
Time taken for tests:   10.931 seconds
Complete requests:      1000
Failed requests:        0
Write errors:           0
Total transferred:      3509000 bytes
HTML transferred:       3314000 bytes
Requests per second:    91.49 [#/sec] (mean)
Time per request:       54.653 [ms] (mean)
Time per request:       10.931 [ms] (mean, across all concurrent requests)
Transfer rate:          313.50 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.1      0       0
Processing:    15   54  10.9     53     114
Waiting:       15   48  12.0     47     114
Total:         15   55  10.9     53     114

Percentage of the requests served within a certain time (ms)
  50%     53
  66%     56
  75%     58
  80%     61
  90%     66
  95%     74
  98%     89
  99%     96
```