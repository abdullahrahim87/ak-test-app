<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 1/19/19
 * Time: 2:58 PM
 */

namespace App\Euler;


class Problem1
{
    static function calculate($limit){
        $sum = 0;

        for ($i = 1; $i < $limit; $i++) {
            if ($i % 3 == 0 || $i % 5 == 0) {
                $sum += $i;
            }
        }

        return $sum;
    }
}