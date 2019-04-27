<?php declare(strict_types = 1);

namespace rollergui\Validator;

class NumberValidator
{
    public static function validateNumber($value, object $options): bool
    {
        switch ($options->type) {
            case 'number':
                return is_numeric($value);
            case 'integer':
                return is_int($value);
            case 'float':
                return is_float($value);
        }
    }
}
