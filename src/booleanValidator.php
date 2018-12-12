<?php namespace rollergui\Validator;

class BooleanValidator {

    public static function validateBoolean($value, $options = []) {
        return is_bool($value);
    }
    
}

?>