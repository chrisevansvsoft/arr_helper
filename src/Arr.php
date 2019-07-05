<?php

namespace ArrHelper;

use ArrHelper\Functions\Filter;
use ArrHelper\Functions\Map;

class Arr
{
    use Map;
    use Filter;

    /**
     * @var array
     */
    private $arr;

    /**
     * Arr constructor.
     * @param  array  $arr
     */
    private function __construct($arr)
    {
        $this->arr = $arr;
    }

    /**
     * @param  array  $arr
     * @return Arr
     */
    public static function with($arr)
    {
        return new self($arr);
    }

    /**
     * Return the array
     * @return array
     */
    public function getArray()
    {
        return $this->arr;
    }
}