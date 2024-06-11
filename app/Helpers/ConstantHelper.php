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
            'Success',
            'Failed'
        ];

        return $result;
    }
}
