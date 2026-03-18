<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService
{
    public function documentList()
    {
        $doc = Document::where('user_id', auth()->id());
        return [
            'doc_count' => $doc->count(),
            'documents' => $doc->OrderBy('id', 'desc')->paginate(5)
        ];
    }

    public function uploadDocument(array $data, $file)
    {
        $userId = auth()->id();
        $title = $data['title'];
        $extension = $file->getClientOriginalExtension();

        // 1. Generate the unique name based on title (Photo, Photo-2, etc.)
        $fileName = $this->generateUniqueFileName($userId, $title, $extension);

        // 2. Define the user-specific path: documents/{user_id}/{filename}
        $folderPath = "documents/{$userId}";
        $path = $file->storeAs($folderPath, $fileName, 'public');

        // 3. Calculate readable file size
        $sizeInMb = number_format($file->getSize() / 1048576, 2) . ' MB';

        // 4. Create record
        return Document::create([
            'user_id'   => $userId,
            'title'     => $title,
            'file_path' => $path,
            'file_type' => $extension,
            'file_size' => $sizeInMb,
            'status'    => 'verified',
        ]);
    }

    private function generateUniqueFileName($userId, $title, $extension)
    {
        $slug = Str::slug($title); // Converts "My Photo" to "my-photo"
        $originalName = "{$slug}.{$extension}";
        $folderPath = "documents/{$userId}";

        // Check if the file exists in the user's specific folder
        if (!Storage::disk('public')->exists("{$folderPath}/{$originalName}")) {
            return $originalName;
        }

        // If it exists, start incrementing
        $count = 2;
        while (Storage::disk('public')->exists("{$folderPath}/{$slug}-{$count}.{$extension}")) {
            $count++;
        }

        return "{$slug}-{$count}.{$extension}";
    }

    public function deleteDocument(Document $document)
    {
        // 1. Check if the file exists on the public disk
        if (Storage::disk('public')->exists($document->file_path)) {
            // 2. Delete the physical file
            Storage::disk('public')->delete($document->file_path);
        }

        // 3. Optional: Clean up the user's folder if it's now empty
        $userFolder = "documents/" . $document->user_id;
        if (Storage::disk('public')->exists($userFolder) && count(Storage::disk('public')->files($userFolder)) === 0) {
            Storage::disk('public')->deleteDirectory($userFolder);
        }

        // 4. Delete the database record
        return $document->delete();
    }
}
