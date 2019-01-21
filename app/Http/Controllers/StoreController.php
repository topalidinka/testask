<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(Request $request)
    {
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
        } else {

            return response('Invalid file', 500)
                ->header('Content-Type', 'text/plain'); 
        }
    
  
      $path = $file->store('public/img');
      $url  = \Storage::url($path);
  
      return response()->json([
        'url' => $url,
        'success' => true
      ]);
    }
}
