<?php

namespace App\Http\Controllers;

use App\Models\AudioFile;
use App\Models\WinnerRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function shuffle(Request $request)
    {
        Log::info($request->device_id);
        // 1️⃣ Already claimed?
        if (WinnerRecord::where('device_id', $request->device_id)->exists()) {
            $record = WinnerRecord::where('device_id', $request->device_id)->first();

            return response()->json([
                'status' => 'locked',
                'link' => $record->file_path,
                'name' => $record->file_name
            ]);
        }

        // 2️⃣ Audio links pool (static / config)
        $links = AudioFile::pluck('file_path')->toArray();

        $randomLink = $links[array_rand($links)];

        $name = AudioFile::where('file_path', $randomLink)->first()->file_name;

        WinnerRecord::create([
            'device_id' => $request->device_id,
            'file_name' => $name,
            'file_path' => $randomLink,
        ]);

        // 4️⃣ Return response with cookie (1 year)
        return response()->json([
            'status' => 'success',
            'link' => $randomLink,
            'name' => $name
        ]);
    }
}
