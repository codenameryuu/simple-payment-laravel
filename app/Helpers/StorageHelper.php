<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     ** Get url.
     *
     * @param $file
     * @param $additionalPath
     * @return String
     */
    public static function getUrl($file, $additionalPath = null)
    {
        if ($additionalPath) {
            $result = Storage::disk('s3')->url($additionalPath . '/' . $file);
        } else {
            $result = Storage::disk('s3')->url($file);
        }

        return $result;
    }

    /**
     ** Upload.
     *
     * @param $file
     * @param $additionalPath
     * @return String
     */
    public static function upload($file, $additionalPath = null)
    {
        $timestamp = Carbon::now()->isoFormat('YYYYMMDDHHmmss');
        $uniqueSuffix = uniqid();
        $fileExtension = $file->getClientOriginalExtension();
        $filename = "{$timestamp}{$uniqueSuffix}.{$fileExtension}";

        if (!$additionalPath) {
            $additionalPath = '';
        }

        Storage::disk('s3')->putFileAs($additionalPath, $file, $filename);

        return $filename;
    }

    /**
     ** Delete.
     *
     * @param $file
     * @param $additionalPath
     * @return String
     */
    public static function delete($file, $additionalPath = null)
    {
        $pathFile = '';

        if ($additionalPath) {
            $pathFile = $pathFile . '/' . $additionalPath;
        }

        $pathFile = $pathFile . '/' . $file;
        $statusPath = Storage::disk('s3')->exists($pathFile);

        if ($statusPath) {
            Storage::disk('s3')->delete($pathFile);
        }
    }
}
