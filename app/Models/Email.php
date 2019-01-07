<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Email
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $address
 * @property int|null $status
 * @property int $third_party_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereThirdPartyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Email whereUpdatedAt($value)
 * @property-read \App\Models\ThirdParty $thirdParty
 */
class Email extends Model
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
