<?php namespace rollergui\Validator;

class ArrayValidator {

    public static function validateArray($value, $options = []) {
        $validatedParams = Validator::validate($options[0], $value);
        if (!empty($validatedParams['invalid'])) {
            return false;
        } else {
            return true;
        }
    }
    
}

?>