<?php

namespace App\Models;

use App\Traits\HasImages;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Post
 * @package App\Models
 * @property string title
 * @property string content
 */
class Post extends Model
{
    use HasFactory, ApiResource, UUID, HasImages;

    protected $fillable = [
        'title', 'content'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
