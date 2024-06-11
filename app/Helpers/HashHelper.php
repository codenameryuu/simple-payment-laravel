<?php

namespace App\Helpers;

use Vinkla\Hashids\Facades\Hashids;

class HashHelper
{
    /**
     ** Encrypt ID.
     *
     * @param $id
     * @return String
     */
    public static function encrypt($id)
    {
        return Hashids::connection('main')->encode($id);
    }

    /**
     ** Decrypt ID.
     *
     * @param $id
     * @return String
     */
    public static function decrypt($id)
    {
        return Hashids::connection('main')->decode($id)[0];
    }
}
