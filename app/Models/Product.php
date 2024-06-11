<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

use EloquentFilter\Filterable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

use App\Helpers\HashHelper;

use App\ModelFilters\ProductFilter;

use App\Traits\PaginateData;

class Product extends Model implements HasMedia
{
    use Filterable, InteractsWithMedia, HasFactory, PaginateData, SoftDeletes;

    /*
    |-----------------------------------------------------------------------------
    | DECORATOR(s)
    |-----------------------------------------------------------------------------
    | // ! write your decorator(s) below, to maintain code readability
    */

    /**
     ** The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     ** The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'hash_id',
        'image',
    ];

    /**
     ** The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'productCategory',
    ];

    /*
    |-----------------------------------------------------------------------------
    | HOOK METHOD(s)
    |-----------------------------------------------------------------------------
    | // ! write your hook method(s) below, to maintain code readability
    */

    /**
     ** Model filter.
     *
     * @return ModelFilter
     */
    public function modelFilter()
    {
        return $this->provideFilter(ProductFilter::class);
    }

    /**
     ** Get the hash id.
     *
     * @return string
     */
    public function getHashIdAttribute()
    {
        return HashHelper::encrypt($this->id);
    }

    /**
     ** Get attachment file.
     *
     * @return string|null
     */
    public function getImageAttribute()
    {
        $result = null;
        $media = $this->getFirstMedia('produk');

        if ($media) {
            $result =  $media->getUrl();
        }

        return $result;
    }

    /*
    |-----------------------------------------------------------------------------
    | STATIC METHOD(s)
    | ----------------------------------------------------------------------------
    | // ! write your static method(s) below, to maintain code readability
    */

    /**
     ** Save image.
     *
     * @param $id
     * @param $file
     * @return void
     */
    public static function saveImage($id, $file)
    {
        $timestamp = Carbon::now()->isoFormat('YYYYMMDDHHmmss');
        $uniqueSuffix = uniqid();
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = "{$timestamp}{$uniqueSuffix}.{$fileExtension}";

        Product::firstWhere('id', $id)
            ->addMediaFromRequest('image')
            ->usingFileName($newFileName)
            ->toMediaCollection('produk', 's3');
    }

    /**
     ** Delete profile file.
     * 
     * @param $id
     * @return void
     */
    public static function deleteImage($id)
    {
        Product::firstWhere('id', $id)
            ->clearMediaCollection('produk');
    }

    /*
    |-----------------------------------------------------------------------------
    | SCOPED METHOD(s)
    | ----------------------------------------------------------------------------
    | // ! write your static method(s) below, to maintain code readability
    */

    /**
     ** Scope a query to search
     * 
     * @param QueryBuilder $query
     * @param $search
     * @return QueryBuilder
     */
    public function scopeSearch(QueryBuilder $query, $search)
    {
        if ($search) {
            return $query->where(function (QueryBuilder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereRaw('CAST(price AS CHAR) LIKE ?', "%{$search}%");
            });
        }
    }

    /*
    |-----------------------------------------------------------------------------
    | RELATIONAL METHOD(s)
    |-----------------------------------------------------------------------------
    | // ! write your relational method(s) below, to maintain code readability
    */

    /**
     ** Relationship with product category.
     *
     * @return relationship
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id')
            ->withTrashed();
    }

    /**
     ** Relationship with user.
     *
     * @return relationship
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id')
            ->withTrashed();
    }
}
