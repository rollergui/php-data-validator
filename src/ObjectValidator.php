<?php namespace rollergui\Validator;

class ObjectValidator {

    public static function validateObject($value, $options = []) {
        $validatedParams = json_decode(Validator::validate($options[0], $value));
        if (!empty($validatedParams->invalid)) {
            return false;
        } else {
            return true;
        }
    }
    
}

?>