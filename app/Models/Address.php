<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Address
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $address
 * @property int|null $status
 * @property int $third_party_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereThirdPartyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUpdatedAt($value)
 * @property-read \App\Models\ThirdParty $thirdParty
 */
class Address extends Model
{
    protected $fillable = [
        'id',
        'address',
        'status',
        'third_party_id',
        'city_id'
    ];

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }
}
