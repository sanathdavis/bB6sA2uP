<?php

/**
 * Dropdown view helper for list passed down as objects
 */

namespace App\Meliorate\ViewHelpers;

class Dropdown
{
    public function __construct(){ }

    public function dropdown($default, $objects, $selected = 0, $key = 'title')
    {
        $option = '<option value="%d">%s</option>';
        $optionSelected = '<option value="%d" selected="selected">%s</option>';
        $options = [];
        $options[] = '<option value="">Select ' . $default . '</option>';
        if (count($objects) > 0) {
            if ($selected > 0) {
                foreach ($objects as $object) {
                    if ($object->id == $selected) {
                        $options[] = sprintf($optionSelected, $object->id, e($object->$key));
                    } else {
                        $options[] = sprintf($option, $object->id, e($object->$key));
                    }
                }
            } else {
                foreach ($objects as $object) {
                    $options[] = sprintf($option, $object->id, e($object->$key));
                }
            }
        }
        return implode(PHP_EOL, $options);
    }
}
