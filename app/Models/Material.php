<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Material extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'subject_id',
        'title',
        'type',
        'description',
    ];

    // Define the relationship with the Subject model
    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id', 'id');
    }

    public function materials()
    {
        return $this->hasMany(FileAttachment::class);
    }
    
    public function assignmentSubmissions()
{
    return $this->hasMany(AssignmentSubmission::class);
}

    protected static function boot()
    {
        parent::boot();

        $originalValues = [];

        static::created(function ($material) {
            $folderPath = 'materials/' . $material->subject->subject_name . '/' . $material->title . '_' . $material->id;
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
        });

        static::updating(function ($material) use (&$originalValues) {
            // Store the original subject ID and material ID in the local scope
            $originalValues[$material->id] = [
                'subject_id' => $material->getOriginal('subject_id'),
                'id' => $material->getOriginal('id'),
                'title' => $material->getOriginal('title'),
            ];
        });

        static::updated(function ($material) use (&$originalValues) {
            // Retrieve the original subject ID, material ID, and title
            $original = $originalValues[$material->id];
            $oldSubject = SubjectModel::find($original['subject_id']);
            $oldFolderPath = 'materials/' . $oldSubject->subject_name . '/' . $original['title'] . '_' . $original['id'];
            $newFolderPath = 'materials/' . $material->subject->subject_name . '/' . $material->title . '_' . $material->id;

            // If the folder path has changed, rename the folder
            if ($oldFolderPath !== $newFolderPath) {
                if (Storage::disk('public')->exists($oldFolderPath)) {
                    Storage::disk('public')->move($oldFolderPath, $newFolderPath);
                } else {
                    Storage::disk('public')->makeDirectory($newFolderPath);
                }
            }

            // Clean up the original values array
            unset($originalValues[$material->id]);
        });

        static::deleting(function ($material) {
            $folderPath = 'materials/' . $material->subject->subject_name . '/' . $material->title . '_' . $material->id;
            if (Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->deleteDirectory($folderPath);
            }
        });
    }
}
