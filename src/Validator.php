<?php

class Validator
{
    /**
     * @var array $patterns
     */
    public $patterns = [

        'email'=>[
            'expression' =>    '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}',
            'title' => 'Invalid email address'
        ],
        'date_dmY'    =>  [
            'expression' =>    '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
            'title' => 'Enter data as date, day-month-year'
        ],
        'date_Y-m-d'=>  [
            'expression' =>    '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
            'title' => 'Enter data as date, year-month-day'
        ],
        'tel'           => [
            'expression' =>    '((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}',
            'title' => 'Enter your phone number'
        ],
        'url' =>[
            'expression'=> '(https?:\/\/)?([\w\d]+\.)?[\w\d]+\.\w+\/?.+',
            'title' => 'Enter the URL correctly'
        ],
        'file'          => [
            'expression' => '[\p{L}\s0-9-_!%&()=\[\]#\,.;+]+\.[A-Za-z0-9]{2,4}i',
            'title' => 'Select a file with a correct name'
        ],
        'ZIP_codes'           => [
            'expression' => '^\d{5}([\-]\d{4})?$',
            'title' => 'Select a file with a correct name'
        ],
        'ip'            => [
            'expression' => '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}',
            'title' => 'Enter the correct IP address. Example 127.0.0.1'
        ],
        'password'      => [
            'expression' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}',
            'title'=> '8 or more characters, including at least one number, one uppercase, one lowercase'
        ],
    ];
    /**
     * @var array $errors
     */
    public $errors = [];
    /**
     * Field name
     * 
     * @param string $name
     * @return this
     */
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Field value
     * 
     * @param mixed $value
     * @return this
     */
    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * File
     * 
     * @param mixed $value
     * @return this
     */
    public function file($value)
    {
        $this->file = $value;
        return $this;
    }

    /**
     * Pattern to apply to the recognition
     * regular expression
     * 
     * @param string $name название шаблона
     * @return this
     */
    public function pattern($name)
    {
        if ($name == 'array') {
            if (!is_array($this->value)) {
                $this->errors[] = 'Field format ' . $this->name . ' incorrect.';
            }
        } else {
            $regex = '/^(' . $this->patterns[$name]['expression'] . ')$/u';
            if ($this->value != '' && !preg_match($regex, $this->value)) {
                $this->errors[] = 'Field format ' . $this->name . ' incorrect.';
            }
        }
        return $this;
    }

    /**
     * Pattern personalizzata
     * 
     * @param string $pattern
     * @return this
     */
    public function customPattern($pattern)
    {
        $regex = '/^(' . $pattern . ')$/u';
        if ($this->value != '' && !preg_match($regex, $this->value)) {
            $this->errors[] = 'Field format ' . $this->name . ' incorrect.';
        }
        return $this;
    }

    /**
     * Campo obbligatorio
     * 
     * @return this
     */
    public function required()
    {

        if ((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)) {
            $this->errors[] = 'Mandatory ' . $this->name . ' field.';
        }
        return $this;
    }

    /**
     * Lunghezza minima
     * del valore del campo
     * 
     * @param int $min
     * @return this
     */
    public function min($length)
    {

        if (is_string($this->value)) {

            if (strlen($this->value) < $length) {
                $this->errors[] = 'Field value ' . $this->name . ' less than the minimum value';
            }
        } else {

            if ($this->value < $length) {
                $this->errors[] = 'Field value ' . $this->name . ' less than the minimum value';
            }
        }
        return $this;
    }

    /**
     * Lunghezza massima
     * del valore del campo
     * 
     * @param int $max
     * @return this
     */
    public function max($length)
    {

        if (is_string($this->value)) {

            if (strlen($this->value) > $length) {
                $this->errors[] = 'Field value ' . $this->name . ' higher than the maximum value';
            }
        } else {

            if ($this->value > $length) {
                $this->errors[] = 'Field value ' . $this->name . ' higher than the maximum value';
            }
        }
        return $this;
    }

    /**
     * Dimensione massima del file 
     *
     * @param int $size
     * @return this 
     */
    public function maxSize($size)
    {

        if ($this->file['error'] != 4 && $this->file['size'] > $size) {
            $this->errors[] = 'The file ' . $this->name . ' exceeds the maximum size of ' . number_format($size / 1048576, 2) . ' MB.';
        }
        return $this;
    }

    /**
     * Validated fields
     * 
     * @return boolean
     */
    public function isSuccess()
    {
        if (empty($this->errors)) return true;
    }

    /**
     * Validation errors
     * 
     * @return array $this->errors
     */
    public function getErrors()
    {
        if (!$this->isSuccess()) return $this->errors;
    }

    /**
     * View errors in Html format
     * 
     * @return string $html
     */
    public function displayErrors():string
    {
        $html = '<ul>';
        foreach ($this->getErrors() as $error) {
            $html .= '<li>' . $error . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    /**
     * View validation result
     *
     * @return bool|string
     */
    public function result():mixed
    {
        if (!$this->isSuccess()) {
            foreach ($this->getErrors() as $error) {
                echo "$error\n";
            }
            exit;
        } else {
            return true;
        }
    }

    /**
     * Check if the value is
     * an integer
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_int($value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_INT)) return true;

        return false;
    }

    /**
     * Check if the value is
     * a float number
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_float($value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_FLOAT)) return true;

        return false;
    }

    /**
     * Check if the value is
     * un url
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_url($value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_URL)) return true;

        return false;
    }

    /**
     * Check if the value is
     * boolean
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_bool($value): bool
    {
        if (is_bool(filter_var($value, FILTER_VALIDATE_BOOLEAN))) return true;

        return false;
    }

    /**
     * Check if the value is
     * Internet Protocol version 4
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_IPv4($value): bool
    {
        if (is_bool(filter_var($value, FILTER_FLAG_IPV4))) return true;

        return false;
    }

    /**
     * Check if the value is
     * Internet Protocol version 6
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_IPv6($value):bool
    {
        if (is_bool(filter_var($value, FILTER_FLAG_IPV6))) return true;

        return false;
    }
    /**
     * Check if the value is
     * email
     *
     * @param mixed $value
     * @return bool
     */
    public static function is_email($value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) return true;

        return false;
    }
}
