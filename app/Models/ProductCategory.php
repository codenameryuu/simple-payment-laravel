<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use EloquentFilter\Filterable;

use App\Helpers\HashHelper;

use App\ModelFilters\ProductCategoryFilter;

use App\Traits\PaginateData;

class ProductCategory extends Model
{
    use Filterable, HasFactory, PaginateData, SoftDeletes;

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
    ];

    /**
     ** The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [];

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
        return $this->provideFilter(ProductCategoryFilter::class);
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

    /*
    |-----------------------------------------------------------------------------
    | STATIC METHOD(s)
    | ----------------------------------------------------------------------------
    | // ! write your static method(s) below, to maintain code readability
    */

    /*
    |-----------------------------------------------------------------------------
    | SCOPED METHOD(s)
    | ----------------------------------------------------------------------------
    | // ! write your static method(s) below, to maintain code readability
    */

    /**
     ** Scope a query to load relationship
     * 
     * @param QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeLoadRelationship(QueryBuilder $query)
    {
        return $query->with([
            'product',
        ]);
    }

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
                    ->orWhere('description', 'like', '%' . $search . '%');
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
     ** Relationship with product.
     *
     * @return relationship
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'product_category_id', 'id');
    }
}
