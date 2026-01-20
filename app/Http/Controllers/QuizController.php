<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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
                'link' => $data['link']
            ]);
        }elseif (WinnerRecord::where('ip_address', $request->ip())->exists()) {
            $record = WinnerRecord::where('ip_address', $request->ip())->first();

            return response()->json([
                'status' => 'locked',
                'link' => $record->file_path
            ]);
        }

        // 2️⃣ Audio links pool (static / config)
        $links = AudioFile::pluck('file_path')->toArray();

        $randomLink = $links[array_rand($links)];

        // 3️⃣ Cookie data
        $cookieData = json_encode([
            'link' => $randomLink,
            'claimed_at' => time()
        ]);

        WinnerRecord::create([
            'ip_address' => $request->ip(),
            'file_path' => $randomLink,
        ]);

        // 4️⃣ Return response with cookie (1 year)
        return response()->json([
            'status' => 'success',
            'link' => $randomLink
        ])->withCookie(
            cookie('quiz_reward', $cookieData, 60 * 24 * 365) // minutes
        );
    }


}
