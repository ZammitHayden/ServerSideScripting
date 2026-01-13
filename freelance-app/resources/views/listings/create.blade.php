@extends('layouts.app')

@section('content')

<h2>Create Listing</h2>

<form action="{{ route('listings.store') }}" method="POST">
    @csrf

    <label>Title</label>
    <input type="text" name="title" value="{{ old('title') }}" required>

    <label>Description</label>
    <textarea name="description" rows="4" required>{{ old('description') }}</textarea>

    <label>Price ($)</label>
    <input type="number" name="price" value="{{ old('price') }}" required>

    <label>Contact Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Category</label>
    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Create Listing</button>
    <a href="{{ route('listings.index') }}">Cancel</a>
</form>

@endsection
