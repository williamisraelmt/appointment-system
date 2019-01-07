<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Phone
 *
 * @property int $id
 * @property string $number
 * @property int $status
 * @property int $third_party_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ThirdParty $thirdParty
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone whereThirdPartyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Phone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Phone extends Model
{
    protected $fillable = [
        'id',
        'number',
        'status',
        'third_party_id',
        'city_id'
    ];

    public function thirdParty()
    {
        return $this->belongsTo(ThirdParty::class);
    }
}
