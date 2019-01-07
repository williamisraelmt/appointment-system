<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DoctorSchedule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $start_time
 * @property string $end_time
 * @property int $day_of_week
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $doctor_id
 * @property int $room_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereUpdatedAt($value)
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Room $room
 * @property string|null $max_patients
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DoctorSchedule whereMaxPatients($value)
 */
class DoctorSchedule extends Model
{
    public function doctor(){
        return $this->belongsTo(ThirdParty::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

}
