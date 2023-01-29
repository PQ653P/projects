<?php


namespace App\Traits;


use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property Collection images
 * @method MorphToMany morphToMany(string $class, string $string)
 */
trait HasImages
{
    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
