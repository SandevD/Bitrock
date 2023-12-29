<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class WhyusController extends Controller
{
    public function index(){

        $whyus = Content::where('type', 'whyus')?->first();
        return view('dashboard.whyus', compact('whyus'));
    }
    public function update(Request $req){
        $req->validate([
            'section_one'=> 'required',
            'section_two'=> 'required',
            'section_three'=> 'required',
            'section_four'=> 'required',
            'description'=> 'required'
        ]);

        $whyus = Content::where('type', 'whyus')?->first();
        
        if ($whyus == null) {
            $whyus = new Content();
        }

        $data = array(
            'section_one' => $req->section_one,
            'section_two' => $req->section_two,
            'section_three' => $req->section_three,
            'section_four' => $req->section_four,
            'description' => $req->description,
        );

        $whyus->value = $data;

        try {
            $whyus->save();
        } catch (Exception $validated){
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Why Us Section Updated'];
        return back()->withNotify($notify);

    }
}
