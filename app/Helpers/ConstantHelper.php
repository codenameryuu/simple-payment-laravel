<?php

namespace App\Helpers;

class ConstantHelper
{
    /**
     ** Transaction status.
     *
     * @return Array
     */
    public static function transactionStatus()
    {
        $result = [
            'Pending',
            'Completed',
            'Failed'
        ];

        return $result;
    }
}
