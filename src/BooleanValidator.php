<?php declare(strict_types = 1);

namespace rollergui\Validator;

class BooleanValidator
{
    public static function validateBoolean(bool $value, object $options): bool
    {
        return true;
    }
}
