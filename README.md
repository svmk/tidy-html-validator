PHP Tidy validator
==================

Example:
```php
use TidyValidator\Validator;
$html = file_get_contents('http://google.com/');
$result = Validator::validate($html);
print_r($result);
```