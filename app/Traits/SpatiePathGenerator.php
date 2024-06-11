<?php

namespace App\Traits;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SpatiePathGenerator implements BasePathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        $result = $media->collection_name . '/' . md5($media->id . config('app.key')) . '/';

        return $result;
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        $result = $media->collection_name . '/' . md5($media->id . config('app.key')) . '/conversions/';

        return $result;
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        $result = $media->collection_name . '/' . md5($media->id . config('app.key')) . '/responsives/';

        return $result;
    }
}
