<?php namespace rollergui\Validator;

class NumberValidator
{

    public static function validateNumber($value, $options = [])
    {
        return is_numeric($value);
    }
}

