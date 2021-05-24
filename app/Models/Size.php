<?php

namespace App\Models;

use Database\Factories\SizeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Size
 *
 * @property int $id
 * @property string $name
 * @method static SizeFactory factory(...$parameters)
 * @method static Builder|Size newModelQuery()
 * @method static Builder|Size newQuery()
 * @method static Builder|Size query()
 * @method static Builder|Size whereId($value)
 * @method static Builder|Size whereName($value)
 * @mixin Eloquent
 */
class Size extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

}
