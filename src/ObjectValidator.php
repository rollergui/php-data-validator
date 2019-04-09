<?php namespace rollergui\Validator;

class ObjectValidator
{

    public static function validateObject($value, $options = [])
    {
        $encodedValidatedParams = Validator::validate($options[0], $value);
        $validatedParams = json_decode($encodedValidatedParams);
        if (!empty($validatedParams->invalid)) {
            return false;
        } else {
            return true;
        }
    }
}

