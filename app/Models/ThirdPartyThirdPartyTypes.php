<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ThirdPartyThirdPartyTypes
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $third_party_id
 * @property int $third_party_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes whereThirdPartyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes whereThirdPartyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyThirdPartyTypes whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\ThirdParty $thirdParty
 * @property-read \App\Models\ThirdPartyType $thirdPartyType
 */
class ThirdPartyThirdPartyTypes extends Model
{
    public function thirdParty(){
        return $this->belongsTo(ThirdParty::class);
    }

    public function thirdPartyType(){
        return $this->belongsTo(ThirdPartyType::class);
    }
}
