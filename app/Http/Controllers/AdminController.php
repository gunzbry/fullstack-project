<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addTag(Request $request){
        // validate
        return $create = Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function getTag(){
        //Show last item first in this case
        return Tag::orderBy('id', 'desc')->get();
    }
}
