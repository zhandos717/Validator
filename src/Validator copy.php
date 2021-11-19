<?php

class Validator{

    public $errors = [];

    public $patterns = [
        'IPv4'          => "^(([1-9]?\d|1\d\d|2[0-5][0-5]|2[0-4]\d)\.){3}([1-9]?\d|1\d\d|2[0-5][0-5]|2[0-4]\d)$",
        'IPv6'          => "((^|:)([0-9a-fA-F]{0,4})){1,8}",
        'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]',
        'd-m-y'         => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'y-m-d'         => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'tel'           => '[0-9+\s()-]+',
        'uri'           => '[A-Za-z0-9-\/_?&=]+',
        'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
        'words'         => '[\p{L}\s]+',
        'int'           => '[0-9]+',
        'float'         => '[0-9\.,]+',
        'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address'       => '[\p{L}0-9\s.,()°-]+',
    ];

    /**
     * Discriptions: Adding a route
     * @param string url 
     * @param string controller 
     * @param string action 
     */
    public function set_rules(string $field, string $label, array $rules):void
    {
    
    }

}
