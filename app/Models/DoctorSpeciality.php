<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DoctorSpeciality
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $doctor_id
 * @property int $speciality_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSpeciality whereUpdatedAt($value)
 */
class DoctorSpeciality extends Model
{
    //
}
