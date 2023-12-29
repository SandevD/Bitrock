<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(){
        $footer = Content::where('type', 'footer')?->first();
        return view('dashboard.footer', compact('footer'));
    }
    public function update(Request $req){
        $req->validate([
            'section_one'=> 'required',
            'section_two'=> 'required'
        ]);

        $footer = Content::where('type', 'footer')?->first();
        
        if ($footer == null) {
            $footer = new Content();
        }

        $data = array(
            'section_one' => $req->section_one,
            'section_two' => $req->section_two
        );

        $footer->value = $data;
        


        try {
            $footer->save();
        } catch (Exception $validated){
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Footer Updated'];
        return back()->withNotify($notify);

    }
}
