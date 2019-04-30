# Yet another **PHP data validator**

## BREAK TIME
Some code started to repeat itself... Maybe I shouldn't have made all static, or maybe I should separate domains in a different way. I'm gonna give it some time to think about the better way to continue building this. Thanks and see ya!

## The *What*:
Just a simple validation library. Give it both a rule set and some data and *voilà*! It's probably not very special, nor the best validation lib out there... But it's mine and I love it!

## The *Why*
I'm not the biggest PHP fan, but it's pretty much everywhere I have worked at. Even when developing newer services in another language, PHP is always there to be maintained. So, in an effort to start getting things done on my github, thought about getting something I needed for work and making it into a library.

## The *How*
Well, it's not exactly production ready, but if you wanna play around with it, to install it as a composer package (as it's not on composer yet) you need to:

1) Put this in your **composer.json**:
```json
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/rollergui/php-data-validator.git"
    }
],
"require": {
    "rollergui/php-data-validator": "dev-master"
}
```
2) Require it somewhere you want to use it and call the *validate* static method, passing it a set of rules and some data:
```php
<?php

use \rollergui\Validator\Validator;

$rules = '{
    "name": {
        "type": "string"
    },
    "age": {
        "type": "number"
    },
    "likesIceCream": {
        "type": "boolean"
    },
    "phoneNumber" : {
        "type": string"
    }
}';

$data = [
    'name' => 'Test',
    'age' => 25,
    'likesIceCream' => true,
    'phoneNumber' => 2025550000
];

Validator::validate($rules, $data)
```
**PS**: Both rules and data can be either *JSON*, a *stdObject* or an *associative array*.

3) Results will be a *JSON* object containing two arrays, one with the valid params according to rules, and one with the invalid ones. 
```json
{
    "valid": ["name","age","likesIceCream"],
    "invalid": ["phoneNumber"]
}
```

## TODOs:
* REFACTOR CAUSE IT SUCKS
* add more validators
* UNIT TESTS
* find out how to release as a composer package and, well, release it as a composer package