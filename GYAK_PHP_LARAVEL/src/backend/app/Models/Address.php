<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiResource;

/**
 * Class AddressController
 * @package App\Models
 * @property string phone
 * @property string email
 * @property string country
 * @property string city
 * @property string postcode
 * @property string street
 */

class Address extends Model
{
    use HasFactory, ApiResource, UUID;

    protected $fillable = ['phone','email','country','city','postcode','street'];

}
