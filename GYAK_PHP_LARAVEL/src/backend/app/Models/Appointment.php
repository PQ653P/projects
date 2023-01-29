<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Traits\ApiResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Appointment
 * @package App\Models
 *
 * @property timestamp begin_time
 * @property timestamp end_time
 * @property text note
 */

class Appointment extends Model
{
    use HasFactory, ApiResource, UUID;

     protected $fillable = ['begin_time', 'end_time', 'note'];

     public function user():BelongsTo{
         return $this->belongsTo(User::class);
     }
    public function service():BelongsTo{
        return $this->belongsTo(Service::class);
    }
}
