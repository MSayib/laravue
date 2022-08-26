<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $subject = Subject::findOrFail($request->subject);
        $note = Note::create([
            'subject_id' => $subject->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Note created.',
            'notes' => $note,
        ]);
    }
}
