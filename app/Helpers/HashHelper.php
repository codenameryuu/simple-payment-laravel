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
        if ($id == null) {
            return 0;
        }

        $result =  Hashids::connection('main')->decode($id);

        if (empty($result)) {
            return 0;
        }

        return $result[0];
    }
}
