<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function sendEmail(Request $req){

        $validated = $req->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'phone'=> 'required|min:10|max:10',
            'address'=> 'required|max:100',
            'subject'=> 'required|max:50',
            'message'=> 'required|max:250'
        ]);

        $data=[
            'name'=>$req->name,
            'email'=>$req->email,
            'phone'=>$req->phone,
            'address'=>$req->address,
            'subject'=>$req->subject,
            'message'=>$req->message
        ];

        try {
            Mail::to('thisisbitrock@outlook.com')->send(new ContactMail($data));
        } catch (Exception $validated){
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Thank You For Reaching Out'];
        return back()->withNotify($notify);
    }
}
