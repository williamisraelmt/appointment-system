<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ThirdPartyType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType whereUpdatedAt($value)
 * @property string $name
 * @property int|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdPartyType whereStatus($value)
 */
class ThirdPartyType extends Model
{
    public static function withRelations(array $params = []){

        $third_party_types = new ThirdPartyType;

        if (isset($params['status'])){
            $third_party_types = $third_party_types->where('status', '=', $third_party_types['status']);
        }

        if (isset($params['search_input']) && $params['search_input'] !== ""){
            $third_party_types = $third_party_types->where('name', 'like', "%{$params['search_input']}%");
        }

        return $third_party_types;

    }
}
