<?php

namespace App\Models;

use App\Traits\ApiResource;
use App\Traits\HasImages;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Service
 * @package App\Models
 *
 * @property string name
 * @property string description
 * @property array extra
 * @property int duration
 */
class Service extends Model
{
    use HasFactory, ApiResource, UUID, HasImages;

    protected $fillable = ['name', 'description', 'duration'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function appointments(): HasMany{
        return $this->hasMany(Appointment::class);
    }
}
