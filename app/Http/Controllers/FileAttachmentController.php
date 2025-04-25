<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileAttachment;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

class FileAttachmentController extends Controller
{
    public function index()
    {
        $attachments = FileAttachment::with('material.subject')->get();
        $materials = Material::with('subject')->get();
        return view('admin.file_attachments.index', compact('attachments','materials'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'file' => 'required|file|max:2048|mimes:pdf,doc,docx,zip,jpg,jpeg,png',
        ]);
    
        $material = Material::with('subject')->findOrFail($request->material_id);
        $file = $request->file('file');
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filePath = 'materials/' . $material->subject->subject_name . '/' . $material->title . '_' . $material->id . '/' . $file->getClientOriginalName();
    
        // Check if file already exists
        $counter = 1;
        while (Storage::disk('public')->exists($filePath)) {
            $fileName = $originalFileName . '(' . $counter . ').' . $extension;
            $filePath = 'materials/' . $material->subject->subject_name . '/' . $material->title . '_' . $material->id . '/' . $fileName;
            $counter++;
        }
    
        // Store the file
        Storage::disk('public')->put($filePath, file_get_contents($file));
    
        // Save the file attachment record
        FileAttachment::create([
            'material_id' => $request->material_id,
            'file_name' => basename($filePath),
            'file_path' => $filePath,
        ]);
        return redirect()->back()->with('success', 'File attachment added successfully.');
    }
    

    public function edit($id)
    {
        $attachment = FileAttachment::findOrFail($id);
        $materials = Material::with('subject')->get();
        return view('admin.file_attachments.edit', compact('attachment', 'materials'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'file' => 'nullable|file|max:2048',
        ]);

        $attachment = FileAttachment::findOrFail($id);
        $material = Material::with('subject')->findOrFail($request->material_id);

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($attachment->file_path);

            // Store new file
            $file = $request->file('file');
            $filePath = 'materials/' . $material->subject->subject_name . '/' . $material->title . '_' . $material->id . '/' . $file->getClientOriginalName();
            Storage::disk('public')->put($filePath, file_get_contents($file));



            $attachment->update([
                'material_id' => $request->material_id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
            ]);
        } else {
            $attachment->update([
                'material_id' => $request->material_id,
            ]);
        }

        return redirect()->back()->with('success', 'File attachment edited successfully.');
    }

    public function destroy($id)
    {
        $attachment = FileAttachment::findOrFail($id);

        // Delete file from storage
        Storage::disk('public')->delete($attachment->file_path);

        $attachment->delete();

        return redirect()->back()->with('success', 'File attachment deleted successfully.');
    }


}
