<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('subject')->latest()->get();
        return NoteResource::collection($notes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|numeric',
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

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

    public function show(Note $catatan)
    {
        // dd($catatan->toArray());
        return new NoteResource($catatan);
        // return NoteResource::make($catatan); //alternatif
    }

    public function update(Note $catatan)
    {
        request()->validate([
            'subject' => 'required|numeric',
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $subject = Subject::findOrFail(request('subject'));
        
        $catatan->update([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'description' => request('description'),
        ]);

        return response()->json([
            'message' => 'Note updated.',
            'notes' => $catatan,
        ]);
    }
}
