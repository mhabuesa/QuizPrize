<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudioFile;
use App\Models\WinnerRecord;

class QuizController extends Controller
{
    public function shuffle(Request $request)
    {
        // 1️⃣ Already claimed?
        if ($request->hasCookie('quiz_reward')) {
            $data = json_decode($request->cookie('quiz_reward'), true);

            return response()->json([
                'status' => 'locked',
                'link' => $data['link'],
                'name' => $data['name']
            ]);
        } elseif (WinnerRecord::where('device_id', $request->device_id)->exists()) {
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

        // 3️⃣ Cookie data
        $cookieData = json_encode([
            'link' => $randomLink,
            'name' => $name,
            'claimed_at' => time()
        ]);

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
        ])->withCookie(
            cookie('quiz_reward', $cookieData, 60 * 24 * 365) // minutes
        );
    }
}
