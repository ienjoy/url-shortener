url-shortener
=============

Simplistic url shortener PHP script, no database required, clean redirect for non existing shortcuts.

Based on Martin Angelov quick tip on (tutorialzine)[http://tutorialzine.com/2013/12/quick-tip-create-a-simple-url-shortener-with-10-lines-of-php/].

Install
---------
1. Download and unzip the [url-shortener script](https://github.com/berteh/url-shortener/archive/master.zip) to your webserver, eg. in ``/var/www``
2. Configure a virtual host to serve it, typically (on apache):

``
<VirtualHost *:80>
        ServerName short.myhost.com
        ServerAlias  s.myhost.com
        DocumentRoot /var/www/url-shortener
        <Directory /var/www/url-shortener>
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>
</VirtualHost>
``


Use
--------
Add any shortcut you wish to serve in ``links.ini`` file, in the form `` shortcut = "http://full-long-url"``.


Advanced settings
---------
Optionally change 
1. the url used when shortcuts are not found to your own search engine, in the config section of ``index.php``.
2. the mechanism to get warnings of unused shortcuts that are called, either in log file or by mail, by uncommenting the last line of ``index.php``.


Support and Contribute
--------------
Support via the project (Issues)[/issues], contribute via (pull-request)[/pull].


License
-----------
The MIT License (MIT)

Copyright (c) 2014 Berteh

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
