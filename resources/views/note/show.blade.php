@extends ('layouts.app')

@section ('content')

    <a href="{{ route('anote.index') }}">Back</a>
    <h1>{{ $note->title }}</h1>
    <p>{{ $note->description }}</p>

@endsection
