@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Edit Listing</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('listings.update', $listing) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $listing->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control" required> 
                                {{ old('description', $listing->description) }}
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $listing->price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $listing->email) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $listing->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                Update Listing
                            </button>

                            <a href="{{ route('listings.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
