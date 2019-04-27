<?php declare(strict_types = 1);

namespace rollergui\Validator;

class NumberValidator
{
    public static function validateNumber($value, object $options): bool
    {
        return is_numeric($value);
    }
}
