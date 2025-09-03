<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class S_profile extends Model
{
    use HasFactory;

    // explicit table name to match migration
    protected $table = 'sprofiles';

    protected $fillable = [
        'user_id',
        'Index_no',
        'name',
        'Faculty',
        'Department',
        'Address',
        'Blood_Group',
        'Medical_Condition',
        'Telephone',
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
