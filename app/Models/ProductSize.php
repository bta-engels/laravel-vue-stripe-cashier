<?php
namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\ProductSize
 *
 * @property int $product_id
 * @property int $size_id
 * @property-read Product $product
 * @property-read Size $size
 * @method static Builder|ProductSize newModelQuery()
 * @method static Builder|ProductSize newQuery()
 * @method static Builder|ProductSize query()
 * @method static Builder|ProductSize whereProductId($value)
 * @method static Builder|ProductSize whereSizeId($value)
 * @mixin Eloquent
 */
class ProductSize extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $with = ['size'];
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
