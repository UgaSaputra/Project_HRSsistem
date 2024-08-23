<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_record extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_number',
        'offense_type',
        'offense_date',
        'description'
    ];

    public function familyData()
    {
        return $this->hasOne(FamilyData::class, 'id_number', 'id_number');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_number', 'id_number');
    }
}
