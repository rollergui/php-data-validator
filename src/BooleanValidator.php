<?php namespace rollergui\Validator;

class BooleanValidator
{
    public static function validateBoolean($value)
    {
        return is_bool($value);
    }
}

