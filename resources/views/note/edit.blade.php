@extends('layouts.app')

@section('content')
    <a href="{{ route('anote.index') }}">Back</a>
    <form method="POST" action="{{ route('anote.update', $note->id) }}">
        @method('PUT')
        @csrf
        <label>Titel:</label>
        <input type="text" name="title" value="{{ $note->title }}" />
        @error('title')
            <p style="color:red;">{{ $message }} </p>
        @enderror

        <label">Description:</label>
        <input type="text" name="description" value="{{ $note->description }}" />
        @error('description')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <input type="submit" value="Update" />
    </form>
@endsection
