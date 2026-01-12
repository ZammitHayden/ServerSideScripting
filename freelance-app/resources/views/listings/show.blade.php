@extends('layouts.app')

@section('content')

<div>

    {{-- Listing Details --}}
    <h2>{{ $listing->title }}</h2>

    <p>
        <strong>Category:</strong>
        {{ $listing->category->name ?? '-' }}
    </p>

    <p>
        <strong>Price:</strong>
        ${{ $listing->price }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $listing->email }}
    </p>

    <p>
        {{ $listing->description }}
    </p>

    <div>
        <a href="{{ route('listings.edit', $listing) }}">Edit</a>

        <form action="{{ route('listings.destroy', $listing) }}" method="POST" style="display:inline;">
            @method('DELETE')
            <button onclick="return confirm('Delete this listing?')">Delete</button>
        </form>
    </div>
@endsection
