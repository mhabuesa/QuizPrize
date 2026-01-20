<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\AudioFile;

class AudioController extends Controller
{
    function audio_index()
    {
        $audioFiles = AudioFile::all();
        return view('backend.audio.index', compact('audioFiles'));
    }
    public function audio_upload(Request $request)
    {
        $request->validate([
            'zip_file' => 'required|mimes:zip|max:102400',
        ]);

        // ZIP file save
        $zip = new ZipArchive;
        $zipPath = storage_path('app/temp_audio.zip');
        $request->file('zip_file')->move(storage_path('app'), 'temp_audio.zip');

        // Extract folder
        $extractPath = storage_path('app/extracted_audio');

        if (!File::exists($extractPath)) {
            File::makeDirectory($extractPath, 0777, true);
        }

        if ($zip->open($zipPath) === true) {
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            return back()->with('error', 'ZIP extract failed');
        }

        // Audio save folder
        $finalPath = public_path('uploads/audio');

        if (!File::exists($finalPath)) {
            File::makeDirectory($finalPath, 0777, true);
        }

        // Loop files
        foreach (File::allFiles($extractPath) as $file) {

            $extension = strtolower($file->getExtension());

            if (!in_array($extension, ['mp3', 'wav', 'ogg', 'm4a'])) {
                continue;
            }

            $originalName = $file->getBasename(); // ✅ REAL filename

            $destination = public_path('uploads/audio/' . $originalName);

            // duplicate skip
            if (file_exists($destination)) {
                continue;
            }

            File::move($file->getPathname(), $destination);

            AudioFile::create([
                'file_name' => $originalName,
                'file_path' => 'uploads/audio/' . $originalName,
            ]);
        }


        // Clean temp files
        File::deleteDirectory($extractPath);
        File::delete($zipPath);

        return back()->with('success', 'Bulk audio uploaded successfully');
    }

    public function list()
    {
        $audioFiles = AudioFile::latest()->get();

        return view('backend.audio.partials.table_rows', compact('audioFiles'));
    }
    public function search(Request $request)
    {
        $query = $request->get('q');

        $audioFiles = AudioFile::where('file_name', 'like', "%{$query}%")
            ->latest()
            ->get();

        return view('backend.audio.partials.table_rows', compact('audioFiles'));
    }
}
