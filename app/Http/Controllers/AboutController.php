<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $aboutus = Content::where('type', 'about')?->first();
        return view('dashboard.about', compact('aboutus'));
    }

    public function update(Request $req){
        $req->validate([
            'section_one'=> 'required',
            'section_two'=> 'required',
            'section_three'=> 'required',
            'section_four'=> 'required',
            'description'=> 'required'
        ]);

        $aboutus = Content::where('type', 'about')?->first();
        
        if ($aboutus == null) {
            $aboutus = new Content();
        }

        $data = array(
            'section_one' => $req->section_one,
            'section_two' => $req->section_two,
            'section_three' => $req->section_three,
            'section_four' => $req->section_four,
            'description' => $req->description,
        );

        $aboutus->value = $data;
        $aboutus->save();

        try {
            $aboutus->save();
        } catch (Exception $validated){
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'About Us Section Updated'];
        return back()->withNotify($notify);
    }
}
