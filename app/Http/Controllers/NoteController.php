<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Request $request, Note $note)
    {
        $input = $request['note'];
        $note->fill($input)->save();
        return redirect('/games/notes/'.$note->id);
    }
    
    public function show(Note $note)
    {
        return view('games.show')->with(['note' => $note]);
    }
}
