<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DoctorNonWorkingDay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $non_working_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $doctor_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay whereNonWorkingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorNonWorkingDay whereUpdatedAt($value)
 */
class DoctorNonWorkingDay extends Model
{
    //
}
