<?php
/**
 * View Helper
 */

namespace App\Meliorate;


class ViewHelper
{
    const BACKSLASH = '\\';
    
    public function __construct() { }
    
    /**
     * magic method
     * 
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $class = __NAMESPACE__ . self::BACKSLASH . 'ViewHelpers' 
                . self::BACKSLASH . ucfirst($name);
        if (class_exists($class, true)) {
            return call_user_func_array([new $class, $name], $arguments);
        }
        return null;
    }
    
}
