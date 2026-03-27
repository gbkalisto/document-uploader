<?php

namespace App\Services;

use ZipStream\ZipStream;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ZipDownloadService
{
    public function downloadAllDocuments()
    {
        if (ob_get_level()) {
            ob_end_clean();
        }

        $zip = new ZipStream(
            outputName: 'all-documents.zip',
            sendHttpHeaders: true
        );

        $folders = Storage::disk('public')->directories('documents');

        foreach ($folders as $folder) {

            // Extract user ID from "documents/2"
            $userId = basename($folder);

            // Get user
            $user = User::find($userId);

            // Fallback if user not found
            $userName = $user ? $this->sanitize($user->name) : 'unknown';

            // New folder name
            $newFolderName = "documents/{$userId}-{$userName}";

            $files = Storage::disk('public')->allFiles($folder);

            foreach ($files as $file) {

                $stream = Storage::disk('public')->readStream($file);

                if ($stream) {

                    // Get file name only
                    $fileName = basename($file);

                    // Final path inside ZIP
                    $zipPath = $newFolderName . '/' . $fileName;

                    $zip->addFileFromStream(
                        fileName: $zipPath,
                        stream: $stream
                    );

                    fclose($stream);
                }
            }
        }

        $zip->finish();
        exit;
    }

    // Clean username for folder usage
    private function sanitize($name)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', strtolower($name));
    }
}
