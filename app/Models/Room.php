<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hostel_name',
        'room_number',
        'number_of_beds',
        'locker_number',
        'user_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
