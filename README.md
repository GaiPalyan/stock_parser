### Offers.xml parser

#### Install
~~~
$ make setup
$ sail up -d
~~~

#### Migration
~~~
$ sail php artisan migrate
~~~

#### Import command
~~~
$ sail php artisan import:xml -p, --path[=PATH]
~~~

If you do not pass the path, the default will be used.

DEFAULT_FILE_PATH = '/var/local/data.xml';

~~~
volumes:
    - '.:/var/www/html'
    - '/var/local:/var/local
~~~


