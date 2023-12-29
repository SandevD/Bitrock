<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $contactus = Content::where('type', 'contactus')?->first();
        return view('dashboard.contactus', compact('contactus'));
    }

    public function update(Request $req){
        $req->validate([
            'contact'=> 'required|min:10',
            'address'=> 'required'
        ]);

        $contactus = Content::where('type', 'contactus')?->first();
        
        if ($contactus == null) {
            $contactus = new Content();
        }

        $data = array(
            'contact' => $req->contact,
            'address' => $req->address
        );

        $contactus->value = $data;
        $contactus->save();

        try {
            $contactus->save();
        } catch (Exception $validated){
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Contact Details Updated'];
        return back()->withNotify($notify);
    }
}
