<?php

namespace ArrHelper\Functions;

use ArrHelper\Arr;

/**
 * Trait Filter
 * @package ArrHelper\Functions
 * @mixin Arr
 */
trait Filter
{
    /**
     * Returns a new array with only the elements that satisfy the supplied predicate
     * @param  callable  $func
     * @return Arr
     */
    public function filter($func)
    {
        return $this->runFilter($func);
    }

    /**
     * Returns a new array with only the elements that satisfy the supplied predicate, searching recursively
     * @param  callable  $func
     * @return Arr
     */
    public function filterRecursive($func)
    {
        return $this->runFilter($func, true);
    }

    /**
     * Returns a new array with only the elements that satisfy the supplied predicate
     * @param  callable  $func
     * @param  bool      $recursive
     * @return Arr
     */
    private function runFilter($func, $recursive = false)
    {
        if (count($this->arr) <= 0) {
            return self::with([]);
        }
        $newArr = [];
        foreach ($this->arr as $element) {
            if ($recursive && is_array($element)) {
                array_push($newArr, self::with($element)->runFilter($func, $recursive)->getArray());
            } elseif (call_user_func($func, $element) === true) {
                array_push($newArr, $element);
            }
        }
        return self::with($newArr);
    }
}