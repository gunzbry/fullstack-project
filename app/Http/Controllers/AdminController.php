<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addTag(Request $request){
        // validate request, in case bypassed frontEnd
        $this->validate($request, [
            'tagName' => 'required'
        ]);

        return $create = Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function editTag(Request $request){
        // validate request, in case bypassed frontEnd
        $this->validate($request, [
            'id' => 'required',
            'tagName' => 'required'
        ]);

        Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);

        return response()->json([
            'tagName' => $request->tagName
        ]);
    }

    public function deleteTag(Request $request){
        // validate request, in case bypassed frontEnd
        $this->validate($request, [
            'id' => 'required'        
        ]);

        return Tag::where('id', $request->id)->delete();
    }

    public function getTag(){
        //Show last item first in this case
        return Tag::orderBy('id', 'desc')->get();
    }
}
