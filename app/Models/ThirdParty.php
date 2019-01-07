<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\ThirdParty
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $identification_no
 * @property string $status
 * @property int|null $removable
 * @property float|null $credit_limit
 * @property string|null $born_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereBornDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereCreditLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereIdentificationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereRemovable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereUpdatedAt($value)
 * @property string $gender
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Email[] $emails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phone[] $phones
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereGender($value)
 * @property string $blood_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DoctorSchedule[] $schedules
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DoctorSpeciality[] $specialities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ThirdPartyType[] $thirdPartyThirdPartyTypes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ThirdParty whereBloodType($value)
 */
class ThirdParty extends Model
{

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'identification_no',
        'status',
        'removable',
        'credit_limit',
        'born_date',
        'created_at',
        'updated_at'
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function specialities()
    {
        return $this->hasMany(DoctorSpeciality::class, 'doctor_id');
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function nonWorkingDays()
    {
        return $this->hasMany(DoctorNonWorkingDay::class, 'doctor_id');
    }

    public function thirdPartyThirdPartyTypes()
    {
        return $this->belongsToMany(ThirdPartyType::class, 'third_party_third_party_types');
    }

    public static function doctors()
    {
        return self::whereHas('thirdPartyThirdPartyTypes', function (Builder $query) {
            $query->where('third_party_type_id', 3);
        });
    }

    public static function patients()
    {
        return self::whereHas('thirdPartyThirdPartyTypes', function (Builder $query) {
            $query->where('third_party_type_id', 1);
        });
    }

    public static function withRelations($params)
    {
        $persons = self::with('addresses', 'emails', 'phones');

        if (isset($params['status'])) {
            $persons = $persons->where('status', '=', $params['status']);
        }

        if (isset($params['search_input']) && $params['search_input'] !== "") {

            $persons = $persons
                ->where('first_name', 'like', "%{$params['search_input']}%")
                ->orWhere('last_name', 'like', "%{$params['search_input']}%")
                ->orWhere('identification_no', 'like', "%{$params['search_input']}%");

        }

        return $persons;
    }

}
