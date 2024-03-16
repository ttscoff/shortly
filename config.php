<?php
// Hostname for your URL shortener
$hostname = 'https://example.com';

// If you only want to allow urls from a specific domain to be shortened
$site_specific = false;
// The hostname to limit to (no protocol or trailing slash)
$target = 'example.com';
// If the short url contains dashes or isn't found, append it to this url
$long_redirect = 'https://example.com/blog/';
// query string to add to long url before shortening or forwarding
$query_string = '?utm_source=blog&utm_medium=web&utm_campaign=share_button';

// PDO connection to the database
$connection = new PDO('mysql:dbname=shorty;host=localhost', 'user', 'password');

// Choose your character set (default)
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

// The following are shuffled strings of the default character set.
// You can uncomment one of the lines below to use a pre-generated set,
// or you can generate your own using the PHP str_shuffle function.
// Using shuffled characters will ensure your generated URLs are unique
// to your installation and are harder to guess.

// $chars = 'XPzSI6v5DqLuBtVWQARy2mfwkC14F8HUTOG0aJiYpNrl9Zxgbd3Khsno7jMeEc';
// $chars = 'PAC3mfIazxgF1lVK4wJ2WEHY0dcb87TrsZeBpL9vNUMGktROijnSoq5DX6yQhu';
// $chars = 'zFr7ALOJnGRxtKSs0oQT5NeZjdI1iX8DM2lHaCVyg4mUPp63BkEubc9qWfhwYv';
// $chars = 'u7oIws3pVWZMQjA4XhNtyvglkEer1C2J5YdT6zLiFm0ObPc8S9KaDHqRBnfUGx';
// $chars = 'gZ6hdO59XTJmUP31YMG7FvQyqjlKkf8zwitx0AcupDVs2RWCIBaNreob4nLHES';

// If you want your generated URLs to even harder to guess, you can set
// the salt value below to any non empty value. This is especially useful for
// encoding consecutive numbers.
$salt = '';

// The padding length to use when the salt value is configured above.
// The default value is 3.
$padding = 3;
?>
