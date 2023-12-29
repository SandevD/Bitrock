<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::get();
        return view('dashboard.documents.view', compact('documents'));
    }

    public function add()
    {
        return view('dashboard.documents.add');
    }

    public function edit($id)
    {
        $documents = Document::find($id);
        return view('dashboard.documents.edit', compact('documents'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'file' => 'mimes:pdf',
            'status' => 'required',
        ]);

        $document = Document::find($request->id);

        $document->name = $request->name;
        $document->category = $request->category;
        if ($request->hasfile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(base_path() . '/public/assets/docs', $fileName);
            $document->file = $fileName;
            @unlink( public_path('assets/docs/' . $document->file) );
        }
        $document->status = $request->status;

        try {
            $document->save();
        } catch (Exception $validated) {
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Document Added'];
        return back()->withNotify($notify);
    }

    public function delete($id)
    {
        $document = Document::find($id);
        try {
            $document->delete();
            @unlink( public_path('assets/docs/' . $document->file) );
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Product Deleted'];
        return back()->withNotify($notify);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'file' => 'required|mimes:pdf',
            'status' => 'required',
        ]);

        $document = new Document();

        $fileName = time() . '.' . $request->file->extension();

        $request->file->move(base_path() . '/public/assets/docs', $fileName);


        $document->name = $request->name;
        $document->category = $request->category;
        $document->file = $fileName;
        $document->status = $request->status;

        try {
            $document->save();
        } catch (Exception $validated) {
            $notify[] = ['error', $validated->getMessage()];
            return back()->withNotify($notify);
        } catch (Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Document Added'];
        return back()->withNotify($notify);
    }
}
