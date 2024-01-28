@extends('layouts.app')

@section('content')
    <a href="{{ route('anote.create') }}">Create new note</a>
    <ul>
        @forelse ($notes as $note)
            <li>
                <a href="{{ route('anote.show', $note->id) }}">{{ $note->title }}</a> |
                <a href="{{ route('anote.edit', $note->id) }}">EDIT</a> |
                <form action="{{ route('anote.destroy', $note->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    DELETE
                    <input type="submit" value="Delete">
                </form>
            </li>
        @empty
            <p>No hay datos</p>
        @endforelse
    </ul>
@endsection
