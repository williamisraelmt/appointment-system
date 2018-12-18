<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Customer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $born_date
 * @property string $identification_no
 * @property string $blood_type
 * @property string $gender
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereBloodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereBornDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereIdentificationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 */
class Customer extends Model
{
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
