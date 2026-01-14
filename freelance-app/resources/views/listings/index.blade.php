@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Listings</h1>

    {{-- Filters --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <select name="sort" class="form-select">
                <option value="">Newest</option>
                <option value="price_asc" @selected(request('sort') === 'price_asc')>
                    Price: Low → High
                </option>
                <option value="price_desc" @selected(request('sort') === 'price_desc')>
                    Price: High → Low
                </option>
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                Apply
            </button>
        </div>
    </form>

    {{-- Hot Listings --}}
    @if($hotListings->count())
        <h3 class="mb-3">Hot Listings</h3>
        <div class="row mb-4">
            @foreach($hotListings as $hot)
                <div class="col-md-4 mb-3">
                    <div class="card border-danger h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('listings.show', $hot) }}" class="text-decoration-none">
                                    {{ $hot->title }}
                                </a>
                            </h5>

                            <p class="mb-1 text-muted">
                                {{ $hot->category->name ?? '-' }}
                            </p>

                            <p class="fw-bold">€{{ $hot->price }}</p>

                            <div class="d-flex justify-content-between small text-muted">
                                <span>{{ $hot->views_count }} Views</span>
                                <span>{{ $hot->messages_count }} Messages</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- All Listings --}}
    <h3 class="mb-3">All Listings</h3>
    <div class="row">
        @foreach($listings as $listing)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('listings.show', $listing) }}" class="text-decoration-none">
                                {{ $listing->title }}
                            </a>
                        </h5>

                        <p class="mb-1 text-muted">
                            {{ $listing->category->name ?? '-' }}
                        </p>

                        <p class="fw-bold">€{{ $listing->price }}</p>

                        <p class="small text-muted">
                            {{ $listing->email }}
                        </p>

                        {{-- Actions --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('listings.edit', $listing) }}" class="btn btn-sm btn-outline-secondary">
                                Edit
                            </a>
                            <form action="{{ route('listings.destroy', $listing) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this listing?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
