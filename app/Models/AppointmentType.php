<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AppointmentType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int|null $status
 * @property string $appointment_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType whereAppointmentTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AppointmentType whereUpdatedAt($value)
 */
class AppointmentType extends Model
{
    //
}
