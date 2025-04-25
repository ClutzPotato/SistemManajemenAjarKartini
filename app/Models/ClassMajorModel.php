<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMajorModel extends Model
{
    use HasFactory;

    protected $table = 'class_major';

    protected $fillable = [
        'class_major_name',
    ];
    
    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'class_major', 'class_major_name');
    }
}
