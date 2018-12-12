<?php namespace rollergui\Validator;

require(__DIR__ . '/../vendor/autoload.php');

class Validator {

    private const BUILTIN_VALIDATORS = [
        'boolean' => 'rollergui\Validator\BooleanValidator::validateBoolean',
        'number' => 'rollergui\Validator\NumberValidator::validateNumber',
        'string' => 'rollergui\Validator\StringValidator::validateString'
    ];

    public static function validate($rules, $data) {
        $validatedParams = [];
        foreach ($rules as $param => $rulesPerParam) {
            $validatedParams[$param] = self::validateParam($rulesPerParam, $data[$param]);
        }
        var_dump($validatedParams);
    }

    public static function validateParam($rules, $param) {
        $validator = array_shift($rules);
        $options = explode(', ', $rules[0]);
        if (in_array($validator, array_keys(self::BUILTIN_VALIDATORS))) {
            return call_user_func(self::BUILTIN_VALIDATORS[$validator], $param, $options);
        } else {
            throw new \Exception("Validator '$validator' is unknown.");
        }
    }

}

?>
