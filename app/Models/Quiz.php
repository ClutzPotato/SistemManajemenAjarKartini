<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'title',
        'quiz_data',
    ];

    protected $casts = [
        'quiz_data' => 'array',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class);
    }
}
