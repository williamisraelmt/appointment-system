<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Doctor
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $born_date
 * @property string $gender
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereBornDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Doctor whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DoctorNonWorkingDay[] $nonWorkingDays
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DoctorSchedule[] $schedules
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DoctorSpeciality[] $specialities
 */
class Doctor extends Model
{
    public function specialities(){
        return $this->hasMany(DoctorSpeciality::class);
    }

    public function schedules(){
        return $this->hasMany(DoctorSchedule::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function nonWorkingDays(){
        return $this->hasMany(DoctorNonWorkingDay::class);
    }
}
