<?php

namespace App\Http\Controllers;

use App\Models\WinnerRecord;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function dashboard()
    {
        $winners = WinnerRecord::latest()->get();
        return view('backend.index', compact('winners'));
    }
}
