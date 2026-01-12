@extends('layouts.app')

@section('content')

<div>

    <h2>Edit Listing</h2>

    <form action="{{ route('listings.update', $listing) }}" method="POST">
        @csrf
        @method('PATCH')

        <div>
            <label>Title</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $listing->title) }}"
                required
            >
        </div>

        <div>
            <label>Description</label>
            <textarea
                name="description"
                rows="4"
                required
            >{{ old('description', $listing->description) }}</textarea>
        </div>

        <div>
            <label>Price ($)</label>
            <input
                type="number"
                name="price"
                value="{{ old('price', $listing->price) }}"
                required
            >
        </div>

        <div>
            <label>Contact Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $listing->email) }}"
                required
            >
        </div>

        <div>
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(old('category_id', $listing->category_id) == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Update Listing</button>
            <a href="{{ route('listings.index') }}">Cancel</a>
        </div>

    </form>

</div>

@endsection
