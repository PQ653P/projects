<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiResource;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Image
 * @package App\Models
 *
 * @property string src
 */

class Image extends Model
{
    use HasFactory, ApiResource, UUID;
    protected $fillable = ['src'];

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'imageable');
    }
}
