<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        $portfolio = Content::where('type', 'portfolio')?->first();
        return view('dashboard.portfolio', compact('portfolio'));
    }
    public function update(Request $req){
        $req->validate([
            'title1'=> 'required',
            'title2'=> 'required',
            'title3'=> 'required',
            'title4'=> 'required',
            'description1'=> 'required',
            'description2'=> 'required',
            'description3'=> 'required',
            'description4'=> 'required',
        ]);

        $portfolio = Content::where('type', 'portfolio')?->first();
        
        if ($portfolio == null) {
            $portfolio = new Content();
        }

        $data = array(
            'title1' => $req->title1,
            'title2' => $req->title2,
            'title3' => $req->title3,
            'title4' => $req->title4,
            'description1' => $req->description1,
            'description2' => $req->description2,
            'description3' => $req->description3,
            'description4' => $req->description4
        );

        $portfolio->value = $data;

        try {
            $portfolio->save();
        } catch (Exception $validated){
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Portfolio Section Updated'];
        return back()->withNotify($notify);
    }

}
