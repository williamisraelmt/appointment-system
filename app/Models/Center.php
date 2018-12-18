<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Center
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Center whereUpdatedAt($value)
 */
class Center extends Model
{
    //
}
