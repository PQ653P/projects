<?php

namespace App\Models;

use App\Traits\ApiKey;
use App\Traits\ApiResource;
use App\Traits\HasImages;
use App\Traits\UUID;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;
//use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * @property string name
 * @property string email
 * @property string password
 * @property string extra
 * @property bool troll
 * @property string remember_token
 * @property string api_key
 * @property DateTime email_verified_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, ApiResource, UUID, HasRolesAndAbilities, ApiKey, HasApiTokens, HasImages;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_key'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['data'];

    public function appointments(): HasMany{
        return $this->hasMany(Appointment::class);
    }

    public function getDataAttribute(){
        return json_decode($this->extra, true);
    }

    public function setDataAttribute($value){
        $this->extra = json_encode($value, JSON_FORCE_OBJECT);
    }

    public function setExtra(string $key, mixed $value): static
    {
        $data = $this->getDataAttribute();
        $data[$key] = $value;
        $this->setDataAttribute($data);
        return $this;
    }

    public static function Servers(): Builder
    {
        return User::where('extra->server', true);
    }

    public function posts(): HasMany{
        return $this->hasMany(Post::class);
    }

    public function services(): HasMany{
        return $this->hasMany(Service::class);
    }

    public function isServer(){
        $data = $this->getDataAttribute();
        if (array_search('server', array_keys($data)) === false) return false;
        return $this->getDataAttribute()['server'];
    }
}
