<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class S_profile extends Model
{
       use HasFactory;

    protected $table = 'sprofiles'; // 👈 force Laravel to use this table

    protected $fillable = [
        'user_id',
        'Index_no',
        'Faculty',
        'Department',
        'Address',
        'Blood_Group',
        'Medical_Condition',
        'Telephone',
    ];
}
