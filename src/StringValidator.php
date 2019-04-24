<?php namespace rollergui\Validator;

class StringValidator
{
    public static function validateString($value)
    {
        return is_string($value);
    }
}

