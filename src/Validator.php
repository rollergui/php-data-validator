<?php namespace rollergui\Validator;

$composerAutoload = [
    __DIR__ . '/../vendor/autoload.php', // for the dev repo
    __DIR__ . '/../../autoload.php', // when installed as a composer dep
];

foreach ($composerAutoload as $autoload) {
    if (file_exists($autoload)) {
        require $autoload;
        break;
    }
}


class Validator {

    private const BUILTIN_VALIDATORS = [
        'boolean' => 'rollergui\Validator\BooleanValidator::validateBoolean',
        'number' => 'rollergui\Validator\NumberValidator::validateNumber',
        'string' => 'rollergui\Validator\StringValidator::validateString',
        'array' => 'rollergui\Validator\ArrayValidator::validateArray' 
    ];

    public static function validate($rules, $data) {
        $validatedParams = [];
        foreach ($rules as $param => $rulesPerParam) {
            $validatedParams[$param] = self::validateParam($rulesPerParam, $data[$param]);
        }
        $invalidParams = [];
        $validParams = [];
        foreach($validatedParams as $param => $valid) {
            if (!$valid) array_push($invalidParams, $param);
            else array_push($validParams, $param);
        }

        return json_encode([
            'valid' => array_values($validParams),
            'invalid' => array_values($invalidParams)
        ]);
    }
    

    public static function validateParam($rules, $param) {
        $validator = array_shift($rules);
        $options = is_array($rules) ? $rules : explode(', ', $rules[0]);
        if (in_array($validator, array_keys(self::BUILTIN_VALIDATORS))) {
            return call_user_func(self::BUILTIN_VALIDATORS[$validator], $param, $options);
        } else {
            throw new \Exception("Validator '$validator' is unknown.");
        }
    }

}

?>
