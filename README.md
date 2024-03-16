# Shortly

This is a fork of [Shorty](https://github.com/mikecao/shorty) by @mikecao, a simple URL shortener for PHP.

Shortened URLs are 301 redirects which will still display open graph previews when shared on social media. It's like bit.ly but you own it and it costs nothing but a domain registration.

## Changes

Changes in the Shortly fork made by @ttscoff ([Brett Terpstra](https://brettterpstra.com)):

- Allow limiting shortening to one domain
- Allow forwarding of paths containing hyphens or which are not found in the database to be forwarded to a root url
- Allow appending query strings to urls before shortening or forwarding
- Accept `format=qr` and `size=XXX` to create QR codes for shortened urls
- Add longURL keys to JSON and XML output

## Installation

1\. Download and extract the files to your web directory.

2\. Use the included `database.sql` file to create a table to hold your URLs.

3\. Configure your webserver.

For **Apache**, edit your `.htaccess` file with the following (rename ht.access to .htaccess):

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?q=$1 [QSA,L]

For **Nginx**, add the following to your server declaration:

    server {
        location / {
            rewrite ^/(.*)$ /index.php?q=$1;
        }
    }

4\. Copy `config.php.example` to `config.php` and edit.

## Config options

Set `$hostname` to the base url of your shortener. Include protocol but no trailing slash.

By default urls from any domain can be shortened. To limit shortening to a specific domain, set `$site_specific = true` in `config.php` and add a domain for `$target` (domain only, no protocol or trailing slash).

If a path is passed that contains hyphens or is otherwise not found, Shortly will forward to the url specified in `$long_redirect`, with the path appended to the base url. For example, if `$long_redirect` is `https://blog.example.com/` and somebody tries to access `example.com/test-post`, the request will be forwarded to `https://blog.example.com/test-post`.

If you would like a query string (such as Google UTM parameters) appended to urls before shortening, set `$query_string`. If you're using this as a general shortener and expect to pass it urls that already contain query strings, leave this empty ('') to avoid double query strings.

Set mySQL database name, host, user, and password in the `$connection` setting.

See the comments in `config.php` for more options on character sets and randomizing short urls to make them less guessable.

## Generating short URLs

To generate a short URL, simply pass in a `url` query parameter to your Shortly installation:

    http://example.com/?url=http://www.google.com

This will return a shortened URL such as:

    http://example.com/9xq

When a user opens the short URL they will be redirected to the long URL location.

By default, Shortly will output a plain text version of the shortened URL. This is ideal for calling from scripts and command line applications. If you'd like to have a full HTML link tag output, add `&format=html` to your call.

    http://example.com/?url=http://www.google.com&format=html

To generate a QR code for a shortened URL, use `format=qr`. By default this will generate a 200x200px PNG file. You can use `size=XXX` to set a size between 100 and 500 pixels if desired.

The possible formats are `html`, `xml`, `text`, `json`, and `qr`. XML and JSON responses will contain keys for `url` and `longURL`.

## Analytics

The mySQL database of shortened urls will contain basic analytics such as hit counts and access dates. There is currently no interface for displaying this information.

Note that when you share a shortened URL to social media, the preview generators for those sites will repeatedly make hits on the URL. Shortly makes no distinction between those and actual visits, so these numbers can't be used for sales analytics or anything like that, other than to see how widely your shortened url may have spread.

## Whitelist

By default anyone is allowed to enter a new URL for shortening. To restrict the saving of URLs to 
certain IP addresses, use the `allow` function:

    $shorty->allow('192.168.0.10');

## Requirements

* PHP 5.1+
* PDO extension

## License

Shortly is licensed under the [MIT](https://github.com/mikecao/shorty/blob/master/LICENSE) license.
