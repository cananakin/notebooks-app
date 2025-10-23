<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(1);
        return view('notes.index')->with('notes',$notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:120',
            'text' => 'required'
        ]);

        $note = new Note([
            'user_id' => Auth::id(),
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);

        $note->save();

        return to_route('notes.show', ['note' => $note]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if(!$note->user->is(Auth::user()))
        {
            abort(403);
        }
        return view('notes.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if(!$note->user->is(Auth::user()))
        {
            abort(403);
        }

        $notebooks = NoteBook::whereBelongsTo(Auth::user())->latest('updated_at')->get();

        return view('notes.edit', ['note'=> $note, 'notebooks' => $notebooks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title'=>'required|max:120',
            'text' => 'required'
        ]);

        $note->update([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text,
            'note_book_id' => $request->note_book_id,
        ]);

        return to_route('notes.show', ['note' => $note])->with('success', 'It has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if(!$note->user->is(Auth::user()))
        {
            abort(403);
        }
        $note->delete();
        if($note->trashed())
        {
            return to_route('trashed.show', ['note' => $note])->with('success', 'It has been added to trashed notes');
            //code...
        } else {
            return to_route('notes.show', ['note' => $note])->with('error', 'It has been failed');
        }
    }
}
