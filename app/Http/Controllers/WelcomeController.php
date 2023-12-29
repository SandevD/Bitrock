<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WelcomeController extends Controller
{
    public function index()
    {
        $contents = collect(Content::all());
        $documents = Document::latest()->take(5)->where('status', 1)->get();

        $currentDateTime = Carbon::now();

        $targetDateTime = Carbon::create(2023, 8, 27, 12, 0, 0);

        if ($currentDateTime->isBefore($targetDateTime)) {
            $countdown = 1;
        } else {
            $countdown = 0;
        }

        return view('welcome', compact('contents', 'documents', 'countdown'));
    }

    public function test()
    {
        return view('test');
    }
}
