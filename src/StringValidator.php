<?php namespace rollergui\Validator;

class StringValidator
{
    private const STRING_OPTIONS = [
        'length' => 'self::checkLength'
    ];

    public static function validateString($value, $options = [])
    {
        if (!$options) return is_string($value);
        return (is_string($value) && self::checkStringOptions($options, $value)); 
    }

    public static function checkStringOptions($options, $value)
    {
        foreach ($options as $option) {
            $opt = strstr($option, '(', true);
            $args = strstr($option, '(');
            if (in_array($opt, array_keys(self::STRING_OPTIONS))) {
                if (call_user_func(self::STRING_OPTIONS[$opt], $args, $value)) continue;
                if ($validatedOptions) continue; else return false;
            } else {
                return 'Option unknown.';
            }
        }
        return true;
    }

    public static function checkLength($args, $value)
    {
        $val = strlen($value);
        $arg = explode(' ', str_replace(['(', ')'], '', $args));
        switch ($arg[0]) {
            case '=':
                return $val == $arg[1];
            case '<':
                return $val < $arg[1];
            case '>':
                return $val > $arg[1];
            case '<=':
                return $val <= $arg[1];
            case '>=':
                return $val >= $arg[1];
        }
    }
}

