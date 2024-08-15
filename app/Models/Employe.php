<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'department_id',
        'fullname',
        'slug',
        'hp',
        'cv',
        'address',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
