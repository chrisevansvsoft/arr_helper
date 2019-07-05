<?php

use ArrHelper\Arr;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
    private function runFilterTests($tests)
    {
        foreach ($tests as $test) {
            list($input, $expectedOutput, $func) = $test;
            $output = Arr::with($input)->filter($func)->getArray();
            $this->assertEquals($expectedOutput, $output);
        }
    }

    public final function testFilterWithRealFunction()
    {
        $func = function ($value) {
            return $value % 2 == 0;
        };

        /**
         * input
         * expected
         * func
         */
        $tests = [
            [
                [1, 2, 3, 4, 5],
                [2, 4],
                $func,
            ],
            [
                [1, 3, 5],
                [],
                $func,
            ],
            [
                [1, [1, 2], 2],
                [2],
                $func,
            ]
        ];

        $this->runFilterTests($tests);
    }

//
//
//
//    private function runFilterTest($in, $expected, $func)
//    {
//        $output = Arr::with($in)->filter($func)->getArray();
//        $this->assertEquals($expected, $output);
//    }
//
//    private function runFilterRecursiveTest($in, $expected, $func)
//    {
//        $output = Arr::with($in)->filter($func)->getArray();
//        $this->assertEquals($expected, $output);
//    }
//
//    public final function testFilterWithRealFunction()
//    {
//        $func = function ($value) {
//            return $value % 2 == 0;
//        };
//        $this->runFilterTest(
//            [1, 2, 3, 4, 5],
//            [2, 4],
//            $func
//        );
//        $this->runFilterTest(
//            [1, 3, 5],
//            [],
//            $func
//        );
//        $this->runFilterTest(
//            [1, [1, 2], 2],
//            [2],
//            $func
//        );
//        $this->runFilterTest(
//            [],
//            [],
//            $func
//        );
//    }
}