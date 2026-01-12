@extends('layouts.app')

@section('content')

<h1>Listings</h1>

<form method="GET">
    <div>
        <select name="category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <select name="sort">
            <option value="">Newest</option>
            <option value="price_asc" @selected(request('sort') === 'price_asc')>
                Price: Low → High
            </option>
            <option value="price_desc" @selected(request('sort') === 'price_desc')>
                Price: High → Low
            </option>
        </select>
    </div>

    <div>
        <button type="submit">Apply</button>
    </div>
</form>

{{-- All Listings --}}
<h3>All Listings</h3>

<div>
    @foreach($listings as $listing)
        <div>
            <div>
                <h5>
                    <a href="{{ route('listings.show', $listing) }}">
                        {{ $listing->title }}
                    </a>
                </h5>

                <p>{{ $listing->category->name ?? '-' }}</p>
                <p>${{ $listing->price }}</p>
                <p>
                    <small>{{ $listing->email }}</small>
                </p>

                {{-- Actions --}}
                <div>
                    <a href="{{ route('listings.edit', $listing) }}">
                        Edit
                    </a>

                    <form action="{{ route('listings.destroy', $listing) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this listing?')">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @endforeach
</div>

@endsection
