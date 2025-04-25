<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';
 
    protected $fillable = [
        'class_name',
        'class_major',
        'class_capacity',
    ];

    public function classMajor()
    {
        return $this->belongsTo(ClassMajorModel::class, 'class_major', 'class_major_name');
    }

    public function subjects()
    {
        return $this->belongsToMany(SubjectModel::class, 'class_subject', 'class_id', 'subject_id');
    }
}
