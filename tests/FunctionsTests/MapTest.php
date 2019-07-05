<?php

use ArrHelper\Arr;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    private function runMapTest($in, $expected, $func)
    {
        $output = Arr::with($in)->map($func)->getArray();
        $this->assertEquals($expected, $output);
    }

    private function runMapRecursiveTest($in, $expected, $func)
    {
        $output = Arr::with($in)->mapRecursive($func)->getArray();
        $this->assertEquals($expected, $output);
    }

    public function testMapWithRealFunction()
    {
        $this->runMapTest(
            [1, 2, 3, 4, 5],
            [2, 4, 6, 8, 10],
            function ($value) {
                return $value * 2;
            }
        );
        $this->runMapTest(
            ["one", "two"],
            ["eno", "owt"],
            function ($value) {
                return strrev($value);
            }
        );
        $this->runMapTest(
            [],
            [],
            function ($value) {
                return $value * 2;
            }
        );
    }

    public function testMapWithStringFunction()
    {
        $this->runMapTest(
            [4, 9, 16],
            [2, 3, 4],
            'sqrt'
        );
        $this->runMapTest(
            ["one", "two"],
            ["eno", "owt"],
            'strrev'
        );
    }

    public function testRecursiveMapWithRealFunction()
    {
        $this->runMapRecursiveTest(
            [1, [2, 3, 4], 5, [6]],
            [2, [4, 6, 8], 10, [12]],
            function ($value) {
                return $value * 2;
            }
        );
        $this->runMapRecursiveTest(
            [["one", "two"], "three", ["four"]],
            [["eno", "owt"], "eerht", ["ruof"]],
            function ($value) {
                return strrev($value);
            }
        );
        $this->runMapRecursiveTest(
            [[], [], [[], []], []],
            [[], [], [[], []], []],
            function ($value) {
                return $value * 2;
            }
        );
    }

    public function testRecursiveMapWithStringFunction()
    {
        $this->runMapRecursiveTest(
            [4, [9, 16], [25]],
            [2, [3, 4], [5]],
            'sqrt'
        );
        $this->runMapRecursiveTest(
            [["one", "two"], "three", ["four"]],
            [["eno", "owt"], "eerht", ["ruof"]],
            'strrev'
        );
    }
}