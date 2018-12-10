<?php

const STRING_OPTIONS = [
    'length' => 'checkLength'
];

function validateString($value, $options = []) {
    if (!options) return is_string($value);
    return (is_string($value) && checkStringOptions($options, $value));
}

function checkStringOptions($options, $value) {
    foreach($options as $option) {
        $opt = strstr($option, '(', true);
        $args = strstr($option, '(');
        if (in_array($opt, array_keys(STRING_OPTIONS))) {
            if (call_user_func(STRING_OPTIONS[$opt], $args, $value)) continue;
            if ($validatedOptions) continue; else return false;
        } else {
            return 'Option unknown.';
        }
    }
    return true;
}

function checkLength($args, $value) {
    $val = strlen($value);
    $arg = explode(' ', str_replace(['(', ')'], '', $args));
    switch($arg[0]) {
        case '=':
            return $val == $arg[1];
        case '<':
            return $val < $arg[1];
        case '>':
            return $val > $arg[1];
        case '<=':
            return $val <= $arg[1];
        case '>=':
            return $val >= $arg[1];
    }
}

?>