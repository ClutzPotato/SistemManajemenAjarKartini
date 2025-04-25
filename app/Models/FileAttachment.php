<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileAttachment extends Model
{
    use HasFactory;
    protected $primaryKey = 'attachment_id';
    protected $fillable = [
        'material_id',
        'file_name',
        'file_path',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id','id');
    }
}
