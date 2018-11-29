<?php

const builtinValidators = [
    'boolean' => 'validateBoolean',
    'number' => 'validateNumber',
    'string' => 'validateString'
];

function validate($rules, $data) {
    foreach($rules as $param => $rule) {
        print_r($param);
        print_r($rule);
        if (in_array($rule[0], array_keys(builtinValidators))) {
            if (call_user_func(builtinValidators[$rule[0]], $data[$param], array_shift($rule))) {
                echo ('Success!');
            } else {
                echo ('Oooops! Not valid!');
            }
        }
    }
}

function validateString($value, $options = []) {
    return is_string($value);
}

function validateNumber($value, $options = []) {
    return is_numeric($value);
}

function validateBoolean($value, $options = []) {
    return is_bool($value);
}

?>
