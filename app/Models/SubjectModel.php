<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubjectModel extends Model
{
    use HasFactory;
    protected $table = 'subject';

    protected $fillable = [
        'subject_name',
        'subject_description',
    ];
    
    public function materials()
    {
        return $this->hasMany(Material::class);
    }

public function classes()
{
    return $this->belongsToMany(ClassModel::class, 'class_subject', 'subject_id', 'class_id');
}
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($subject) {
            // Create a folder for the subject in the materials directory if it doesn't exist
            $folderPath = 'materials/' . $subject->subject_name;
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
        });
    
        static::deleting(function ($subject) {
            // Delete the folder associated with the subject if it exists
            $folderPath = 'materials/' . $subject->subject_name;
            if (Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->deleteDirectory($folderPath);
            }
        });
    
        static::updating(function ($subject) {
            // Get the old subject name
            $oldSubjectName = $subject->getOriginal('subject_name');
            
            // Get the new subject name
            $newSubjectName = $subject->subject_name;
    
            // Update the folder name if subject name has changed
            if ($oldSubjectName !== $newSubjectName) {
                // Check if the old folder exists before renaming
                $oldFolderPath = 'materials/' . $oldSubjectName;
                if (Storage::disk('public')->exists($oldFolderPath)) {
                    // Rename the folder
                    Storage::disk('public')->move($oldFolderPath, 'materials/' . $newSubjectName);
                }
            }
        });
    }
}