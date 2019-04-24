<?php namespace rollergui\Validator;

class NumberValidator
{
    public static function validateNumber($value)
    {
        return is_numeric($value);
    }
}

