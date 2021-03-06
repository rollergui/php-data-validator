<?php declare(strict_types = 1);

namespace rollergui\Validator;

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

class Validator
{
    private const BUILTIN_VALIDATORS = [
        'boolean' => 'rollergui\Validator\BooleanValidator::validateBoolean',
        'float' => 'rollergui\Validator\NumberValidator::validateNumber',
        'integer' => 'rollergui\Validator\NumberValidator::validateNumber',
        'number' => 'rollergui\Validator\NumberValidator::validateNumber',
        'string' => 'rollergui\Validator\StringValidator::validateString'
    ];

    public static function validate($rules, $data): string
    {
        $formattedRules = self::formatDataAsObject($rules);
        $formattedData = self::formatDataAsObject($data);
        $validatedParams = [];
        foreach ($formattedRules as $param => $rulesPerParam) {
            $validatedParams[$param] = self::validateParam(
                $rulesPerParam,
                $formattedData->$param
            );
        }
        $invalidParams = [];
        $validParams = [];
        foreach ($validatedParams as $param => $valid) {
            if (!$valid) array_push($invalidParams, $param);
            else array_push($validParams, $param);
        }
        return json_encode([
            'valid' => array_values($validParams),
            'invalid' => array_values($invalidParams)
        ]);
    }

    public static function validateParam(object $rules, $param)
    {
        if (in_array($rules->type, array_keys(self::BUILTIN_VALIDATORS))) {
            return self::BUILTIN_VALIDATORS[$rules->type]($param, $rules);
        } else {
            throw new \Exception("Validator '$rules->type' is unknown.");
        }
    }

    public static function formatDataAsObject($data): object
    {
        switch (gettype($data)) {
            case 'string':
                return json_decode($data);
            case 'array':
                return json_decode(json_encode($data));
            case 'object':
                return $data;
            default:
                throw new \Exception('Rules malformed');
        }
    }
}

