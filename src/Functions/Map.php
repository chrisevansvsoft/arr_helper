<?php

namespace ArrHelper\Functions;

use ArrHelper\Arr;

/**
 * Trait Map
 * @package ArrHelper\Functions
 * @mixin Arr
 */
trait Map
{
    /**
     * Returns a new array after performing the provided function on every element
     * @param  callable  $func
     * @return self
     */
    public function map($func)
    {
        return $this->runMap($func);
    }

    /**
     * Returns a new array after performing the provided function on every element recursively
     * @param  callable  $func
     * @return self
     */
    public function mapRecursive($func)
    {
        return $this->runMap($func, true);
    }

    /**
     * Returns a new array after performing the provided function on every element
     * Can be recursive (runs on sub-array elements)
     * @param  callable  $func
     * @param  bool      $recursive
     * @return self
     */
    private function runMap($func, $recursive = false)
    {
        if (count($this->arr) <= 0) {
            return self::with([]);
        }
        $newArr = [];
        foreach ($this->arr as $element) {
            if ($recursive && is_array($element)) {
                array_push($newArr, self::with($element)->runMap($func, $recursive)->getArray());
            } else {
                array_push($newArr, call_user_func($func, $element));
            }
        }
        return self::with($newArr);
    }
}