<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
  public function index(): View{
    $notes = Note::all();
    return view('note.index', compact('notes'));
  }

  public function create(): View{
    return view('note.create');
  }

  public function store(NoteRequest $request): RedirectResponse{

    Note::create($request->all());
    return redirect()->route('anote.index')->with('success', 'Note created');
  }

  public function edit(Note $note): View{
    // Añadiendo Note como argumento laravel no necisita que que
    // busquemos la variable en la base de datos
    // $myNote = Note::find($note);
    return view('note.edit', compact('note'));
  }

  public function update(NoteRequest $request, Note $note): RedirectResponse{

    $note->update($request->all());
    return redirect()->route('anote.index')->with('success', 'Note updated');
  }

  public function show(Note $note): View{
    return view('note.show', compact('note'));
  }

  public function destroy(Note $note): RedirectResponse{
    $note->delete();
    return redirect()->route('anote.index')->with('danger', 'Note deleted');
  }

}
