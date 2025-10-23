<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrashedController extends Controller
{
    public function index() : View
    {
        $trashed = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('deleted_at')->paginate(5);
        return view('notes.index', ['notes' => $trashed]);
    }
    public function show($uuid) : View
    {
        $note = Note::whereUuid($uuid)->withTrashed()->first();
        if(!$note->user->is(Auth::user()))
        {
            abort(403);
        }
        return view('notes.show', ['note' => $note]);
    }

    public function restore(Note $note)
    {
        $note->restore();
        return to_route('notes.index')->with('success','It has been restored successfully');
    }

    public function destroy(Note $note)
    {
        $note->forceDelete();
        return to_route('trashed.index')->with('success','It has been deleted forever');
    }
}
