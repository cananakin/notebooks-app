<?php

namespace App\Http\Controllers;

use App\Models\NoteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $books = NoteBook::where('user_id', $user_id)->latest('updated_at')->paginate(5);
        
        return view('notebooks.index', ["books" => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50'
        ]);

        $notebook = new NoteBook([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        $notebook->save();
        
        return redirect()->route('notebooks.index')->with('success','It has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
        $noteBook = NoteBook::find($id);
        if(Auth::id() !== $noteBook->user_id || !$noteBook) {
            abort(403);
            //redirect('/notebooks');
        }
        return view('notebooks.show', ['notebook' => $noteBook]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NoteBook $noteBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NoteBook $noteBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NoteBook $noteBook)
    {
        //
    }
}
