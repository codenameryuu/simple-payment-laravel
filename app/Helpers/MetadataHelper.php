<?php

namespace App\Helpers;

class MetadataHelper
{
    /**
     ** Metadata.
     *
     * @return ArrayObject
     */
    public static function metadata()
    {
        $result = (object) [
            'title' => 'HRIS',
            'description' => '',
            'keywords' => '',
        ];

        return $result;
    }
}
