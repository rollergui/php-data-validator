<?php
require __DIR__.'/../vendor/autoload.php';

const builtinValidators = [
    'boolean' => 'validateBoolean',
    'number' => 'validateNumber',
    'string' => 'validateString'
];

function validate($rules, $data) {
    $validatedParams = [];
    foreach ($rules as $param => $rulesPerParam) {
        $validatedParams[$param] = validateParam($rulesPerParam, $data[$param]);
    }
    var_dump($validatedParams);
}

function validateParam($rules, $param) {
    $validator = array_shift($rules);
    if (in_array($validator, array_keys(builtinValidators))) {
        return call_user_func(builtinValidators[$validator], $param, $rules);
    } else {
        return 'Validator unkown.';
    }
}

?>
