<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Appointment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $notes
 * @property string $scheduled_date
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $customer_id
 * @property int $doctor_id
 * @property string|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereScheduledDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereUpdatedAt($value)
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\Appointment $doctor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereStatus($value)
 * @property int $appointment_type_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereAppointmentTypeId($value)
 */
class Appointment extends Model
{
    public function doctor(){
        return $this->belongsTo(Appointment::class);
    }

    public function customer(){
        return $this->belongsTo(ThirdParty::class);
    }

    public static function lastAppointment($customerId, $doctorId = null, $specialityId = null){

        $appointment = self::where('customer_id', '=', $customerId);

        if (isset($doctorId) && $doctorId !== ""){
            $appointment = $appointment->where('doctor_id', '=', $doctorId);
        }

        if (isset($specialityId) && $specialityId !== ""){
            $appointment = $appointment->whereHas('doctor', function(Builder $query) use ($specialityId){

                $doctors_list = ThirdParty::whereHas('specialities', function(Builder $query) use ($specialityId){
                    return $query->where('speciality_id', '=', $specialityId);
                })->get(['id'])->map(function($row) {
                    return $row['id'];
                });

                $query->whereIn('id', $doctors_list);

            });
        }

        $appointment = $appointment->orderBy('scheduled_date', 'desc');

        return $appointment;

    }
}
